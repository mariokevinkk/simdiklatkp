<?php
/**
 * Shared UI Components for CI Dashboard
 */
?>
const Icon = ({ name, size = 5, className = "" }) => {
    useEffect(() => { if (window.lucide) window.lucide.createIcons(); }, [name, size, className]);
    return <i data-lucide={name} className={`w-${size} h-${size} ${className}`}></i>;
};

const Card = ({ children, className = "" }) => (
    <div className={`bg-white rounded-[32px] border border-slate-200 shadow-sm p-6 ${className}`}>
        {children}
    </div>
);

const StatusBadge = ({ status }) => {
    const styles = {
        'Belum': 'bg-danger/10 text-danger border-danger/10',
        'Proses': 'bg-warning/10 text-warning border-warning/10',
        'Selesai': 'bg-success/10 text-success border-success/10',
        'Aktif': 'bg-primary/10 text-primary border-primary/10',
        'Baru': 'bg-success/10 text-success border-success/10'
    };
    return (
        <span className={`px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border ${styles[status] || 'bg-slate-100 text-slate-500'}`}>
            {status}
        </span>
    );
};

const Header = ({ title, subtitle, user }) => (
    <header className="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-100 px-8 py-6 flex items-center justify-between">
        <div>
            <h2 className="text-xl font-bold text-slate-800">{title} 👋</h2>
            <p className="text-xs text-slate-500 font-medium">{subtitle}</p>
        </div>
        <div className="flex items-center gap-4">
            <button className="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-primary/10 hover:text-primary transition-all">
                <Icon name="bell" size={5} />
            </button>
            <div className="h-10 w-px bg-slate-100 mx-2"></div>
            <div className="flex items-center gap-3">
                <div className="text-right hidden md:block">
                    <p className="text-xs font-bold text-slate-800">{user.name}</p>
                    <p className="text-[10px] text-slate-500 font-medium uppercase">{user.role}</p>
                </div>
                <div className="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center font-bold shadow-inner">
                    {user.name.charAt(0)}
                </div>
            </div>
        </div>
    </header>
);

const Sidebar = ({ activeMenu, setActiveMenu, stases = [], onSelectRoom, selectedStaseId, selectedRoomId }) => {
    return (
        <aside className="w-72 bg-white border-r border-slate-200 flex flex-col fixed h-full z-50">
            <div className="p-8 border-b border-slate-50">
                <div className="flex items-center gap-3">
                    <div className="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <Icon name="graduation-cap" size={6} />
                    </div>
                    <div>
                        <h1 className="text-sm font-black text-slate-800 uppercase tracking-tighter">CI Portal</h1>
                        <p className="text-[10px] font-bold text-slate-400 uppercase tracking-widest">RSUD SIM Diklat</p>
                    </div>
                </div>
            </div>

            <nav className="flex-1 p-6 space-y-2 overflow-y-auto custom-scrollbar">
                <button
                    onClick={() => { setActiveMenu('dashboard'); onSelectRoom(null, null); }}
                    className={`w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-bold transition-all duration-300 ${activeMenu === 'dashboard' ? 'bg-primary text-white shadow-lg shadow-primary/20 scale-[1.02]' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600'}`}
                >
                    <Icon name="layout-dashboard" size={5} />
                    Dashboard
                </button>

                <div className="pt-4 pb-2">
                    <p className="text-[10px] font-black text-slate-400 uppercase tracking-widest px-4">Stase & Ruangan Anda</p>
                </div>

                {stases.map((st) => (
                    <div key={st.stase_id} className="space-y-1">
                        <div className="flex items-center gap-3 px-4 py-2 text-xs font-bold text-slate-700">
                            <Icon name="route" size={4} className="text-primary" />
                            <span>{st.nama_stase}</span>
                        </div>
                        <div className="pl-6 space-y-1">
                            {st.rooms.map((room) => {
                                const isSelected = selectedStaseId === st.stase_id && selectedRoomId === room.ruangan_id;
                                return (
                                    <button
                                        key={room.ruangan_id}
                                        onClick={() => {
                                            setActiveMenu('room_detail');
                                            onSelectRoom(st, room);
                                        }}
                                        className={`w-full flex items-center justify-between px-4 py-2.5 rounded-xl text-xs font-bold transition-all ${isSelected ? 'bg-primary/10 text-primary' : 'text-slate-500 hover:bg-slate-50'}`}
                                    >
                                        <div className="flex items-center gap-2">
                                            <Icon name="map-pin" size={3.5} />
                                            <span>{room.nama_unit}</span>
                                        </div>
                                        <span className={`px-2 py-0.5 rounded-full text-[9px] ${isSelected ? 'bg-primary text-white' : 'bg-slate-100 text-slate-400'}`}>
                                            {room.mahasiswa_count}
                                        </span>
                                    </button>
                                );
                            })}
                        </div>
                    </div>
                ))}
            </nav>

            <div className="p-6 border-t border-slate-50">
                <a href="/pendidikan/login" className="w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-sm font-bold text-danger hover:bg-danger/5 transition-all">
                    <Icon name="log-out" size={5} />
                    Keluar Sistem
                </a>
            </div>
        </aside>
    );
};

const RevisionModal = ({ isOpen, onClose, onConfirm }) => {
    const [note, setNote] = useState('');
    if (!isOpen) return null;

    return (
        <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-fade-in">
            <div className="bg-white rounded-3xl w-full max-w-lg shadow-2xl overflow-hidden animate-slide-up">
                <div className="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 className="text-lg font-bold text-slate-800">Minta Revisi</h3>
                    <button onClick={onClose} className="p-2 hover:bg-slate-50 rounded-xl transition-colors">
                        <Icon name="x" size={5} className="text-slate-400" />
                    </button>
                </div>
                <div className="p-8 space-y-4">
                    <label className="block text-xs font-bold text-slate-400 uppercase tracking-widest">Catatan Revisi</label>
                    <textarea 
                        className="w-full h-32 p-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary/20 transition-all outline-none resize-none"
                        placeholder="Tuliskan bagian mana yang perlu diperbaiki oleh mahasiswa..."
                        value={note}
                        onChange={(e) => setNote(e.target.value)}
                    ></textarea>
                </div>
                <div className="p-6 bg-slate-50 flex gap-3">
                    <button onClick={onClose} className="flex-1 px-4 py-3 border border-slate-200 text-slate-500 font-bold rounded-xl hover:bg-white transition-all text-sm">Batal</button>
                    <button 
                        onClick={() => { onConfirm(note); onClose(); }}
                        className="flex-1 px-4 py-3 bg-warning text-white font-bold rounded-xl hover:bg-warning-dark transition-all text-sm shadow-lg shadow-warning/20"
                    >
                        Kirim Revisi
                    </button>
                </div>
            </div>
        </div>
    );
};
