<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard - CarryOn</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/student-pages.css') }}" rel="stylesheet">
</head>
<body class="h-full text-gray-900 antialiased font-sans bg-[#F9FAFB] flex flex-col md:flex-row overflow-hidden">

    <!-- Mobile Menu Bar -->
    <div class="md:hidden flex items-center justify-between bg-[#FAF9FB] px-4 py-3 border-b border-gray-200 sticky top-0 z-40">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/carryon_logo_mark_v2.png') }}" class="w-8 h-8 object-contain" alt="CarryOn Logo">
            <div>
                <span class="font-bold text-base tracking-tight text-gray-900">CarryOn</span>
                <p class="text-[9px] uppercase tracking-wider text-gray-500 font-medium -mt-1">Student Portal</p>
            </div>
        </div>
        <button id="mobile-menu-toggle" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-[#FAF9FB] border-r border-gray-200 flex flex-col transform -translate-x-full md:translate-x-0 md:static transition-transform duration-300 ease-in-out">
        <!-- Logo -->
        <div class="px-6 py-5 flex items-center gap-3 border-b border-gray-100">
            <a href="/StudentDashboard" class="flex items-center gap-3">
                <img src="{{ asset('images/carryon_logo_mark_v2.png') }}" class="w-9 h-9 object-contain" alt="CarryOn Logo">
                <div>
                    <span class="font-bold text-lg tracking-tight text-gray-900 block">CarryOn</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold block -mt-1">Student Portal</span>
                </div>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="/StudentDashboard" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px]">grid_view</span>
                <span>Dashboard</span>
            </a>
           <a href="/student/notifications" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">notifications</span>
                <span>Notifications</span>
                <span class="ml-auto bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center">3</span>
            </a>
            <a href="/student/profile" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">person</span>
                <span>Profile</span>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-gray-150 space-y-1">
            <a href="/login" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">logout</span>
                <span>Log Out</span>
            </a>
        </div>
    </aside>

    <!-- Overlay for mobile menu -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto main-scroll">
        <!-- Top Bar -->
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 lg:px-10 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-gray-900 tracking-tight">Dashboard</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Welcome back, Alex</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">Current Semester</p>
                        <p class="text-sm font-bold text-gray-900">Fall 2024</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200">
                        <span class="material-symbols-outlined text-[20px] text-gray-600">person</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">
            <!-- Quick Stats Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8 animate-in">
                <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
                    <div class="w-11 h-11 rounded-lg bg-blue-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 text-[22px]">monitoring</span>
                    </div>
                    <div>
                        <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold">Avg. Contribution</p>
                        <p class="text-2xl font-bold text-gray-900">87<span class="text-sm font-medium text-gray-400">%</span></p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
                    <div class="w-11 h-11 rounded-lg bg-amber-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-600 text-[22px]">assignment</span>
                    </div>
                    <div>
                        <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold">Active Tasks</p>
                        <p class="text-2xl font-bold text-gray-900">12</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-5 flex items-center gap-4">
                    <div class="w-11 h-11 rounded-lg bg-indigo-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-indigo-600 text-[22px]">event_available</span>
                </div>
                <div>
                    <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold">Check-In Pending</p>
                    <p class="text-2xl font-bold text-gray-900">1</p>
                </div>
            </div>
        </div>  

            <!-- My Enrolled Classes -->
            <div class="mb-6 animate-in animate-in-delay-1">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">My Enrolled Classes</h2>
                        <p class="text-sm text-gray-500 mt-0.5">Select a class to view your groups and contributions</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <!-- Class Card 1 -->
                    <a href="/student/class/cs402" class="action-card bg-white rounded-xl border border-gray-200 overflow-hidden group">
                        <div class="h-2 bg-gradient-to-r from-blue-600 to-indigo-600"></div>
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-blue-600 text-[22px]">dns</span>
                                </div>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full">Active</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-base mb-1">CS402: Distributed Systems</h3>
                            <p class="text-sm text-gray-500 mb-4">Prof. Dr. Santos · MWF 10:00 AM</p>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-1.5 text-sm text-gray-500">
                                        <span class="material-symbols-outlined text-[16px]">group</span>
                                        <span>3 Groups</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-sm text-gray-500">
                                        <span class="material-symbols-outlined text-[16px]">assignment</span>
                                        <span>5 Tasks</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-gray-400 group-hover:text-gray-900 group-hover:translate-x-1 transition-all text-[20px]">arrow_forward</span>
                            </div>
                        </div>
                    </a>

                    <!-- Class Card 2 -->
                    <a href="/student/class/psy310" class="action-card bg-white rounded-xl border border-gray-200 overflow-hidden group">
                        <div class="h-2 bg-gradient-to-r from-emerald-500 to-teal-500"></div>
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-emerald-600 text-[22px]">psychology</span>
                                </div>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full">Active</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-base mb-1">PSY310: Cognitive Architecture</h3>
                            <p class="text-sm text-gray-500 mb-4">Prof. Reyes · TTh 1:30 PM</p>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-1.5 text-sm text-gray-500">
                                        <span class="material-symbols-outlined text-[16px]">group</span>
                                        <span>2 Groups</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-sm text-gray-500">
                                        <span class="material-symbols-outlined text-[16px]">assignment</span>
                                        <span>3 Tasks</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-gray-400 group-hover:text-gray-900 group-hover:translate-x-1 transition-all text-[20px]">arrow_forward</span>
                            </div>
                        </div>
                    </a>

                    <!-- Class Card 3 -->
                    <a href="/student/class/art205" class="action-card bg-white rounded-xl border border-gray-200 overflow-hidden group">
                        <div class="h-2 bg-gradient-to-r from-violet-500 to-purple-500"></div>
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-10 h-10 rounded-lg bg-violet-50 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-violet-600 text-[22px]">palette</span>
                                </div>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-violet-600 bg-violet-50 px-2.5 py-1 rounded-full">Active</span>
                            </div>
                            <h3 class="font-bold text-gray-900 text-base mb-1">ART205: Digital Ethics</h3>
                            <p class="text-sm text-gray-500 mb-4">Prof. Garcia · MWF 2:00 PM</p>
                            <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-1.5 text-sm text-gray-500">
                                        <span class="material-symbols-outlined text-[16px]">group</span>
                                        <span>4 Groups</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-sm text-gray-500">
                                        <span class="material-symbols-outlined text-[16px]">assignment</span>
                                        <span>4 Tasks</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-gray-400 group-hover:text-gray-900 group-hover:translate-x-1 transition-all text-[20px]">arrow_forward</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="animate-in animate-in-delay-2">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Activity</h2>
                <div class="bg-white rounded-xl border border-gray-200 divide-y divide-gray-100">
                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-9 h-9 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Task "API Documentation" approved by PM</p>
                            <p class="text-xs text-gray-400">CS402 · Group Alpha · 2 hours ago</p>
                        </div>
                        <span class="badge badge-approved">Approved</span>
                    </div>
                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-9 h-9 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-blue-600 text-[18px]">how_to_vote</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Leader vote started for Group Beta</p>
                            <p class="text-xs text-gray-400">PSY310 · 5 hours ago</p>
                        </div>
                        <span class="badge badge-pending">Vote Open</span>
                    </div>
                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-9 h-9 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-amber-600 text-[18px]">upload_file</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Maria uploaded "Research_Notes_v2.pdf"</p>
                            <p class="text-xs text-gray-400">ART205 · Group Delta · Yesterday</p>
                        </div>
                        <span class="badge badge-progress">File Added</span>
                    </div>
                    <div class="flex items-center gap-4 px-5 py-4">
                        <div class="w-9 h-9 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-red-600 text-[18px]">undo</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Task "Database Schema" returned for revision</p>
                            <p class="text-xs text-gray-400">CS402 · Group Alpha · Yesterday</p>
                        </div>
                        <span class="badge badge-revision">Revision</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="px-6 lg:px-10 py-6 border-t border-gray-100 mt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-3 max-w-7xl mx-auto">
                <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">CarryOn Academic Systems</span>
                <span class="text-xs text-gray-400">© 2024 CarryOn Academic Systems.</span>
            </div>
        </footer>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>