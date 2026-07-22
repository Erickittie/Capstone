<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Class - CarryOn Academic Management</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/create-class.css') }}" rel="stylesheet">
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
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">
            
            <!-- Welcome Header Row -->
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Create a New Class</h1>
                <p class="text-gray-500 text-[14px] mt-0.5">Establish your class workspace, register academic parameters, and import your student roster.</p>
            </div>

            <!-- Two-Column Workspace Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">
                
                <!-- Left Section: Details Form (3 Columns wide) -->
                <div class="lg:col-span-3 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-150">
                        <h2 class="text-[15px] font-semibold text-gray-900">Class Details</h2>
                    </div>
                    <form class="p-6 space-y-5" onsubmit="event.preventDefault(); alert('Demo Class Created Successfully!');">
                        <!-- Course Name & Code -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="sm:col-span-2">
                                <label for="course-name" class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Course Name</label>
                                <input type="text" id="course-name" placeholder="e.g. Intro to Applied Cryptography" class="w-full border border-gray-200 rounded-lg text-[14px] py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition bg-gray-50/50">
                            </div>
                            <div>
                                <label for="course-code" class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Course Code</label>
                                <input type="text" id="course-code" placeholder="e.g. CS-450" class="w-full border border-gray-200 rounded-lg text-[14px] py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition bg-gray-50/50">
                            </div>
                        </div>

                        <!-- Department & Term -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="dept" class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Department</label>
                                <select id="dept" class="w-full border border-gray-200 rounded-lg text-[14px] py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition bg-gray-50/50">
                                    <option>Computer Science</option>
                                    <option>Mathematics & Statistics</option>
                                    <option>Data Science & AI</option>
                                    <option>Engineering</option>
                                </select>
                            </div>
                            <div>
                                <label for="term" class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Term/Semester</label>
                                <select id="term" class="w-full border border-gray-200 rounded-lg text-[14px] py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition bg-gray-50/50">
                                    <option>Fall 2026</option>
                                    <option>Spring 2027</option>
                                    <option>Summer 2026</option>
                                </select>
                            </div>
                        </div>

                        <!-- Course Description -->
                        <div>
                            <label for="desc" class="block text-[12px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Course Description</label>
                            <textarea id="desc" rows="4" placeholder="Describe the course goals, lecture hours, and grading policies..." class="w-full border border-gray-200 rounded-lg text-[14px] py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition bg-gray-50/50"></textarea>
                        </div>

                        <!-- Action Submit -->
                        <div class="pt-2">
                            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-black hover:bg-gray-800 text-white font-medium text-[14px] rounded-lg shadow-sm hover:shadow transition duration-200">
                                Save Class and Initialize Roster
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Section: Import CSV Roster (2 Columns wide) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Uploader Container -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">
                        <div class="flex items-center justify-between border-b border-gray-150 pb-3">
                            <h2 class="text-[15px] font-semibold text-gray-900">Import Student Roster</h2>
                            <span class="material-symbols-outlined text-gray-500 text-[20px]">upload_file</span>
                        </div>
                        
                        <!-- Drag-and-drop zone -->
                        <div id="drop-zone" class="border-2 border-dashed border-gray-200 hover:border-black rounded-xl p-8 text-center cursor-pointer transition bg-gray-50/50 hover:bg-gray-50 flex flex-col items-center justify-center space-y-3 group">
                            <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-black transition">cloud_upload</span>
                            <div>
                                <p class="text-[14px] font-semibold text-gray-900">Drag & drop your CSV file here</p>
                                <p class="text-[11px] text-gray-400 mt-1">Accepts standard roster CSV files (Name, Email, StudentID)</p>
                            </div>
                            <input type="file" id="csv-file-input" class="hidden" accept=".csv">
                            <button type="button" id="browse-btn" class="px-4 py-2 border border-gray-200 hover:bg-white text-gray-700 font-semibold text-[12px] rounded-lg transition duration-200 bg-gray-50">
                                Browse Files
                            </button>
                        </div>

                        <!-- Template download -->
                        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg border border-gray-150">
                            <div class="flex items-center gap-2.5">
                                <span class="material-symbols-outlined text-gray-500">download_sheet</span>
                                <div class="text-[12px]">
                                    <span class="font-semibold block text-gray-900">Roster Template</span>
                                    <span class="text-gray-400 block -mt-0.5">CSV formatting template</span>
                                </div>
                            </div>
                            <a href="#" class="text-[12px] font-semibold text-gray-900 hover:underline">Download</a>
                        </div>
                    </div>

                    <!-- Interactive CSV Preview table -->
                    <div id="roster-preview-card" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hidden transition-all duration-300">
                        <div class="px-6 py-4 border-b border-gray-150 flex items-center justify-between">
                            <h2 class="text-[14px] font-semibold text-gray-900">Import Preview (<span id="student-count">0</span> students)</h2>
                            <button id="clear-roster-btn" class="text-[11px] text-red-500 font-semibold hover:underline">Clear</button>
                        </div>
                        <div class="max-h-60 overflow-y-auto">
                            <table class="w-full text-left border-collapse">
                                <tbody id="roster-preview-body" class="divide-y divide-gray-150 text-[13px]">
                                    <!-- Dynamic rows loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>

    <!-- Roster preview script & responsive sidebar -->
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



        // CSV upload simulation
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('csv-file-input');
        const browseBtn = document.getElementById('browse-btn');
        const previewCard = document.getElementById('roster-preview-card');
        const previewBody = document.getElementById('roster-preview-body');
        const studentCountSpan = document.getElementById('student-count');
        const clearBtn = document.getElementById('clear-roster-btn');

        const mockStudents = [
            { id: "2026-9041", name: "Liam Chen", email: "l.chen@institution.edu" },
            { id: "2026-8812", name: "Sarah Miller", email: "s.miller@institution.edu" },
            { id: "2026-3401", name: "Emma Wilson", email: "e.wilson@institution.edu" },
            { id: "2026-9099", name: "Marcus Aurelius", email: "m.aurelius@institution.edu" },
            { id: "2026-7811", name: "Sophia Reynolds", email: "s.reynolds@institution.edu" }
        ];

        function handleFileSelection() {
            // Load mock parsed students
            previewBody.innerHTML = '';
            mockStudents.forEach(st => {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-gray-50/50 transition';
                tr.innerHTML = `
                    <td class="px-5 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-black/10 flex items-center justify-center font-bold text-gray-800 text-[12px]">
                            ${st.name.split(' ').map(n => n[0]).join('')}
                        </div>
                        <div>
                            <span class="font-semibold text-gray-900 block leading-tight">${st.name}</span>
                            <span class="text-[11px] text-gray-400 block">${st.email}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3 font-mono text-[11px] text-gray-500">${st.id}</td>
                    <td class="px-5 py-3 text-right">
                        <span class="material-symbols-outlined text-emerald-500 text-[18px]">check_circle</span>
                    </td>
                `;
                previewBody.appendChild(tr);
            });
            
            studentCountSpan.innerText = mockStudents.length;
            previewCard.classList.remove('hidden');
        }

        browseBtn.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', handleFileSelection);

        // Dragover and drop simulation
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-black', 'bg-gray-100/50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-black', 'bg-gray-100/50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-black', 'bg-gray-100/50');
            handleFileSelection();
        });

        clearBtn.addEventListener('click', () => {
            previewCard.classList.add('hidden');
            previewBody.innerHTML = '';
            fileInput.value = '';
        });

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
