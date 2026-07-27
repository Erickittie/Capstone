<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contribution Score - CS402 - CarryOn</title>
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
            <span class="font-bold text-base tracking-tight text-gray-900">CarryOn</span>
        </div>
        <button id="mobile-menu-toggle" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    <!-- Sidebar -->
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
            <div class="pt-3 pb-1.5"><p class="px-3.5 text-[10px] uppercase tracking-widest text-gray-400 font-semibold">CS402</p></div>
            <a href="/student/class/cs402" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">class</span>
                <span>Class Overview</span>
            </a>
            <a href="/student/class/cs402/contribution" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px]">monitoring</span>
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
            <a href="/student/class/cs402/checkin" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">event_available</span>
                <span>Check-In Request</span>
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
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 lg:px-10 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="/student/class/cs402" class="text-gray-400 hover:text-gray-900 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">Contribution Score</h1>
                        <p class="text-sm text-gray-500 mt-0.5">CS402: Distributed Systems · Group Alpha</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">
            <!-- Score Hero -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Main Score Ring -->
                <div class="bg-white rounded-xl border border-gray-200 p-8 flex flex-col items-center justify-center animate-in">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-4">Your Contribution Score</p>
                    <div class="relative w-44 h-44 mb-4">
                        <svg class="w-full h-full -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="42" fill="none" stroke="#F3F4F6" stroke-width="8"/>
                            <circle cx="50" cy="50" r="42" fill="none" stroke="#2563EB" stroke-width="8" stroke-linecap="round"
                                class="contribution-ring"
                                stroke-dasharray="263.9"
                                stroke-dashoffset="23.7"/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-4xl font-bold text-gray-900">91</span>
                            <span class="text-sm text-gray-400 -mt-0.5">out of 100</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 text-sm">
                        <span class="material-symbols-outlined text-green-500 text-[18px]">trending_up</span>
                        <span class="font-semibold text-green-600">+4.2%</span>
                        <span class="text-gray-400">from last week</span>
                    </div>
                </div>

                <!-- Score Breakdown -->
                <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6 animate-in animate-in-delay-1">
                    <h3 class="font-bold text-gray-900 mb-1">Score Breakdown</h3>
                    <p class="text-sm text-gray-500 mb-5">How your contribution score is calculated</p>

                    <div class="space-y-5">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-blue-600 text-[18px]">check_circle</span>
                                    <span class="text-sm font-medium text-gray-700">Task Completions</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">95%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600 rounded-full progress-bar-fill" style="width: 95%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">19 of 20 tasks completed on time</p>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-emerald-600 text-[18px]">forum</span>
                                    <span class="text-sm font-medium text-gray-700">Discussion Participation</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">88%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full progress-bar-fill" style="width: 88%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">35 discussion posts this semester</p>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-purple-600 text-[18px]">rate_review</span>
                                    <span class="text-sm font-medium text-gray-700">Peer Reviews Given</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">92%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full progress-bar-fill" style="width: 92%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">11 of 12 reviews submitted</p>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-amber-600 text-[18px]">upload_file</span>
                                    <span class="text-sm font-medium text-gray-700">File Contributions</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">85%</span>
                            </div>
                            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 rounded-full progress-bar-fill" style="width: 85%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">17 files uploaded to repository</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weekly Trend -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8 animate-in animate-in-delay-2">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-gray-900">Weekly Contribution Trend</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Your score trajectory over the past 8 weeks</p>
                    </div>
                    <div class="flex items-center gap-4 text-xs">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-blue-600"></div>
                            <span class="text-gray-500">Your Score</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-gray-300"></div>
                            <span class="text-gray-500">Class Average</span>
                        </div>
                    </div>
                </div>
                <!-- Chart Area -->
                <div class="relative h-56">
                    <svg class="w-full h-full" viewBox="0 0 800 200" preserveAspectRatio="none">
                        <!-- Grid lines -->
                        <line x1="0" y1="0" x2="800" y2="0" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="50" x2="800" y2="50" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="100" x2="800" y2="100" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="150" x2="800" y2="150" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="200" x2="800" y2="200" stroke="#F3F4F6" stroke-width="1"/>

                        <!-- Class average line (dashed) -->
                        <polyline fill="none" stroke="#D1D5DB" stroke-width="2" stroke-dasharray="6 4"
                            points="0,60 114,55 228,58 342,50 456,52 570,48 684,45 800,42"/>

                        <!-- Your score area fill -->
                        <polygon fill="url(#blueGrad)" opacity="0.15"
                            points="0,50 114,40 228,45 342,30 456,25 570,22 684,20 800,18 800,200 0,200"/>

                        <!-- Your score line -->
                        <polyline fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                            points="0,50 114,40 228,45 342,30 456,25 570,22 684,20 800,18"/>

                        <!-- Data points -->
                        <circle cx="0" cy="50" r="4" fill="#2563EB"/>
                        <circle cx="114" cy="40" r="4" fill="#2563EB"/>
                        <circle cx="228" cy="45" r="4" fill="#2563EB"/>
                        <circle cx="342" cy="30" r="4" fill="#2563EB"/>
                        <circle cx="456" cy="25" r="4" fill="#2563EB"/>
                        <circle cx="570" cy="22" r="4" fill="#2563EB"/>
                        <circle cx="684" cy="20" r="4" fill="#2563EB"/>
                        <circle cx="800" cy="18" r="4" fill="#2563EB"/>

                        <defs>
                            <linearGradient id="blueGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#2563EB"/>
                                <stop offset="100%" stop-color="#2563EB" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <!-- X-axis labels -->
                    <div class="flex justify-between text-[10px] uppercase tracking-wider text-gray-400 font-semibold mt-2 px-1">
                        <span>Week 1</span><span>Week 2</span><span>Week 3</span><span>Week 4</span><span>Week 5</span><span>Week 6</span><span>Week 7</span><span>Week 8</span>
                    </div>
                </div>
            </div>

            <!-- Comparison with Class -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-in animate-in-delay-3">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-1">vs. Class Average</h3>
                    <p class="text-sm text-gray-500 mb-5">How you compare to the anonymized class average</p>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-medium text-blue-700">You</span>
                                <span class="font-bold text-blue-700">91%</span>
                            </div>
                            <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600 rounded-full progress-bar-fill" style="width: 91%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-medium text-gray-500">Class Average</span>
                                <span class="font-bold text-gray-500">79%</span>
                            </div>
                            <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gray-400 rounded-full progress-bar-fill" style="width: 79%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 p-3 bg-green-50 rounded-lg border border-green-100 flex items-center gap-2">
                        <span class="material-symbols-outlined text-green-600 text-[20px]">emoji_events</span>
                        <p class="text-sm text-green-700 font-medium">You are <strong>12% above</strong> the class average!</p>
                    </div>
                </div>

                <!-- Recent Activity Log -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-1">Recent Contributions</h3>
                    <p class="text-sm text-gray-500 mb-5">Latest activities that impacted your score</p>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="material-symbols-outlined text-green-600 text-[14px]">check</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-medium">Completed "API Gateway Implementation"</p>
                                <p class="text-xs text-gray-400">+3 points · 2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="material-symbols-outlined text-blue-600 text-[14px]">forum</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-medium">Posted in "Architecture Decisions" thread</p>
                                <p class="text-xs text-gray-400">+1 point · 5 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-full bg-purple-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="material-symbols-outlined text-purple-600 text-[14px]">rate_review</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-medium">Reviewed Maria's "Load Balancer" submission</p>
                                <p class="text-xs text-gray-400">+2 points · Yesterday</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <span class="material-symbols-outlined text-amber-600 text-[14px]">upload</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-900 font-medium">Uploaded "SystemDesign_v3.pdf"</p>
                                <p class="text-xs text-gray-400">+1 point · 2 days ago</p>
                            </div>
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
            // Animate progress bars
            document.querySelectorAll('.progress-bar-fill').forEach(bar => {
                const w = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => { bar.style.width = w; }, 300);
            });
            // Animate contribution ring
            document.querySelectorAll('.contribution-ring').forEach(ring => {
                const off = ring.getAttribute('stroke-dashoffset');
                ring.setAttribute('stroke-dashoffset', '263.9');
                setTimeout(() => { ring.style.strokeDashoffset = off + 'px'; }, 400);
            });
        });
    </script>
</body>
</html>
