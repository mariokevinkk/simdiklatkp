<?php
/**
 * Stase Room Detail View (repurposed students.php)
 */
?>
const StaseRoomDetailView = ({ selectedStase, selectedRoom }) => {
    const [activeTab, setActiveTab] = useState('mahasiswa'); // mahasiswa | tugas
    const [students, setStudents] = useState([]);
    const [tasks, setTasks] = useState([]);
    const [loading, setLoading] = useState(false);
    
    // Student detail states
    const [selectedStudent, setSelectedStudent] = useState(null);
    
    // Task creation modal
    const [isCreateTaskOpen, setIsCreateTaskOpen] = useState(false);
    const [taskForm, setTaskForm] = useState({ nama_tugas: '', deskripsi: '', deadline: '' });
    
    // View submissions states
    const [selectedTask, setSelectedTask] = useState(null);
    const [submissions, setSubmissions] = useState([]);
    
    // Grade modal
    const [selectedSub, setSelectedSub] = useState(null);
    const [gradeForm, setGradeForm] = useState({ nilai: '', catatan_ci: '' });

    // Validate logbook modal
    const [selectedLogbook, setSelectedLogbook] = useState(null);
    const [validationForm, setValidationForm] = useState({ status_validasi: 'Disetujui', catatan_ci: '' });

    const fetchDetails = () => {
        if (!selectedStase || !selectedRoom) return;
        setLoading(true);
        
        // Fetch students
        fetch(`<?= base_url('pendidikan/ci/api/stase/students') ?>/${selectedStase.stase_id}/${selectedRoom.ruangan_id}`)
            .then(res => res.json())
            .then(data => {
                setStudents(data);
                setLoading(false);
            })
            .catch(err => {
                console.error(err);
                setLoading(false);
            });

        // Fetch tasks
        fetch(`<?= base_url('pendidikan/ci/api/tasks') ?>/${selectedStase.stase_id}/${selectedRoom.ruangan_id}`)
            .then(res => res.json())
            .then(data => setTasks(data))
            .catch(err => console.error(err));
    };

    useEffect(() => {
        fetchDetails();
        setSelectedStudent(null);
        setSelectedTask(null);
    }, [selectedStase, selectedRoom]);

    const handleCreateTask = (e) => {
        e.preventDefault();
        fetch(`<?= base_url('pendidikan/ci/api/tasks') ?>/${selectedStase.stase_id}/${selectedRoom.ruangan_id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(taskForm)
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert('Tugas berhasil dibuat');
                setIsCreateTaskOpen(false);
                setTaskForm({ nama_tugas: '', deskripsi: '', deadline: '' });
                fetchDetails();
            } else {
                alert(res.message || 'Gagal membuat tugas');
            }
        });
    };

    const handleSelectTask = (task) => {
        setSelectedTask(task);
        fetch(`<?= base_url('pendidikan/ci/api/submissions') ?>/${task.id}`)
            .then(res => res.json())
            .then(data => setSubmissions(data));
    };

    const handleGradeSubmission = (e) => {
        e.preventDefault();
        if (!selectedSub) return;
        fetch(`<?= base_url('pendidikan/ci/api/submissions/grade') ?>/${selectedSub.submission_id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(gradeForm)
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert('Nilai berhasil disimpan');
                setSelectedSub(null);
                handleSelectTask(selectedTask);
            } else {
                alert(res.message || 'Gagal menyimpan nilai');
            }
        });
    };

    const handleValidateLogbook = (e) => {
        e.preventDefault();
        if (!selectedLogbook) return;
        fetch(`<?= base_url('pendidikan/ci/api/logbook/validate') ?>/${selectedLogbook.id}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(validationForm)
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                alert('Logbook berhasil divalidasi');
                setSelectedLogbook(null);
                fetchDetails();
                // update current selected student details
                if (selectedStudent) {
                    setSelectedStudent(prev => ({
                        ...prev,
                        logbooks: prev.logbooks.map(l => l.id === selectedLogbook.id ? { ...l, ...validationForm } : l)
                    }));
                }
            } else {
                alert(res.message || 'Gagal validasi logbook');
            }
        });
    };

    if (loading) {
        return (
            <div className="flex flex-col items-center justify-center p-20 text-slate-400">
                <Icon name="loader" size={10} className="animate-spin mb-4" />
                <span className="text-sm font-bold">Memuat data stase & ruangan...</span>
            </div>
        );
    }

    return (
        <div className="space-y-6 animate-fade-in">
            {/* Header Ruangan */}
            <div className="flex flex-col md:flex-row items-start md:items-center justify-between bg-white p-8 rounded-[32px] border border-slate-200 shadow-sm gap-4">
                <div>
                    <span className="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black rounded-lg uppercase tracking-widest mb-2 inline-block">
                        Stase: {selectedStase?.nama_stase}
                    </span>
                    <h2 className="text-2xl font-black text-slate-800 flex items-center gap-2">
                        <Icon name="map-pin" size={6} className="text-primary" />
                        Ruangan: {selectedRoom?.nama_unit}
                    </h2>
                </div>
                <div className="flex gap-3">
                    <a 
                        href={`<?= base_url('pendidikan/ci/api/logbook/download') ?>/${selectedStase?.stase_id}/${selectedRoom?.ruangan_id}`}
                        target="_blank"
                        className="px-5 py-3.5 bg-success text-white font-bold rounded-2xl text-xs hover:bg-success-dark transition-all flex items-center gap-2 shadow-lg shadow-success/20"
                    >
                        <Icon name="download" size={4} />
                        Unduh Logbook Keseluruhan (CSV)
                    </a>
                </div>
            </div>

            {/* View Switching */}
            {!selectedStudent && !selectedTask ? (
                <>
                    {/* Tabs */}
                    <div className="flex border-b border-slate-200 gap-6">
                        <button 
                            onClick={() => setActiveTab('mahasiswa')}
                            className={`pb-4 text-sm font-bold transition-all relative ${activeTab === 'mahasiswa' ? 'text-primary' : 'text-slate-400'}`}
                        >
                            Daftar Mahasiswa
                            {activeTab === 'mahasiswa' && <div className="absolute bottom-0 left-0 right-0 h-0.5 bg-primary"></div>}
                        </button>
                        <button 
                            onClick={() => setActiveTab('tugas')}
                            className={`pb-4 text-sm font-bold transition-all relative ${activeTab === 'tugas' ? 'text-primary' : 'text-slate-400'}`}
                        >
                            Tugas Kelompok
                            {activeTab === 'tugas' && <div className="absolute bottom-0 left-0 right-0 h-0.5 bg-primary"></div>}
                        </button>
                    </div>

                    {activeTab === 'mahasiswa' ? (
                        <div className="bg-white rounded-[32px] border border-slate-200 overflow-hidden shadow-sm shadow-slate-200/50">
                            <table className="w-full text-left border-collapse">
                                <thead className="bg-slate-50/50 border-b border-slate-200">
                                    <tr>
                                        <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Mahasiswa</th>
                                        <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">NIM</th>
                                        <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Institusi</th>
                                        <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Total Logbook</th>
                                        <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Belum Validasi</th>
                                        <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-slate-100">
                                    {students.map((s) => (
                                        <tr key={s.id} className="hover:bg-slate-50/50 transition-colors group">
                                            <td className="px-6 py-5">
                                                <div className="flex items-center gap-3">
                                                    <div className="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center font-bold text-slate-600 group-hover:bg-primary group-hover:text-white transition-all">
                                                        {s.nama.charAt(0)}
                                                    </div>
                                                    <div className="font-bold text-sm text-slate-800">{s.nama}</div>
                                                </div>
                                            </td>
                                            <td className="px-6 py-5 text-sm font-bold text-slate-600">{s.nim}</td>
                                            <td className="px-6 py-5 text-sm text-slate-600 font-medium">{s.institusi}</td>
                                            <td className="px-6 py-5 text-center text-sm font-bold text-slate-700">{s.total_logbook}</td>
                                            <td className="px-6 py-5 text-center">
                                                {s.pending_logbook > 0 ? (
                                                    <span className="px-2 py-1 bg-warning/10 text-warning text-[10px] font-bold rounded-lg">
                                                        {s.pending_logbook} Pending
                                                    </span>
                                                ) : (
                                                    <span className="px-2 py-1 bg-success/10 text-success text-[10px] font-bold rounded-lg">
                                                        Lengkap
                                                    </span>
                                                )}
                                            </td>
                                            <td className="px-6 py-5 text-right">
                                                <button 
                                                    onClick={() => setSelectedStudent(s)}
                                                    className="px-4 py-2.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl text-[10px] hover:bg-primary hover:text-white hover:border-primary transition-all shadow-sm"
                                                >
                                                    Logbook & Bimbingan
                                                </button>
                                            </td>
                                        </tr>
                                    ))}
                                    {students.length === 0 && (
                                        <tr>
                                            <td colSpan="6" className="p-12 text-center text-slate-400 font-medium">Belum ada mahasiswa di ruangan ini</td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    ) : (
                        <div className="space-y-4">
                            <div className="flex justify-between items-center">
                                <h3 className="text-lg font-bold text-slate-800">Daftar Tugas</h3>
                                <button 
                                    onClick={() => setIsCreateTaskOpen(true)}
                                    className="px-4 py-2.5 bg-primary text-white font-bold rounded-xl text-xs hover:bg-primary-dark transition-all flex items-center gap-2 shadow-md shadow-primary/10"
                                >
                                    <Icon name="plus" size={4} />
                                    Buat Tugas Baru
                                </button>
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {tasks.map((t) => (
                                    <Card key={t.id} className="border border-slate-200 hover:border-primary/20 transition-all flex flex-col justify-between h-52">
                                        <div>
                                            <div className="flex justify-between items-start mb-3">
                                                <h4 className="font-bold text-slate-800 text-sm line-clamp-1">{t.nama_tugas}</h4>
                                                <span className="px-2 py-1 bg-slate-100 text-slate-500 text-[9px] font-bold rounded-lg">
                                                    {t.submitted_count} Dikumpul
                                                </span>
                                            </div>
                                            <p className="text-xs text-slate-500 font-medium line-clamp-3 mb-4">{t.deskripsi || 'Tidak ada deskripsi'}</p>
                                        </div>
                                        <div className="flex items-center justify-between border-t border-slate-50 pt-4 mt-auto">
                                            <div className="flex items-center gap-1.5 text-danger font-bold text-[10px]">
                                                <Icon name="calendar-days" size={3.5} />
                                                <span>Deadline: {t.deadline}</span>
                                            </div>
                                            <button 
                                                onClick={() => handleSelectTask(t)}
                                                className="px-3.5 py-2 bg-slate-100 text-slate-700 font-black rounded-lg text-[9px] uppercase tracking-wider hover:bg-primary hover:text-white transition-all"
                                            >
                                                Lihat Pengumpulan
                                            </button>
                                        </div>
                                    </Card>
                                ))}
                                {tasks.length === 0 && (
                                    <div className="col-span-2 p-12 text-center text-slate-400 bg-white border border-slate-200 rounded-[32px]">
                                        Belum ada tugas kelompok dibuat
                                    </div>
                                )}
                            </div>
                        </div>
                    )}
                </>
            ) : selectedStudent ? (
                // Selected Student Logbook View
                <div className="space-y-6">
                    <div className="flex items-center justify-between bg-white p-6 rounded-[32px] border border-slate-200">
                        <div className="flex items-center gap-4">
                            <button onClick={() => { setSelectedStudent(null); fetchDetails(); }} className="p-2.5 bg-slate-50 text-slate-400 hover:text-primary rounded-xl transition-all">
                                <Icon name="arrow-left" size={5} />
                            </button>
                            <div>
                                <h3 className="text-lg font-bold text-slate-800">{selectedStudent.nama}</h3>
                                <p className="text-xs text-slate-500 font-medium">NIM: {selectedStudent.nim} • Logbook & Validasi</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-[32px] border border-slate-200 overflow-hidden">
                        <table className="w-full text-left border-collapse">
                            <thead className="bg-slate-50/50 border-b border-slate-200">
                                <tr>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tanggal</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Judul Kegiatan</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan CI</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Validasi</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-slate-100">
                                {selectedStudent.logbooks?.map((l) => (
                                    <tr key={l.id} className="hover:bg-slate-50/50 transition-colors">
                                        <td className="px-6 py-5 text-xs font-bold text-slate-600">{l.tanggal_kegiatan}</td>
                                        <td className="px-6 py-5 text-sm font-bold text-slate-800">{l.judul_kegiatan}</td>
                                        <td className="px-6 py-5 text-xs text-slate-500 font-medium max-w-xs truncate">{l.deskripsi_kegiatan}</td>
                                        <td className="px-6 py-5">
                                            <span className={`px-2 py-0.5 rounded text-[10px] font-bold ${
                                                l.status_validasi === 'Disetujui' ? 'bg-success/10 text-success' :
                                                l.status_validasi === 'Revisi' ? 'bg-warning/10 text-warning' : 'bg-slate-100 text-slate-500'
                                            }`}>
                                                {l.status_validasi}
                                            </span>
                                        </td>
                                        <td className="px-6 py-5 text-xs text-slate-400">{l.catatan_ci || '-'}</td>
                                        <td className="px-6 py-5 text-right">
                                            <button 
                                                onClick={() => {
                                                    setSelectedLogbook(l);
                                                    setValidationForm({ status_validasi: l.status_validasi === 'Pending' ? 'Disetujui' : l.status_validasi, catatan_ci: l.catatan_ci || '' });
                                                }}
                                                className="px-3 py-1.5 bg-slate-100 text-slate-600 font-bold rounded-lg text-[10px] hover:bg-primary hover:text-white transition-all"
                                            >
                                                Validasi
                                            </button>
                                        </td>
                                    </tr>
                                ))}
                                {(!selectedStudent.logbooks || selectedStudent.logbooks.length === 0) && (
                                    <tr>
                                        <td colSpan="6" className="p-12 text-center text-slate-400 font-medium">Belum ada unggahan logbook kegiatan</td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            ) : (
                // View Task Submissions View
                <div className="space-y-6">
                    <div className="flex items-center justify-between bg-white p-6 rounded-[32px] border border-slate-200">
                        <div className="flex items-center gap-4">
                            <button onClick={() => { setSelectedTask(null); fetchDetails(); }} className="p-2.5 bg-slate-50 text-slate-400 hover:text-primary rounded-xl transition-all">
                                <Icon name="arrow-left" size={5} />
                            </button>
                            <div>
                                <h3 className="text-lg font-bold text-slate-800">Pengumpulan: {selectedTask.nama_tugas}</h3>
                                <p className="text-xs text-slate-500 font-medium">Batas Pengumpulan: {selectedTask.deadline}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-[32px] border border-slate-200 overflow-hidden">
                        <table className="w-full text-left border-collapse">
                            <thead className="bg-slate-50/50 border-b border-slate-200">
                                <tr>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Mahasiswa</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">NIM</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Lampiran Tugas</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Catatan</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Nilai</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                                    <th className="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-slate-100">
                                {submissions.map((sub) => (
                                    <tr key={sub.mahasiswa_id} className="hover:bg-slate-50/50 transition-colors">
                                        <td className="px-6 py-5 font-bold text-sm text-slate-800">{sub.nama}</td>
                                        <td className="px-6 py-5 text-sm font-semibold text-slate-500">{sub.nim}</td>
                                        <td className="px-6 py-5 text-xs text-slate-600">
                                            {sub.file_tugas ? (
                                                <a 
                                                    href={`<?= base_url() ?>/writable/uploads/tugas/${sub.file_tugas}`} 
                                                    target="_blank"
                                                    className="text-primary font-bold hover:underline flex items-center gap-1"
                                                >
                                                    <Icon name="file-text" size={3.5} />
                                                    Lihat Berkas
                                                </a>
                                            ) : (
                                                <span className="text-slate-400 italic">Belum mengunggah</span>
                                            )}
                                        </td>
                                        <td className="px-6 py-5 text-xs text-slate-400 max-w-xs truncate">{sub.catatan_mahasiswa || '-'}</td>
                                        <td className="px-6 py-5 text-center text-sm font-black text-slate-800">{sub.nilai ?? '-'}</td>
                                        <td className="px-6 py-5">
                                            <span className={`px-2 py-0.5 rounded text-[10px] font-bold ${
                                                sub.status === 'Selesai' ? 'bg-success/10 text-success' :
                                                sub.status === 'Revisi' ? 'bg-warning/10 text-warning' : 'bg-slate-100 text-slate-500'
                                            }`}>
                                                {sub.status}
                                            </span>
                                        </td>
                                        <td className="px-6 py-5 text-right">
                                            {sub.submission_id ? (
                                                <button 
                                                    onClick={() => {
                                                        setSelectedSub(sub);
                                                        setGradeForm({ nilai: sub.nilai || '', catatan_ci: sub.catatan_ci || '' });
                                                    }}
                                                    className="px-3.5 py-1.5 bg-primary text-white font-bold rounded-lg text-[10px] hover:bg-primary-dark transition-all"
                                                >
                                                    Beri Nilai
                                                </button>
                                            ) : (
                                                <span className="text-xs text-slate-400 italic">N/A</span>
                                            )}
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            )}

            {/* Create Task Modal */}
            {isCreateTaskOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
                    <div className="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
                        <div className="p-6 border-b border-slate-100 flex items-center justify-between">
                            <h3 className="text-lg font-bold text-slate-800">Buat Tugas Baru</h3>
                            <button onClick={() => setIsCreateTaskOpen(false)} className="p-2 hover:bg-slate-50 rounded-xl transition-colors">
                                <Icon name="x" size={5} className="text-slate-400" />
                            </button>
                        </div>
                        <form onSubmit={handleCreateTask}>
                            <div className="p-8 space-y-4">
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nama Tugas</label>
                                    <input 
                                        type="text" 
                                        required
                                        className="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary/20 transition-all outline-none"
                                        placeholder="Tugas Laporan Asuhan Keperawatan..."
                                        value={taskForm.nama_tugas}
                                        onChange={(e) => setTaskForm({ ...taskForm, nama_tugas: e.target.value })}
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Deskripsi Tugas</label>
                                    <textarea 
                                        className="w-full h-24 p-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary/20 transition-all outline-none resize-none"
                                        placeholder="Tuliskan petunjuk tugas..."
                                        value={taskForm.deskripsi}
                                        onChange={(e) => setTaskForm({ ...taskForm, deskripsi: e.target.value })}
                                    ></textarea>
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Batas Pengumpulan (Deadline)</label>
                                    <input 
                                        type="datetime-local" 
                                        required
                                        className="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary/20 transition-all outline-none"
                                        value={taskForm.deadline}
                                        onChange={(e) => setTaskForm({ ...taskForm, deadline: e.target.value })}
                                    />
                                </div>
                            </div>
                            <div className="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                                <button type="button" onClick={() => setIsCreateTaskOpen(false)} className="px-5 py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-500">Batal</button>
                                <button type="submit" className="px-5 py-3 bg-primary text-white font-bold rounded-xl text-xs hover:bg-primary-dark transition-all">Buat Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}

            {/* Grading Modal */}
            {selectedSub && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
                    <div className="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
                        <div className="p-6 border-b border-slate-100 flex items-center justify-between">
                            <h3 className="text-lg font-bold text-slate-800">Beri Nilai Tugas</h3>
                            <button onClick={() => setSelectedSub(null)} className="p-2 hover:bg-slate-50 rounded-xl transition-colors">
                                <Icon name="x" size={5} className="text-slate-400" />
                            </button>
                        </div>
                        <form onSubmit={handleGradeSubmission}>
                            <div className="p-8 space-y-4">
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Mahasiswa</label>
                                    <p className="text-sm font-bold text-slate-800">{selectedSub.nama}</p>
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nilai (0-100)</label>
                                    <input 
                                        type="number" 
                                        min="0" 
                                        max="100" 
                                        required
                                        className="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary/20 transition-all outline-none"
                                        placeholder="Masukkan nilai..."
                                        value={gradeForm.nilai}
                                        onChange={(e) => setGradeForm({ ...gradeForm, nilai: e.target.value })}
                                    />
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Catatan Penilai</label>
                                    <textarea 
                                        className="w-full h-24 p-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary/20 transition-all outline-none resize-none"
                                        placeholder="Feedback perbaikan atau masukan..."
                                        value={gradeForm.catatan_ci}
                                        onChange={(e) => setGradeForm({ ...gradeForm, catatan_ci: e.target.value })}
                                    ></textarea>
                                </div>
                            </div>
                            <div className="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                                <button type="button" onClick={() => setSelectedSub(null)} className="px-5 py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-500">Batal</button>
                                <button type="submit" className="px-5 py-3 bg-primary text-white font-bold rounded-xl text-xs hover:bg-primary-dark transition-all">Simpan Nilai</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}

            {/* Validate Logbook Modal */}
            {selectedLogbook && (
                <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm">
                    <div className="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
                        <div className="p-6 border-b border-slate-100 flex items-center justify-between">
                            <h3 className="text-lg font-bold text-slate-800">Validasi Kegiatan Logbook</h3>
                            <button onClick={() => setSelectedLogbook(null)} className="p-2 hover:bg-slate-50 rounded-xl transition-colors">
                                <Icon name="x" size={5} className="text-slate-400" />
                            </button>
                        </div>
                        <form onSubmit={handleValidateLogbook}>
                            <div className="p-8 space-y-4">
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Judul Kegiatan</label>
                                    <p className="text-sm font-bold text-slate-800">{selectedLogbook.judul_kegiatan}</p>
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Deskripsi Kegiatan</label>
                                    <p className="text-xs text-slate-600 leading-relaxed font-medium bg-slate-50 p-4 border border-slate-100 rounded-2xl max-h-32 overflow-y-auto">{selectedLogbook.deskripsi_kegiatan}</p>
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Tindakan Validasi</label>
                                    <select 
                                        className="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold text-slate-700 outline-none"
                                        value={validationForm.status_validasi}
                                        onChange={(e) => setValidationForm({ ...validationForm, status_validasi: e.target.value })}
                                    >
                                        <option value="Disetujui">Setujui Kegiatan</option>
                                        <option value="Revisi">Minta Revisi</option>
                                    </select>
                                </div>
                                <div>
                                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Catatan CI</label>
                                    <textarea 
                                        className="w-full h-24 p-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary/20 transition-all outline-none resize-none"
                                        placeholder="Tuliskan catatan Anda..."
                                        value={validationForm.catatan_ci}
                                        onChange={(e) => setValidationForm({ ...validationForm, catatan_ci: e.target.value })}
                                    ></textarea>
                                </div>
                            </div>
                            <div className="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
                                <button type="button" onClick={() => setSelectedLogbook(null)} className="px-5 py-3 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-500">Batal</button>
                                <button type="submit" className="px-5 py-3 bg-primary text-white font-bold rounded-xl text-xs hover:bg-primary-dark transition-all">Simpan Validasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
};
