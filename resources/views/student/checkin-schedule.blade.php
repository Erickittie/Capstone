<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request Check-In - CS402 - CarryOn</title>
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
            <a href="/student/class/cs402" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-500">class</span>
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
            <a href="/student/class/cs402/checkin" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px]">event_available</span>
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

        <!-- Top Bar -->
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 lg:px-10 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="/student/class/cs402" class="text-gray-400 hover:text-gray-900 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">Check-In Request</h1>
                        <p class="text-sm text-gray-500 mt-0.5">CS402: Distributed Systems · Prof. Dr. Santos</p>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left: Request Form -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- New Request Card -->
                    <div class="bg-white rounded-xl border border-gray-200 animate-in">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-indigo-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-indigo-600 text-[20px]">edit_calendar</span>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-gray-900">New Check-In Request</h2>
                                <p class="text-xs text-gray-500 mt-0.5">Fill out the form below to request a meeting with your instructor</p>
                            </div>
                        </div>

                        <form id="checkin-form" class="px-6 py-6 space-y-5">
                            <!-- Reason -->
                            <div>
                                <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Reason for Check-In</label>
                                <select class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent bg-white">
                                    <option value="" disabled selected>Select a reason...</option>
                                    <option>Low contribution score</option>
                                    <option>Task clarification needed</option>
                                    <option>Group conflict</option>
                                    <option>Workload concern</option>
                                    <option>Personal issue affecting participation</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <!-- Preferred Date -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Preferred Date</label>
                                    <input type="date" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Preferred Time</label>
                                    <input type="time" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                                </div>
                            </div>

                            <!-- Mode -->
                            <div>
                                <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Preferred Mode</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="mode-option flex flex-col items-center gap-2 border border-gray-200 rounded-lg p-3 cursor-pointer hover:border-gray-900 transition-all has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                                        <input type="radio" name="mode" value="in-person" class="sr-only">
                                        <span class="material-symbols-outlined text-gray-500 text-[22px]">location_on</span>
                                        <span class="text-xs font-semibold text-gray-700">In-Person</span>
                                    </label>
                                    <label class="mode-option flex flex-col items-center gap-2 border border-gray-200 rounded-lg p-3 cursor-pointer hover:border-gray-900 transition-all has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                                        <input type="radio" name="mode" value="online" class="sr-only">
                                        <span class="material-symbols-outlined text-gray-500 text-[22px]">videocam</span>
                                        <span class="text-xs font-semibold text-gray-700">Online</span>
                                    </label>
                                    <label class="mode-option flex flex-col items-center gap-2 border border-gray-200 rounded-lg p-3 cursor-pointer hover:border-gray-900 transition-all has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                                        <input type="radio" name="mode" value="either" class="sr-only">
                                        <span class="material-symbols-outlined text-gray-500 text-[22px]">swap_horiz</span>
                                        <span class="text-xs font-semibold text-gray-700">Either</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Message -->
                            <div>
                                <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Additional Message <span class="text-gray-400 font-normal normal-case">(optional)</span></label>
                                <textarea rows="4" placeholder="Briefly describe what you'd like to discuss..." class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent resize-none placeholder-gray-400"></textarea>
                            </div>

                            <!-- Submit -->
                            <div class="flex items-center gap-3 pt-1">
                                <button type="button" onclick="submitRequest()" class="flex items-center gap-2 px-6 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-700 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">send</span>
                                    Submit Request
                                </button>
                                <button type="reset" class="px-6 py-2.5 text-gray-600 text-sm font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    Clear
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Past Requests -->
                    <div class="bg-white rounded-xl border border-gray-200 animate-in animate-in-delay-2">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h2 class="text-base font-bold text-gray-900">My Requests</h2>
                            <p class="text-xs text-gray-500 mt-0.5">History of all your check-in requests for this class</p>
                        </div>

                        <div class="divide-y divide-gray-100">
                            <!-- Request 1 - Approved -->
                            <div class="flex items-start gap-4 px-6 py-4">
                                <div class="w-9 h-9 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2 flex-wrap">
                                        <p class="text-sm font-semibold text-gray-900">Workload concern</p>
                                        <span class="badge badge-approved">Approved</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-0.5">Requested: July 10, 2024 · In-Person</p>
                                    <p class="text-xs text-gray-600 mt-1.5 bg-green-50 rounded-lg px-3 py-2">
                                        <span class="font-semibold text-green-700">Instructor note:</span> Scheduled for July 14, 2:00 PM at Faculty Room 3.
                                    </p>
                                </div>
                            </div>

                            <!-- Request 2 - Pending -->
                            <div class="flex items-start gap-4 px-6 py-4">
                                <div class="w-9 h-9 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-amber-600 text-[18px]">schedule</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2 flex-wrap">
                                        <p class="text-sm font-semibold text-gray-900">Task clarification needed</p>
                                        <span class="badge badge-pending">Pending</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-0.5">Requested: July 20, 2024 · Online</p>
                                    <p class="text-xs text-gray-600 mt-1.5 bg-amber-50 rounded-lg px-3 py-2">
                                        <span class="font-semibold text-amber-700"></span> Waiting for instructor to respond...
                                </div>
                            </div>

                            <!-- Request 3 - Declined -->
                            <div class="flex items-start gap-4 px-6 py-4">
                                <div class="w-9 h-9 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <span class="material-symbols-outlined text-red-600 text-[18px]">cancel</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2 flex-wrap">
                                        <p class="text-sm font-semibold text-gray-900">Group conflict</p>
                                        <span class="badge badge-rejected">Declined</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-0.5">Requested: July 5, 2024 · Either</p>
                                    <p class="text-xs text-gray-600 mt-1.5 bg-red-50 rounded-lg px-3 py-2">
                                        <span class="font-semibold text-red-700">Instructor note:</span> Please resolve within the group first. Reach out again if unresolved.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Info Panel -->
                <div class="space-y-5">

                    <!-- Instructor Info -->
                    <div class="bg-white rounded-xl border border-gray-200 p-5 animate-in animate-in-delay-1">
                        <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold mb-4">Your Instructor</p>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200 flex-shrink-0">
                                <span class="material-symbols-outlined text-[24px] text-gray-500">person</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Prof. Dr. Santos</p>
                                <p class="text-xs text-gray-500">CS402: Distributed Systems</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span>
                                <span>Office hours: MWF 11:00 AM – 12:00 PM</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">location_on</span>
                                <span>Faculty Room 3, CS Building</span>
                            </div>
                        </div>
                    </div>

                    <!-- Status Summary -->
                    <div class="bg-white rounded-xl border border-gray-200 p-5 animate-in animate-in-delay-2">
                        <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold mb-4">Request Summary</p>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Total Requests</span>
                                <span class="text-sm font-bold text-gray-900">3</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Approved</span>
                                <span class="text-sm font-bold text-green-600">1</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Pending</span>
                                <span class="text-sm font-bold text-amber-600">1</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Declined</span>
                                <span class="text-sm font-bold text-red-600">1</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="bg-indigo-50 rounded-xl border border-indigo-100 p-5 animate-in animate-in-delay-3">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-indigo-600 text-[18px]">lightbulb</span>
                            <p class="text-[11px] uppercase tracking-wider text-indigo-600 font-semibold">Tips</p>
                        </div>
                        <ul class="space-y-2 text-xs text-indigo-700">
                            <li class="flex items-start gap-1.5">
                                <span class="material-symbols-outlined text-[14px] mt-0.5 flex-shrink-0">check</span>
                                Be specific about what you need help with.
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="material-symbols-outlined text-[14px] mt-0.5 flex-shrink-0">check</span>
                                Request at least 2 days in advance when possible.
                            </li>
                            <li class="flex items-start gap-1.5">
                                <span class="material-symbols-outlined text-[14px] mt-0.5 flex-shrink-0">check</span>
                                Check your instructor's office hours first.
                            </li>
                        </ul>
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

    <!-- Success Toast -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-gray-900 text-white px-5 py-3.5 rounded-xl shadow-xl opacity-0 pointer-events-none transition-all duration-300 translate-y-4">
        <span class="material-symbols-outlined text-green-400 text-[20px]">check_circle</span>
        <span class="text-sm font-medium">Check-in request submitted!</span>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', toggleSidebar);

        function submitRequest() {
            const toast = document.getElementById('toast');
            toast.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
            toast.classList.add('opacity-100', 'translate-y-0');
            setTimeout(() => {
                toast.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                toast.classList.remove('opacity-100', 'translate-y-0');
            }, 3000);
            document.getElementById('checkin-form').reset();
        }
    </script>
</body>
</html>