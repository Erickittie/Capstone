<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real-Time Task Ledger - CarryOn Academic Management</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/group-assignment.css') }}" rel="stylesheet">
    <link href="{{ asset('css/task-ledger.css') }}" rel="stylesheet">
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



            <!-- Task Ledger (Active) -->
            <a href="/instructor/task-ledger" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-100 text-gray-900 rounded-lg text-[14px] font-semibold transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-950">format_list_bulleted</span>
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

        <!-- Main Body Layout: Split between Center Content and Right Sidebar -->
        <div class="flex-1 flex flex-col lg:flex-row min-h-0 overflow-y-auto">
            
            <!-- CENTER: Ledger Table -->
            <main class="flex-1 p-6 md:p-8 space-y-6 overflow-y-auto">
                
                <!-- Category Title with Filters -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-gray-200 pb-3 mb-4">
                    <div class="flex items-center gap-3">
                        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Real-Time Task Ledger</h2>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 text-[10px] font-bold bg-red-50 text-red-600 rounded-full tracking-wider uppercase">
                            <span class="w-1.5 h-1.5 bg-red-600 rounded-full animate-ping"></span>
                            <span>Live Sync</span>
                        </span>
                    </div>
                    
                    <!-- Filters -->
                    <div class="flex gap-2">
                        <select class="border border-gray-200 rounded-lg py-1 px-3 bg-white focus:outline-none focus:ring-1 focus:ring-black text-xs font-semibold text-gray-600">
                            <option>All Classes</option>
                            <option>Advanced AI Ethics (CS-402)</option>
                            <option>Quantitative Analysis II (MAT-301)</option>
                        </select>
                        <select class="border border-gray-200 rounded-lg py-1 px-3 bg-white focus:outline-none focus:ring-1 focus:ring-black text-xs font-semibold text-gray-600">
                            <option>All Statuses</option>
                            <option>To Do</option>
                            <option>In Progress</option>
                            <option>Under Review</option>
                            <option>Completed</option>
                        </select>
                    </div>
                </div>

                <!-- Ledger Entries Table Card -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                                    <th class="px-6 py-3">Task Description</th>
                                    <th class="px-6 py-3">Assigned To</th>
                                    <th class="px-6 py-3">Group</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Last Committed</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="ledger-body" class="divide-y divide-gray-150 text-[13px] text-gray-900">
                                <!-- Task 1 -->
                                <tr id="task-row-1" class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900">Literature Review: Data Privacy</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-[10px]">LC</div>
                                            <span>Liam Chen</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 font-medium">Group Alpha</td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">In Progress</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 font-mono text-xs">2 mins ago</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="p-1 text-gray-400 hover:text-gray-900 rounded transition"><span class="material-symbols-outlined text-[18px]">more_horiz</span></button>
                                    </td>
                                </tr>

                                <!-- Task 2 -->
                                <tr id="task-row-2" class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900">Initial API Documentation</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-[10px]">SM</div>
                                            <span>Sarah Miller</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 font-medium">Group Beta</td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Under Review</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 font-mono text-xs">10 mins ago</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="p-1 text-gray-400 hover:text-gray-900 rounded transition"><span class="material-symbols-outlined text-[18px]">more_horiz</span></button>
                                    </td>
                                </tr>

                                <!-- Task 3 -->
                                <tr id="task-row-3" class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900">Database Schema Design</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-purple-50 text-purple-700 flex items-center justify-center font-bold text-[10px]">EW</div>
                                            <span>Emma Wilson</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 font-medium">Group Gamma</td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 font-mono text-xs">25 mins ago</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="p-1 text-gray-400 hover:text-gray-900 rounded transition"><span class="material-symbols-outlined text-[18px]">more_horiz</span></button>
                                    </td>
                                </tr>

                                <!-- Task 4 -->
                                <tr id="task-row-4" class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-semibold text-gray-900">Unit Testing Framework</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-[10px]">MA</div>
                                            <span>Marcus Aurelius</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 font-medium">Group Beta</td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">To Do</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-400 font-mono text-xs">1 hour ago</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="p-1 text-gray-400 hover:text-gray-900 rounded transition"><span class="material-symbols-outlined text-[18px]">more_horiz</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

            <!-- RIGHT: Live Activity Feed -->
            <aside class="w-full lg:w-[320px] bg-white border-t lg:border-t-0 lg:border-l border-gray-200 flex flex-col shrink-0 overflow-y-auto">
                <div class="p-4 border-b border-gray-200 flex items-center justify-between bg-gray-50/50 shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-gray-500">trending_up</span>
                        <h3 class="text-[14px] font-bold text-gray-900">Activity Feed</h3>
                    </div>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                </div>
                
                <div id="live-activity-feed" class="p-4 space-y-4 overflow-y-auto flex-1 divide-y divide-gray-100">
                    <!-- Feed item 1 -->
                    <div class="pt-3 first:pt-0 flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-gray-450 mt-0.5">commit</span>
                        <div class="flex-1 text-xs text-gray-700">
                            <p><strong>Emma Wilson</strong> pushed 3 commits to <code class="bg-gray-100 px-1 py-0.5 rounded text-[11px] font-mono">model-refactor</code></p>
                            <span class="text-[10px] text-gray-400 block mt-1">Just now</span>
                        </div>
                    </div>

                    <!-- Feed item 2 -->
                    <div class="pt-3 flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-amber-500 mt-0.5">change_circle</span>
                        <div class="flex-1 text-xs text-gray-700">
                            <p><strong>Liam Chen</strong> moved <strong>Literature Review</strong> to <span class="bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded text-[10px] font-semibold">In Progress</span></p>
                            <span class="text-[10px] text-gray-400 block mt-1">2 mins ago</span>
                        </div>
                    </div>

                    <!-- Feed item 3 -->
                    <div class="pt-3 flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-blue-500 mt-0.5">rate_review</span>
                        <div class="flex-1 text-xs text-gray-700">
                            <p><strong>Sarah Miller</strong> requested feedback on <strong>Initial API Documentation</strong></p>
                            <span class="text-[10px] text-gray-400 block mt-1">10 mins ago</span>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>

    <!-- Live updates simulation script -->
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



        // Sim updates
        const ledgerBody = document.getElementById('ledger-body');
        const feedContainer = document.getElementById('live-activity-feed');

        const simulatedUpdates = [
            {
                rowId: 'task-row-4',
                newStatus: 'In Progress',
                badgeClass: 'status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800',
                timeText: 'Just now',
                feedIcon: 'change_circle',
                feedIconColor: 'text-amber-500',
                feedMessage: '<strong>Marcus Aurelius</strong> moved <strong>Unit Testing Framework</strong> to <span class="bg-amber-100 text-amber-800 px-1.5 py-0.5 rounded text-[10px] font-semibold">In Progress</span>'
            },
            {
                rowId: 'task-row-1',
                newStatus: 'Under Review',
                badgeClass: 'status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800',
                timeText: 'Just now',
                feedIcon: 'rate_review',
                feedIconColor: 'text-blue-500',
                feedMessage: '<strong>Liam Chen</strong> requested review for <strong>Literature Review: Data Privacy</strong>'
            },
            {
                rowId: 'task-row-2',
                newStatus: 'Completed',
                badgeClass: 'status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800',
                timeText: 'Just now',
                feedIcon: 'check_circle',
                feedIconColor: 'text-emerald-500',
                feedMessage: '<strong>Sarah Miller</strong> completed <strong>Initial API Documentation</strong>'
            }
        ];

        let simulatedIndex = 0;

        function runLiveUpdateSimulation() {
            if (simulatedIndex >= simulatedUpdates.length) {
                simulatedIndex = 0;
            }

            const update = simulatedUpdates[simulatedIndex];

            // Update table row
            const row = document.getElementById(update.rowId);
            if (row) {
                row.classList.add('flash-update');
                setTimeout(() => row.classList.remove('flash-update'), 2000);

                const badge = row.querySelector('.status-badge');
                if (badge) {
                    badge.textContent = update.newStatus;
                    badge.className = update.badgeClass;
                }

                const timeCell = row.cells[4];
                if (timeCell) {
                    timeCell.textContent = update.timeText;
                }
            }

            // Prepend feed item
            const feedItem = document.createElement('div');
            feedItem.className = 'pt-3 flex items-start gap-2.5 border-t border-gray-100';
            feedItem.innerHTML = `
                <span class="material-symbols-outlined ${update.feedIconColor} mt-0.5">${update.feedIcon}</span>
                <div class="flex-1 text-xs text-gray-700">
                    <p>${update.feedMessage}</p>
                    <span class="text-[10px] text-gray-400 block mt-1">${update.timeText}</span>
                </div>
            `;

            feedContainer.insertBefore(feedItem, feedContainer.firstChild);

            // Clean up old ones
            if (feedContainer.children.length > 8) {
                feedContainer.removeChild(feedContainer.lastChild);
            }

            simulatedIndex++;
        }

        setInterval(runLiveUpdateSimulation, 6000);

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
