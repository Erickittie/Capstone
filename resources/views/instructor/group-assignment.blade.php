<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Group Assignment - CarryOn Academic Management</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/group-assignment.css') }}" rel="stylesheet">
</head>
<body class="h-full text-gray-900 antialiased font-sans bg-[#F9FAFB] flex flex-col md:flex-row overflow-hidden">

    <!-- Mobile Menu Bar -->
    <div class="md:hidden flex items-center justify-between bg-[#FAF9FB] px-4 py-3 border-b border-gray-200 sticky top-0 z-40">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-black flex items-center justify-center text-white">
                <span class="material-symbols-outlined text-lg">school</span>
            </div>
            <div>
                <span class="font-bold text-base tracking-tight text-gray-900">CarryOn</span>
                <p class="text-[9px] uppercase tracking-wider text-gray-500 font-medium -mt-1">Academic Management</p>
            </div>
        </div>
        <button id="mobile-menu-toggle" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-[#FAF9FB] border-r border-gray-200 flex flex-col transform -translate-x-full md:translate-x-0 md:static transition-transform duration-300 ease-in-out">
        <!-- Logo & Header -->
        <div class="px-6 py-5 flex items-center gap-3 border-b border-gray-100">
            <a href="/dashboard" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-[#111827] flex items-center justify-center text-white shadow-sm">
                    <span class="material-symbols-outlined text-xl">school</span>
                </div>
                <div>
                    <span class="font-bold text-lg tracking-tight text-gray-900 block">CarryOn</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold block -mt-1">Academic Management</span>
                </div>
            </a>
        </div>

        <!-- Menu Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <!-- Dashboard -->
            <a href="/dashboard" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">grid_view</span>
                <span>Dashboard</span>
            </a>



            <!-- Task Ledger -->
            <a href="/instructor/task-ledger" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">format_list_bulleted</span>
                <span>Task Ledger</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-gray-150 space-y-1">
            <!-- Log Out -->
            <a href="/login" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">logout</span>
                <span>Log Out</span>
            </a>
        </div>
    </aside>

    <!-- Overlay background when mobile menu is open -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden transition-opacity"></div>

    <!-- Main Workspace Container -->
    <div class="flex-1 flex flex-col overflow-y-auto md:overflow-hidden">

        <!-- Top Header Navigation -->
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between gap-4 shrink-0">
            <!-- Search bar -->
            <div class="flex-1 max-w-lg relative">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                <input type="text" placeholder="Search classes, students, or repositories..." class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-full text-[14px] focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition shadow-sm">
            </div>

            <!-- Header Actions and Profile -->
            <div class="flex items-center gap-4">
                <!-- Notifications icon -->
                <button class="relative p-2 text-gray-600 hover:bg-gray-50 rounded-full transition group">
                    <span class="material-symbols-outlined text-[24px]">notifications</span>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-600 rounded-full ring-2 ring-white"></span>
                </button>

                <!-- Calendar shortcut icon -->
                <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-full transition" onclick="toggleCalendarModal()">
                    <span class="material-symbols-outlined text-[24px]">calendar_today</span>
                </button>

                <!-- Vertical Divider -->
                <div class="h-6 w-px bg-gray-200 hidden sm:block"></div>

                <!-- Instructor Profile -->
                <div class="flex items-center gap-3.5 pl-2">
                    <div class="text-right hidden sm:block">
                        <span class="block text-[14px] font-semibold text-gray-900 leading-tight">Dr. Julian Vance</span>
                        <span class="block text-[11px] text-gray-500 font-medium">Senior Instructor</span>
                    </div>
                    <img src="/images/instructor_avatar.png" alt="Dr. Julian Vance" class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-sm hover:ring-2 hover:ring-black/10 transition cursor-pointer">
                </div>
            </div>
        </header>

        <!-- Inner Content Area -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6 flex flex-col">
            
            <!-- Welcome Header Row & Settings -->
            <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4 shrink-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Student Group Assignment</h1>
                    <p class="text-gray-500 text-[14px] mt-0.5">Organize student teams manually via drag-and-drop or automatically using random allocation.</p>
                </div>
                
                <!-- Random Allocate Controls -->
                <div class="flex flex-wrap items-center gap-3.5 bg-white border border-gray-200 p-3 rounded-xl shadow-sm">
                    <div class="flex items-center gap-2">
                        <label for="groups-count" class="text-[12px] font-bold text-gray-500 uppercase tracking-wider">Groups:</label>
                        <input type="number" id="groups-count" value="3" min="2" max="6" class="w-14 border border-gray-200 rounded-lg text-[13px] py-1 px-2 focus:outline-none focus:ring-1 focus:ring-black focus:border-black">
                    </div>
                    <button id="randomize-btn" class="px-4 py-1.5 bg-black hover:bg-gray-800 text-white rounded-lg text-[13px] font-semibold transition flex items-center gap-1.5 shadow-sm">
                        <span class="material-symbols-outlined text-[16px]">shuffle</span>
                        <span>Auto Allocate</span>
                    </button>
                    <button id="reset-btn" class="px-4 py-1.5 border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-lg text-[13px] font-semibold transition">
                        Reset Board
                    </button>
                </div>
            </div>

            <!-- Drag-and-Drop Board Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 flex-1 min-h-[500px]">
                
                <!-- Left Column: Unassigned Students Pool (1 Column wide) -->
                <div class="lg:col-span-1 bg-white border border-gray-200 rounded-xl shadow-sm flex flex-col h-[580px] lg:h-auto overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-150 flex items-center justify-between shrink-0">
                        <h3 class="text-[14px] font-bold text-gray-900 uppercase tracking-wider">Unassigned Pool</h3>
                        <span id="unassigned-count" class="px-2 py-0.5 text-[11px] font-bold bg-gray-100 text-gray-700 rounded-full">5</span>
                    </div>
                    <div id="unassigned-container" class="p-4 space-y-3 overflow-y-auto flex-1 bg-gray-50/30 border-dashed border-2 border-transparent transition" dropzone="true">
                        <!-- Student cards -->
                        <div id="student-1" draggable="true" class="bg-white border border-gray-200 rounded-lg p-3 shadow-xs hover:border-black cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] shrink-0">drag_indicator</span>
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-[12px] shrink-0">LC</div>
                            <div class="overflow-hidden">
                                <span class="font-semibold text-gray-900 block leading-tight text-[13px] truncate">Liam Chen</span>
                                <span class="text-[10px] text-gray-400 block truncate">l.chen@institution.edu</span>
                            </div>
                        </div>

                        <div id="student-2" draggable="true" class="bg-white border border-gray-200 rounded-lg p-3 shadow-xs hover:border-black cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] shrink-0">drag_indicator</span>
                            <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-[12px] shrink-0">SM</div>
                            <div class="overflow-hidden">
                                <span class="font-semibold text-gray-900 block leading-tight text-[13px] truncate">Sarah Miller</span>
                                <span class="text-[10px] text-gray-400 block truncate">s.miller@institution.edu</span>
                            </div>
                        </div>

                        <div id="student-3" draggable="true" class="bg-white border border-gray-200 rounded-lg p-3 shadow-xs hover:border-black cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] shrink-0">drag_indicator</span>
                            <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-700 flex items-center justify-center font-bold text-[12px] shrink-0">EW</div>
                            <div class="overflow-hidden">
                                <span class="font-semibold text-gray-900 block leading-tight text-[13px] truncate">Emma Wilson</span>
                                <span class="text-[10px] text-gray-400 block truncate">e.wilson@institution.edu</span>
                            </div>
                        </div>

                        <div id="student-4" draggable="true" class="bg-white border border-gray-200 rounded-lg p-3 shadow-xs hover:border-black cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] shrink-0">drag_indicator</span>
                            <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-[12px] shrink-0">MA</div>
                            <div class="overflow-hidden">
                                <span class="font-semibold text-gray-900 block leading-tight text-[13px] truncate">Marcus Aurelius</span>
                                <span class="text-[10px] text-gray-400 block truncate">m.aurelius@institution.edu</span>
                            </div>
                        </div>

                        <div id="student-5" draggable="true" class="bg-white border border-gray-200 rounded-lg p-3 shadow-xs hover:border-black cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] shrink-0">drag_indicator</span>
                            <div class="w-8 h-8 rounded-full bg-pink-50 text-pink-700 flex items-center justify-center font-bold text-[12px] shrink-0">SR</div>
                            <div class="overflow-hidden">
                                <span class="font-semibold text-gray-900 block leading-tight text-[13px] truncate">Sophia Reynolds</span>
                                <span class="text-[10px] text-gray-400 block truncate">s.reynolds@institution.edu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Group containers (3 Columns wide) -->
                <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch h-full lg:h-auto overflow-y-auto">
                    <!-- Group 1 -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm flex flex-col min-h-[350px] overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-150 flex items-center justify-between shrink-0 bg-gray-50/50">
                            <span class="font-semibold text-gray-900 text-[14px]">Group Alpha</span>
                            <span class="group-count text-[11px] font-bold text-gray-500">0 students</span>
                        </div>
                        <div class="group-bin p-4 space-y-3 flex-1 border-2 border-dashed border-transparent transition bg-gray-50/20" dropzone="true" id="group-1">
                            <!-- Draggable cards dropped here -->
                        </div>
                    </div>

                    <!-- Group 2 -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm flex flex-col min-h-[350px] overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-150 flex items-center justify-between shrink-0 bg-gray-50/50">
                            <span class="font-semibold text-gray-900 text-[14px]">Group Beta</span>
                            <span class="group-count text-[11px] font-bold text-gray-500">0 students</span>
                        </div>
                        <div class="group-bin p-4 space-y-3 flex-1 border-2 border-dashed border-transparent transition bg-gray-50/20" dropzone="true" id="group-2">
                            <!-- Draggable cards dropped here -->
                        </div>
                    </div>

                    <!-- Group 3 -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm flex flex-col min-h-[350px] overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-150 flex items-center justify-between shrink-0 bg-gray-50/50">
                            <span class="font-semibold text-gray-900 text-[14px]">Group Gamma</span>
                            <span class="group-count text-[11px] font-bold text-gray-500">0 students</span>
                        </div>
                        <div class="group-bin p-4 space-y-3 flex-1 border-2 border-dashed border-transparent transition bg-gray-50/20" dropzone="true" id="group-3">
                            <!-- Draggable cards dropped here -->
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- Drag-and-drop & logic script -->
    <script>
        // Responsive sidebar logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('mobile-menu-toggle');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        toggleBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);



        // HTML5 Drag and Drop logic
        const draggableCards = document.querySelectorAll('[draggable="true"]');
        const dropBins = document.querySelectorAll('[dropzone="true"]');
        const unassignedContainer = document.getElementById('unassigned-container');

        let draggedCard = null;

        draggableCards.forEach(card => {
            card.addEventListener('dragstart', (e) => {
                draggedCard = card;
                card.style.opacity = '0.5';
                e.dataTransfer.setData('text/plain', card.id);
            });

            card.addEventListener('dragend', () => {
                card.style.opacity = '1';
                draggedCard = null;
                updateCounters();
            });
        });

        dropBins.forEach(bin => {
            bin.addEventListener('dragover', (e) => {
                e.preventDefault();
                bin.classList.add('drag-over');
            });

            bin.addEventListener('dragleave', () => {
                bin.classList.remove('drag-over');
            });

            bin.addEventListener('drop', (e) => {
                e.preventDefault();
                bin.classList.remove('drag-over');
                if (draggedCard) {
                    bin.appendChild(draggedCard);
                    updateCounters();
                }
            });
        });

        function updateCounters() {
            // Unassigned count
            const unassignedCount = unassignedContainer.querySelectorAll('[draggable="true"]').length;
            document.getElementById('unassigned-count').innerText = unassignedCount;

            // Group bins count
            const groups = ['group-1', 'group-2', 'group-3'];
            groups.forEach(gId => {
                const bin = document.getElementById(gId);
                const count = bin.querySelectorAll('[draggable="true"]').length;
                const headerSpan = bin.parentElement.querySelector('.group-count');
                headerSpan.innerText = `${count} student${count === 1 ? '' : 's'}`;
            });
        }

        // Random allocator logic
        const randomizeBtn = document.getElementById('randomize-btn');
        const resetBtn = document.getElementById('reset-btn');

        randomizeBtn.addEventListener('click', () => {
            const allCards = Array.from(document.querySelectorAll('[draggable="true"]'));
            const bins = [
                document.getElementById('group-1'),
                document.getElementById('group-2'),
                document.getElementById('group-3')
            ];

            allCards.forEach((card, index) => {
                const targetBin = bins[index % bins.length];
                // Smooth append
                targetBin.appendChild(card);
            });
            updateCounters();
        });

        resetBtn.addEventListener('click', () => {
            const allCards = Array.from(document.querySelectorAll('[draggable="true"]'));
            allCards.forEach(card => {
                unassignedContainer.appendChild(card);
            });
            updateCounters();
        });

        // Initialize counters
        updateCounters();

        // Calendar modal toggling
        function toggleCalendarModal() {
            const modal = document.getElementById('calendar-modal');
            const card = document.getElementById('calendar-modal-card');
            
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => {
                    card.classList.remove('scale-95', 'opacity-0');
                    card.classList.add('scale-100', 'opacity-100');
                }, 50);
            } else {
                card.classList.remove('scale-100', 'opacity-100');
                card.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 200);
            }
        }
    </script>

    <!-- ========== CALENDAR MODAL OVERLAY ========== -->
    <div id="calendar-modal" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl overflow-hidden border border-gray-100 flex flex-col transform transition-all scale-95 opacity-0 duration-300" id="calendar-modal-card">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-gray-900 to-gray-800 text-white px-5 py-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-white/90">calendar_month</span>
                    <span class="font-bold text-sm tracking-wide">Approved Academic Calendar</span>
                </div>
                <button onclick="toggleCalendarModal()" class="text-white/80 hover:text-white rounded-full p-1 hover:bg-white/10 transition">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-5 space-y-4">
                <!-- Month Display Selector -->
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <span class="font-bold text-sm text-gray-900">July 2026</span>
                    <div class="flex gap-1">
                        <button class="p-1 hover:bg-gray-100 rounded text-gray-500 hover:text-gray-900 transition"><span class="material-symbols-outlined text-[18px]">chevron_left</span></button>
                        <button class="p-1 hover:bg-gray-100 rounded text-gray-500 hover:text-gray-900 transition"><span class="material-symbols-outlined text-[18px]">chevron_right</span></button>
                    </div>
                </div>
                
                <!-- Calendar Month Grid -->
                <div class="grid grid-cols-7 text-center gap-1.5 text-xs text-gray-700">
                    <span class="font-bold text-gray-400">Su</span>
                    <span class="font-bold text-gray-400">Mo</span>
                    <span class="font-bold text-gray-400">Tu</span>
                    <span class="font-bold text-gray-400">We</span>
                    <span class="font-bold text-gray-400">Th</span>
                    <span class="font-bold text-gray-400">Fr</span>
                    <span class="font-bold text-gray-400">Sa</span>
                    
                    <span class="py-1"></span>
                    <span class="py-1"></span>
                    <span class="py-1"></span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">1</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">2</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">3</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">4</span>
                    
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">5</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">6</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">7</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">8</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">9</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">10</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">11</span>
                    
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">12</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">13</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">14</span>
                    <span class="py-1 bg-teal-500 text-white rounded-lg cursor-pointer font-bold relative" title="Groupings Lock (Today)">
                        15
                        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-white rounded-full"></span>
                    </span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">16</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">17</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">18</span>
                    
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">19</span>
                    <span class="py-1 bg-purple-50 hover:bg-purple-100 text-purple-700 border border-purple-250 rounded-lg cursor-pointer font-bold relative" title="Approved peer review slot" onclick="alert('Approved peer consult slot for Group Alpha (July 20 @ 10:00 AM)')">
                        20
                        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-purple-600 rounded-full"></span>
                    </span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">21</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">22</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">23</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">24</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">25</span>
                    
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">26</span>
                    <span class="py-1 bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-250 rounded-lg cursor-pointer font-bold relative" title="Milestone 1 Deliverables Deadline" onclick="alert('Capstone Milestone 1 - Project Scope Document is due July 27 @ 11:59 PM')">
                        27
                        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-amber-600 rounded-full"></span>
                    </span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">28</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">29</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">30</span>
                    <span class="py-1 hover:bg-gray-50 rounded-lg cursor-pointer">31</span>
                </div>
                
                <!-- Approved Events list -->
                <div class="space-y-2 border-t border-gray-100 pt-3">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Approved Events (July)</span>
                    
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-teal-50 border border-teal-100 text-xs transition hover:shadow-xs">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-teal-600 text-[18px]">lock</span>
                            <div>
                                <span class="font-bold text-teal-800 block">Class Groupings Locked</span>
                                <span class="text-teal-600 block mt-0.5">Section A Group allocation finalized</span>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 bg-teal-100 text-teal-800 rounded font-bold text-[9px] uppercase tracking-wider">Today</span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-purple-50 border border-purple-100 text-xs transition hover:shadow-xs">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-purple-600 text-[18px]">meeting_room</span>
                            <div>
                                <span class="font-bold text-purple-800 block">Group Alpha Consultation</span>
                                <span class="text-purple-600 block mt-0.5">July 20 (10:00 AM) &bull; Milestone 1 review</span>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 bg-purple-100 text-purple-800 rounded font-bold text-[9px] uppercase tracking-wider">Approved</span>
                    </div>

                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-amber-50 border border-amber-100 text-xs transition hover:shadow-xs">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600 text-[18px]">priority_high</span>
                            <div>
                                <span class="font-bold text-amber-800 block">Milestone 1 Deliverables</span>
                                <span class="text-amber-600 block mt-0.5">July 27 (11:59 PM) &bull; Project Scope Document</span>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 bg-amber-100 text-amber-800 rounded font-bold text-[9px] uppercase tracking-wider">Deadline</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
