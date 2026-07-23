<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CS402: Distributed Systems - CarryOn</title>
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
        <div class="px-6 py-5 flex items-center gap-3 border-b border-gray-100">
            <a href="/StudentDashboard" class="flex items-center gap-3">
                <img src="{{ asset('images/carryon_logo_mark_v2.png') }}" class="w-9 h-9 object-contain" alt="CarryOn Logo">
                <div>
                    <span class="font-bold text-lg tracking-tight text-gray-900 block">CarryOn</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold block -mt-1">Student Portal</span>
                </div>
            </a>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="/StudentDashboard" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">grid_view</span>
                <span>Dashboard</span>
            </a>
            <div class="pt-3 pb-1.5">
                <p class="px-3.5 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">Current Class</p>
            </div>
            <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium">
                <span class="material-symbols-outlined text-[20px]">class</span>
                <span>CS402</span>
            </a>
            <a href="/student/class/cs402/contribution" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">monitoring</span>
                <span>Contribution</span>
            </a>
            <a href="/student/class/cs402/group-status" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">groups</span>
                <span>Group Status</span>
            </a>
            <a href="/student/class/cs402/leader-vote" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">how_to_vote</span>
                <span>Leader Vote</span>
            </a>
            <a href="/student/class/cs402/task-manager" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">assignment</span>
                <span>Task Manager</span>
            </a>
            <a href="/student/class/cs402/file-repository" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">folder_open</span>
                <span>File Repository</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-150">
            <a href="/login" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">logout</span>
                <span>Log Out</span>
            </a>
        </div>
    </aside>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto main-scroll">
        <!-- Top Bar -->
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 lg:px-10 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="/StudentDashboard" class="text-gray-400 hover:text-gray-900 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">CS402: Distributed Systems</h1>
                        <p class="text-sm text-gray-500 mt-0.5">Prof. Dr. Santos · MWF 10:00 AM · Group Alpha</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200">
                        <span class="material-symbols-outlined text-[20px] text-gray-600">person</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">
            <!-- Class Quick Stats -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 animate-in">
                <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">My Score</p>
                    <p class="text-3xl font-bold text-gray-900">91<span class="text-sm font-medium text-gray-400">%</span></p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">Group Members</p>
                    <p class="text-3xl font-bold text-gray-900">5</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">Pending Tasks</p>
                    <p class="text-3xl font-bold text-amber-600">3</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">Project Manager</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">Maria C.</p>
                </div>
            </div>

            <!-- Action Cards Grid -->
            <h2 class="text-lg font-bold text-gray-900 mb-1 animate-in animate-in-delay-1">Quick Actions</h2>
            <p class="text-sm text-gray-500 mb-5 animate-in animate-in-delay-1">Navigate to the tools you need for this class</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                <!-- Contribution Score -->
                <a href="/student/class/cs402/contribution" class="action-card bg-white rounded-xl border border-gray-200 p-6 group animate-in animate-in-delay-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600 text-[26px]">monitoring</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-900 group-hover:translate-x-1 transition-all">arrow_forward</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">Contribution Score</h3>
                    <p class="text-sm text-gray-500 mb-4">View your real-time contribution score, breakdown, and trends for this class.</p>
                    <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                        <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-600 rounded-full progress-bar-fill" style="width: 91%"></div>
                        </div>
                        <span class="text-xs font-bold text-blue-600">91%</span>
                    </div>
                </a>

                <!-- Group Status Monitoring -->
                <a href="/student/class/cs402/group-status" class="action-card bg-white rounded-xl border border-gray-200 p-6 group animate-in animate-in-delay-2">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-emerald-600 text-[26px]">groups</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-900 group-hover:translate-x-1 transition-all">arrow_forward</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">Group Status</h3>
                    <p class="text-sm text-gray-500 mb-4">Monitor your group members' contribution percentages and overall progress.</p>
                    <div class="flex items-center gap-1.5 pt-3 border-t border-gray-100">
                        <div class="flex -space-x-2">
                            <div class="w-6 h-6 rounded-full bg-blue-200 border-2 border-white flex items-center justify-center text-[9px] font-bold text-blue-800">A</div>
                            <div class="w-6 h-6 rounded-full bg-green-200 border-2 border-white flex items-center justify-center text-[9px] font-bold text-green-800">M</div>
                            <div class="w-6 h-6 rounded-full bg-purple-200 border-2 border-white flex items-center justify-center text-[9px] font-bold text-purple-800">J</div>
                            <div class="w-6 h-6 rounded-full bg-amber-200 border-2 border-white flex items-center justify-center text-[9px] font-bold text-amber-800">R</div>
                            <div class="w-6 h-6 rounded-full bg-pink-200 border-2 border-white flex items-center justify-center text-[9px] font-bold text-pink-800">S</div>
                        </div>
                        <span class="text-xs text-gray-500 ml-1">5 members</span>
                    </div>
                </a>

                <!-- Leader Vote -->
                <a href="/student/class/cs402/leader-vote" class="action-card bg-white rounded-xl border border-gray-200 p-6 group animate-in animate-in-delay-3">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-purple-600 text-[26px]">how_to_vote</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-900 group-hover:translate-x-1 transition-all">arrow_forward</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">Leader Vote</h3>
                    <p class="text-sm text-gray-500 mb-4">Vote for your Project Manager or view current election results.</p>
                    <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                        <span class="badge badge-elected">
                            <span class="material-symbols-outlined text-[12px]">check_circle</span>
                            PM Elected: Maria C.
                        </span>
                    </div>
                </a>

                <!-- Task Manager -->
                <a href="/student/class/cs402/task-manager" class="action-card bg-white rounded-xl border border-gray-200 p-6 group animate-in animate-in-delay-4">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-amber-600 text-[26px]">assignment</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-900 group-hover:translate-x-1 transition-all">arrow_forward</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">Task Manager</h3>
                    <p class="text-sm text-gray-500 mb-4">View, download, and submit assigned tasks. PM can assign & approve tasks.</p>
                    <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                        <span class="badge badge-pending">3 Pending</span>
                        <span class="badge badge-submitted">1 Awaiting PM</span>
                    </div>
                </a>

                <!-- File Repository -->
                <a href="/student/class/cs402/file-repository" class="action-card bg-white rounded-xl border border-gray-200 p-6 group animate-in animate-in-delay-5">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-rose-600 text-[26px]">folder_open</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-900 group-hover:translate-x-1 transition-all">arrow_forward</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">File Repository</h3>
                    <p class="text-sm text-gray-500 mb-4">Upload, download, and manage shared project files with your group.</p>
                    <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                        <span class="text-xs text-gray-500">
                            <span class="material-symbols-outlined text-[14px] mr-0.5">description</span>
                            12 files · 48.3 MB
                        </span>
                    </div>
                </a>
                <!-- Check-In Request -->
                <a href="/student/class/cs402/checkin" class="action-card bg-white rounded-xl border border-gray-200 p-6 group animate-in animate-in-delay-5">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center">
                            <span class="material-symbols-outlined text-indigo-600 text-[26px]">event_available</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-900 group-hover:translate-x-1 transition-all">arrow_forward</span>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1">Check-In Request</h3>
                    <p class="text-sm text-gray-500 mb-4">Request a check-in meeting with your instructor and view approval status.</p>
                    <div class="flex items-center gap-2 pt-3 border-t border-gray-100">
                        <span class="badge badge-pending">1 Pending</span>
                    </div>
                </a>
            </div>

            <!-- Group Progress Overview -->
            <div class="animate-in animate-in-delay-5">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Group Alpha — Progress Overview</h2>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-sm text-gray-500">Overall Project Completion</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">68%</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Milestone</p>
                            <p class="text-sm font-bold text-gray-900">Phase 2 of 4</p>
                        </div>
                    </div>
                    <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full progress-bar-fill" style="width: 68%"></div>
                    </div>
                    <div class="flex justify-between mt-2 text-[10px] uppercase tracking-wider text-gray-400 font-semibold">
                        <span>Phase 1 ✓</span>
                        <span class="text-blue-600">Phase 2 — In Progress</span>
                        <span>Phase 3</span>
                        <span>Phase 4</span>
                    </div>
                </div>
            </div>
        </div>

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

        // Animate progress bars on load
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.progress-bar-fill').forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => { bar.style.width = width; }, 300);
            });
        });
    </script>
</body>
</html>
