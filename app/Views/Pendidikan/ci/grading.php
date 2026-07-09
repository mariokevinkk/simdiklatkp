<?php
/**
 * Grading Detail View for CI
 */
?>
const GradingView = ({ student, onBack, onSave }) => {
    const components = ASSESSMENT_COMPONENTS[student.institution] || ASSESSMENT_COMPONENTS['Default'];
    const [grades, setGrades] = useState(
        student.grades.length > 0 
            ? student.grades 
            : components.map(c => ({ label: c, value: '' }))
    );
    const [feedback, setFeedback] = useState(student.feedback || '');
    const [isSubmitted, setIsSubmitted] = useState(student.gradingStatus === 'Selesai');

    const handleUpdateGrade = (index, value) => {
        if (isSubmitted) return;
        const newGrades = [...grades];
        newGrades[index].value = value;
        setGrades(newGrades);
    };
    const handleDownloadForm = () => {
        const toast = document.createElement('div');
        toast.className = "fixed bottom-8 right-8 bg-slate-800 text-white px-6 py-4 rounded-2xl shadow-2xl animate-slide-up z-[100] flex items-center gap-3";
        toast.innerHTML = `<i data-lucide="download" class="w-5 h-5"></i> <span class="font-bold text-sm">Mengunduh Dokumen ${student.institution}...</span>`;
        document.body.appendChild(toast);
        lucide.createIcons();
        setTimeout(() => toast.remove(), 3000);
    };

    const handleSubmit = (status) => {
        onSave(student.id, { 
            grades, 
            feedback, 
            gradingStatus: status 
        });
        if (status === 'Selesai') {
            setIsSubmitted(true);
            onBack();
        }
    };

    const [isRevisionModalOpen, setIsRevisionModalOpen] = useState(false);

    return (
        <div className="space-y-6 animate-fade-in pb-12">
            {/* Header Detail */}
            <div className="flex items-center justify-between bg-white p-6 rounded-[32px] border border-slate-200 shadow-sm">
                <div className="flex items-center gap-6">
                    <button onClick={onBack} className="p-3 bg-slate-50 text-slate-400 hover:text-primary rounded-2xl transition-all">
                        <Icon name="arrow-left" size={6} />
                    </button>
                    <div>
                        <div className="flex items-center gap-3 mb-1">
                            <h3 className="text-xl font-black text-slate-800">{student.name}</h3>
                            <StatusBadge status={student.gradingStatus} />
                        </div>
                        <p className="text-xs text-slate-500 font-medium">NIM: {student.nim} • {student.institution}</p>
                    </div>
                </div>
            </div>

            <div className="grid grid-cols-12 gap-8">
                {/* Left: Info & Components */}
                <div className="col-span-12 lg:col-span-8 space-y-8">
                    {/* Logbook Review Section */}
                    <Card className="p-8 border-primary/20 bg-primary/[0.02]">
                        <div className="flex items-center justify-between mb-8">
                            <div>
                                <h4 className="text-sm font-black text-slate-800 uppercase tracking-widest">Review Logbook Mahasiswa</h4>
                                <p className="text-[10px] text-primary font-bold bg-primary/5 px-2 py-1 rounded-lg inline-block mt-1">
                                    <Icon name="clock" size={3} className="inline mr-1" />
                                    Terakhir diunggah: {student.lastUploaded}
                                </p>
                            </div>
                            {!isSubmitted && (
                                <button 
                                    onClick={() => setIsRevisionModalOpen(true)}
                                    className="px-4 py-2 bg-white border border-warning text-warning font-bold rounded-xl text-[10px] hover:bg-warning hover:text-white transition-all shadow-sm flex items-center justify-center gap-2"
                                >
                                    <Icon name="rotate-ccw" size={3} />
                                    Minta Revisi
                                </button>
                            )}
                        </div>

                        <div className="p-6 bg-white border border-slate-200 rounded-[32px] flex items-center justify-between group hover:border-primary/30 transition-all">
                            <div className="flex items-center gap-4">
                                <div className="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:bg-primary/5 group-hover:text-primary transition-all">
                                    <Icon name="file-text" size={6} />
                                </div>
                                <div>
                                    <p className="text-sm font-bold text-slate-800">Logbook_Minggu_3_{student.name.replace(' ', '_')}.pdf</p>
                                    <p className="text-[10px] text-slate-400 font-medium uppercase">PDF Document • 2.4 MB</p>
                                </div>
                            </div>
                            <button className="p-3 text-slate-400 hover:text-primary transition-colors">
                                <Icon name="download" size={5} />
                            </button>
                        </div>
                    </Card>

                    {/* Template Penilaian Section */}
                    <Card className="p-8">
                        <div className="flex items-center justify-between mb-6">
                            <div>
                                <h4 className="text-sm font-black text-slate-800 uppercase tracking-widest">Template Penilaian</h4>
                                <p className="text-[10px] text-slate-500 font-medium">Gunakan form resmi dari {student.institution}</p>
                            </div>
                        </div>
                        <button 
                            onClick={handleDownloadForm}
                            className="w-full p-6 border-2 border-dashed border-slate-200 rounded-[32px] flex flex-col items-center justify-center gap-3 hover:border-primary hover:bg-primary/5 transition-all group"
                        >
                            <div className="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 group-hover:text-primary transition-all">
                                <Icon name="file-down" size={6} />
                            </div>
                            <div className="text-center">
                                <p className="text-sm font-bold text-slate-700">Download Template Penilaian</p>
                                <p className="text-[10px] text-slate-400 font-medium">Format: PDF/DOCX (Sesuai Institusi)</p>
                            </div>
                        </button>
                    </Card>

                    {/* Upload Penilaian Section */}
                    <Card className="p-8">
                        <div className="flex items-center justify-between mb-6">
                            <div>
                                <h4 className="text-sm font-black text-slate-800 uppercase tracking-widest">Upload Berkas Penilaian</h4>
                                <p className="text-[10px] text-slate-500 font-medium">Unggah dokumen atau foto penilaian yang sudah diisi</p>
                            </div>
                        </div>
                        <div className="relative">
                            <input 
                                type="file" 
                                className="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                disabled={isSubmitted}
                            />
                            <div className={`p-10 border-2 border-dashed border-slate-200 rounded-[32px] flex flex-col items-center justify-center gap-4 transition-all ${isSubmitted ? 'bg-slate-50' : 'hover:border-primary hover:bg-slate-50'}`}>
                                <div className="w-16 h-16 bg-primary/5 text-primary rounded-3xl flex items-center justify-center">
                                    <Icon name="upload-cloud" size={8} />
                                </div>
                                <div className="text-center">
                                    <p className="text-sm font-bold text-slate-800">Klik atau seret file untuk mengunggah</p>
                                    <p className="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-wider">Maks. 5MB • PDF, JPG, PNG</p>
                                </div>
                            </div>
                        </div>
                    </Card>

                    <Card className="p-8">
                        <h4 className="text-sm font-black text-slate-800 uppercase tracking-widest mb-6">Catatan & Feedback Bimbingan</h4>
                        <textarea 
                            disabled={isSubmitted}
                            className="w-full h-32 p-6 bg-slate-50 border border-slate-200 rounded-[32px] text-sm font-medium focus:ring-2 focus:ring-primary/20 transition-all outline-none disabled:bg-slate-100 disabled:text-slate-400 resize-none"
                            placeholder="Tuliskan catatan kemajuan atau kendala mahasiswa selama bimbingan..."
                            value={feedback}
                            onChange={(e) => setFeedback(e.target.value)}
                        ></textarea>
                    </Card>
                </div>

                <RevisionModal 
                    isOpen={isRevisionModalOpen}
                    onClose={() => setIsRevisionModalOpen(false)}
                    onConfirm={(note) => {
                        console.log('Revision requested with note:', note);
                        handleSubmit('Proses');
                    }}
                />

                {/* Right: Summary & Action */}
                <div className="col-span-12 lg:col-span-4 space-y-6">
                    <Card className="bg-slate-50 border-slate-100">
                        <h4 className="text-sm font-black text-slate-800 uppercase tracking-widest mb-6">Informasi Praktik</h4>
                        <div className="space-y-6">
                            <div className="p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                                <p className="text-[10px] font-bold text-slate-400 uppercase mb-2">Penempatan</p>
                                <p className="text-sm font-bold text-slate-800">{student.stase}</p>
                                <p className="text-xs text-slate-500 font-medium">{student.room}</p>
                            </div>
                            <div className="p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                                <p className="text-[10px] font-bold text-slate-400 uppercase mb-2">Periode Stase</p>
                                <div className="flex items-center gap-3 text-slate-800">
                                    <Icon name="calendar" size={4} className="text-primary" />
                                    <span className="text-xs font-bold">{student.startDate} - {student.endDate}</span>
                                </div>
                            </div>
                        </div>
                    </Card>

                    {!isSubmitted && (
                        <div className="space-y-3">
                            <button 
                                onClick={() => handleSubmit('Selesai')}
                                className="w-full py-4 bg-primary text-white font-bold rounded-[24px] hover:bg-primary-dark transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2"
                            >
                                <Icon name="check-circle" size={4} />
                                Terima & Selesaikan
                            </button>
                            <p className="text-[10px] text-slate-400 text-center font-medium px-4">
                                *Pastikan berkas penilaian sudah diunggah sebelum menyelesaikan.
                            </p>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};
