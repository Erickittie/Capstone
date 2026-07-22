<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Group Status - CS402 - CarryOn</title>
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
            <div class="w-8 h-8 rounded-lg bg-black flex items-center justify-center text-white"><span class="material-symbols-outlined text-lg">school</span></div>
            <span class="font-bold text-base tracking-tight text-gray-900">CarryOn</span>
        </div>
        <button id="mobile-menu-toggle" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg"><span class="material-symbols-outlined">menu</span></button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-[#FAF9FB] border-r border-gray-200 flex flex-col transform -translate-x-full md:translate-x-0 md:static transition-transform duration-300 ease-in-out">
        <div class="px-6 py-5 flex items-center gap-3 border-b border-gray-100">
            <a href="/StudentDashboard" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-[#111827] flex items-center justify-center text-white shadow-sm"><span class="material-symbols-outlined text-xl">school</span></div>
                <div>
                    <span class="font-bold text-lg tracking-tight text-gray-900 block">CarryOn</span>
                    <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold block -mt-1">Student Portal</span>
                </div>
            </a>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="/StudentDashboard" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">grid_view</span><span>Dashboard</span>
            </a>
            <div class="pt-3 pb-1.5"><p class="px-3.5 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">CS402</p></div>
            <a href="/student/class/cs402" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">class</span><span>Class Overview</span>
            </a>
            <a href="/student/class/cs402/contribution" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">monitoring</span><span>Contribution</span>
            </a>
            <a href="/student/class/cs402/group-status" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px]">groups</span><span>Group Status</span>
            </a>
            <a href="/student/class/cs402/leader-vote" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">how_to_vote</span><span>Leader Vote</span>
            </a>
            <a href="/student/class/cs402/task-manager" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">assignment</span><span>Task Manager</span>
            </a>
            <a href="/student/class/cs402/file-repository" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">folder_open</span><span>File Repository</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-150">
            <a href="/login" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">logout</span><span>Log Out</span>
            </a>
        </div>
    </aside>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto main-scroll">
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 lg:px-10 py-4">
            <div class="flex items-center gap-3">
                <a href="/student/class/cs402" class="text-gray-400 hover:text-gray-900 transition-colors"><span class="material-symbols-outlined text-[20px]">arrow_back</span></a>
                <div>
                    <h1 class="text-xl font-bold text-gray-900 tracking-tight">Group Status Monitoring</h1>
                    <p class="text-sm text-gray-500 mt-0.5">CS402: Distributed Systems · Group Alpha</p>
                </div>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">
            <!-- Group Progress Overview -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 animate-in">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">Group Alpha</h3>
                        <p class="text-sm text-gray-500 mt-0.5">5 members · Project Manager: Maria Cruz</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold">Overall Progress</span>
                        <span class="text-2xl font-bold text-gray-900">68%</span>
                    </div>
                </div>
                <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden mb-2">
                    <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full progress-bar-fill" style="width: 68%"></div>
                </div>
                <div class="flex justify-between text-[10px] uppercase tracking-wider text-gray-400 font-semibold">
                    <span>Phase 1 ✓</span>
                    <span class="text-blue-600">Phase 2 — Active</span>
                    <span>Phase 3</span>
                    <span>Phase 4</span>
                </div>
            </div>

            <!-- Members Contribution Table -->
            <div class="bg-white rounded-xl border border-gray-200 mb-8 animate-in animate-in-delay-1">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="font-bold text-gray-900">Member Contributions</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Contribution percentages and task progress for each group member</p>
                </div>
                <div class="divide-y divide-gray-100">
                    <!-- Member 1 - Alex (You) -->
                    <div class="px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center gap-3 min-w-[200px]">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-sm font-bold text-blue-700">A</div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Alex Rivera <span class="text-xs font-normal text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded ml-1">You</span></p>
                                <p class="text-xs text-gray-400">Developer</p>
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs text-gray-500">Contribution</span>
                                <span class="text-sm font-bold text-blue-700">91%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600 rounded-full progress-bar-fill" style="width: 91%"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-center min-w-[180px]">
                            <div>
                                <p class="text-xs text-gray-400">Tasks</p>
                                <p class="text-sm font-bold text-gray-900">19/20</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">On Time</p>
                                <p class="text-sm font-bold text-green-600">95%</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Files</p>
                                <p class="text-sm font-bold text-gray-900">17</p>
                            </div>
                        </div>
                    </div>

                    <!-- Member 2 - Maria (PM) -->
                    <div class="px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center gap-3 min-w-[200px]">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-sm font-bold text-green-700">M</div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Maria Cruz <span class="text-xs font-normal text-purple-600 bg-purple-50 px-1.5 py-0.5 rounded ml-1">PM</span></p>
                                <p class="text-xs text-gray-400">Project Manager</p>
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs text-gray-500">Contribution</span>
                                <span class="text-sm font-bold text-green-700">94%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-600 rounded-full progress-bar-fill" style="width: 94%"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-center min-w-[180px]">
                            <div><p class="text-xs text-gray-400">Tasks</p><p class="text-sm font-bold text-gray-900">20/20</p></div>
                            <div><p class="text-xs text-gray-400">On Time</p><p class="text-sm font-bold text-green-600">100%</p></div>
                            <div><p class="text-xs text-gray-400">Files</p><p class="text-sm font-bold text-gray-900">22</p></div>
                        </div>
                    </div>

                    <!-- Member 3 - James -->
                    <div class="px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center gap-3 min-w-[200px]">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-sm font-bold text-purple-700">J</div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">James Tan</p>
                                <p class="text-xs text-gray-400">Developer</p>
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs text-gray-500">Contribution</span>
                                <span class="text-sm font-bold text-purple-700">78%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-600 rounded-full progress-bar-fill" style="width: 78%"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-center min-w-[180px]">
                            <div><p class="text-xs text-gray-400">Tasks</p><p class="text-sm font-bold text-gray-900">15/20</p></div>
                            <div><p class="text-xs text-gray-400">On Time</p><p class="text-sm font-bold text-amber-600">75%</p></div>
                            <div><p class="text-xs text-gray-400">Files</p><p class="text-sm font-bold text-gray-900">10</p></div>
                        </div>
                    </div>

                    <!-- Member 4 - Rosa -->
                    <div class="px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center gap-3 min-w-[200px]">
                            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-sm font-bold text-amber-700">R</div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Rosa Mendez</p>
                                <p class="text-xs text-gray-400">Designer</p>
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs text-gray-500">Contribution</span>
                                <span class="text-sm font-bold text-amber-700">85%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 rounded-full progress-bar-fill" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-center min-w-[180px]">
                            <div><p class="text-xs text-gray-400">Tasks</p><p class="text-sm font-bold text-gray-900">17/20</p></div>
                            <div><p class="text-xs text-gray-400">On Time</p><p class="text-sm font-bold text-green-600">88%</p></div>
                            <div><p class="text-xs text-gray-400">Files</p><p class="text-sm font-bold text-gray-900">14</p></div>
                        </div>
                    </div>

                    <!-- Member 5 - Sofia -->
                    <div class="px-6 py-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center gap-3 min-w-[200px]">
                            <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-sm font-bold text-pink-700">S</div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Sofia Lim</p>
                                <p class="text-xs text-gray-400">Researcher</p>
                            </div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs text-gray-500">Contribution</span>
                                <span class="text-sm font-bold text-pink-700">72%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-pink-500 rounded-full progress-bar-fill" style="width: 72%"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-center min-w-[180px]">
                            <div><p class="text-xs text-gray-400">Tasks</p><p class="text-sm font-bold text-gray-900">14/20</p></div>
                            <div><p class="text-xs text-gray-400">On Time</p><p class="text-sm font-bold text-amber-600">70%</p></div>
                            <div><p class="text-xs text-gray-400">Files</p><p class="text-sm font-bold text-gray-900">8</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 animate-in animate-in-delay-2">
                <h3 class="font-bold text-gray-900 mb-1">Group Activity Timeline</h3>
                <p class="text-sm text-gray-500 mb-5">Recent actions from all group members</p>
                <div class="relative pl-6 space-y-6">
                    <!-- Timeline line -->
                    <div class="absolute left-[11px] top-2 bottom-2 w-0.5 bg-gray-200"></div>

                    <div class="relative">
                        <div class="absolute left-[-17px] w-3 h-3 rounded-full bg-green-500 border-2 border-white"></div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-gray-900">Maria Cruz</p>
                                <span class="text-xs text-gray-400">· 1 hour ago</span>
                            </div>
                            <p class="text-sm text-gray-500">Approved task "Load Balancer Documentation"</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute left-[-17px] w-3 h-3 rounded-full bg-blue-500 border-2 border-white"></div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-gray-900">Alex Rivera</p>
                                <span class="text-xs text-gray-400">· 2 hours ago</span>
                            </div>
                            <p class="text-sm text-gray-500">Completed "API Gateway Implementation"</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute left-[-17px] w-3 h-3 rounded-full bg-amber-500 border-2 border-white"></div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-gray-900">Rosa Mendez</p>
                                <span class="text-xs text-gray-400">· 4 hours ago</span>
                            </div>
                            <p class="text-sm text-gray-500">Uploaded 3 wireframe files to repository</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute left-[-17px] w-3 h-3 rounded-full bg-purple-500 border-2 border-white"></div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-gray-900">James Tan</p>
                                <span class="text-xs text-gray-400">· Yesterday</span>
                            </div>
                            <p class="text-sm text-gray-500">Submitted "Database Schema Design" for approval</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute left-[-17px] w-3 h-3 rounded-full bg-pink-500 border-2 border-white"></div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-gray-900">Sofia Lim</p>
                                <span class="text-xs text-gray-400">· Yesterday</span>
                            </div>
                            <p class="text-sm text-gray-500">Posted in "Research Findings" discussion thread</p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute left-[-17px] w-3 h-3 rounded-full bg-red-400 border-2 border-white"></div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-gray-900">Maria Cruz</p>
                                <span class="text-xs text-gray-400">· 2 days ago</span>
                            </div>
                            <p class="text-sm text-gray-500">Returned "Frontend Mockups" to James for revision</p>
                        </div>
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
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', toggleSidebar);

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.progress-bar-fill').forEach(bar => {
                const w = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => { bar.style.width = w; }, 300);
            });
        });
    </script>
</body>
</html>
