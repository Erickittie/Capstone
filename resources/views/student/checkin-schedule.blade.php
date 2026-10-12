<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request Check-In - {{ $class->course_code }} - CarryOn</title>
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
    @include('student.partials.sidebar')

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <main class="flex-1 md:ml-[260px] overflow-y-auto main-scroll">

        <!-- Top Bar -->
        <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-100 px-6 lg:px-10 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('student.class.detail', $class->id) }}" class="text-gray-400 hover:text-gray-900 transition-colors">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    </a>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">Check-In Request</h1>
                        <p class="text-sm text-gray-500 mt-0.5">
                            {{ $class->course_code }}: {{ $class->course_name }} 
                            @if(isset($class->instructor))
                                · Prof. {{ $class->instructor->name }}
                            @elseif(isset($class->teacher))
                                · Prof. {{ $class->teacher->name }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

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

                        <form action="{{ route('student.checkin.store', $class->id) }}" method="POST" id="checkin-form" class="px-6 py-6 space-y-5">
                            @csrf
                            <input type="hidden" name="class_room_id" value="{{ $class->id }}">

                            <!-- Reason -->
                            <div>
                                <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Reason for Check-In</label>
                                <select name="reason" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent bg-white">
                                    <option value="" disabled selected>Select a reason...</option>
                                    <option value="Low contribution score">Low contribution score</option>
                                    <option value="Task clarification needed">Task clarification needed</option>
                                    <option value="Group conflict">Group conflict</option>
                                    <option value="Workload concern">Workload concern</option>
                                    <option value="Personal issue affecting participation">Personal issue affecting participation</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <!-- Preferred Date & Time -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Preferred Date</label>
                                    <input type="date" name="preferred_date" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Preferred Time</label>
                                    <input type="time" name="preferred_time" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent">
                                </div>
                            </div>

                            <!-- Mode -->
                            <div>
                                <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Preferred Mode</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="mode-option flex flex-col items-center gap-2 border border-gray-200 rounded-lg p-3 cursor-pointer hover:border-gray-900 transition-all has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                                        <input type="radio" name="mode" value="in-person" required class="sr-only">
                                        <span class="material-symbols-outlined text-gray-500 text-[22px]">location_on</span>
                                        <span class="text-xs font-semibold text-gray-700">In-Person</span>
                                    </label>
                                    <label class="mode-option flex flex-col items-center gap-2 border border-gray-200 rounded-lg p-3 cursor-pointer hover:border-gray-900 transition-all has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                                        <input type="radio" name="mode" value="online" required class="sr-only">
                                        <span class="material-symbols-outlined text-gray-500 text-[22px]">videocam</span>
                                        <span class="text-xs font-semibold text-gray-700">Online</span>
                                    </label>
                                    <label class="mode-option flex flex-col items-center gap-2 border border-gray-200 rounded-lg p-3 cursor-pointer hover:border-gray-900 transition-all has-[:checked]:border-gray-900 has-[:checked]:bg-gray-50">
                                        <input type="radio" name="mode" value="either" required class="sr-only">
                                        <span class="material-symbols-outlined text-gray-500 text-[22px]">swap_horiz</span>
                                        <span class="text-xs font-semibold text-gray-700">Either</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Message -->
                            <div>
                                <label class="block text-[12px] font-semibold uppercase tracking-wider text-gray-500 mb-2">Additional Message <span class="text-gray-400 font-normal normal-case">(optional)</span></label>
                                <textarea name="message" rows="4" placeholder="Briefly describe what you'd like to discuss..." class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent resize-none placeholder-gray-400"></textarea>
                            </div>

                            <!-- Submit -->
                            <div class="flex items-center gap-3 pt-1">
                                <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-700 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">send</span>
                                    Submit Request
                                </button>
                                <button type="reset" class="px-6 py-2.5 text-gray-600 text-sm font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    Clear
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Requests History -->
                    <div class="bg-white rounded-xl border border-gray-200 animate-in animate-in-delay-2">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h2 class="text-base font-bold text-gray-900">My Requests</h2>
                            <p class="text-xs text-gray-500 mt-0.5">History of all your check-in requests for this class</p>
                        </div>

                        <div class="divide-y divide-gray-100">
                            @forelse($requests as $req)
                                <div class="flex items-start gap-4 px-6 py-4">
                                    @if(strtolower($req->status) === 'approved')
                                        <div class="w-9 h-9 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
                                        </div>
                                    @elseif(strtolower($req->status) === 'pending')
                                        <div class="w-9 h-9 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <span class="material-symbols-outlined text-amber-600 text-[18px]">schedule</span>
                                        </div>
                                    @else
                                        <div class="w-9 h-9 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <span class="material-symbols-outlined text-red-600 text-[18px]">cancel</span>
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-2 flex-wrap">
                                            <p class="text-sm font-semibold text-gray-900">{{ $req->reason }}</p>
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold uppercase
                                                @if(strtolower($req->status) === 'approved') bg-green-100 text-green-800
                                                @elseif(strtolower($req->status) === 'pending') bg-amber-100 text-amber-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($req->status) }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            Requested: {{ \Carbon\Carbon::parse($req->preferred_date)->format('M d, Y') }} · {{ ucfirst($req->mode) }}
                                        </p>
                                        @if($req->instructor_note)
                                            <p class="text-xs text-gray-600 mt-1.5 bg-gray-50 rounded-lg px-3 py-2">
                                                <span class="font-semibold text-gray-900">Instructor note:</span> {{ $req->instructor_note }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-10 text-center text-gray-500 text-sm">
                                    No check-in requests submitted yet.
                                </div>
                            @endforelse
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
                                <p class="text-sm font-bold text-gray-900">
                                    {{ $class->instructor->name ?? $class->teacher->name ?? 'Instructor' }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $class->course_code }}: {{ $class->course_name }}</p>
                                <p class="text-xs text-gray-500">{{ $class->course_code }}: {{ $class->course_name }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-xs text-gray-500">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">email</span>
                                <span>{{ $class->teacher->email ?? 'No email provided' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Summary -->
                    <div class="bg-white rounded-xl border border-gray-200 p-5 animate-in animate-in-delay-2">
                        <p class="text-[11px] uppercase tracking-wider text-gray-400 font-semibold mb-4">Request Summary</p>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Total Requests</span>
                                <span class="text-sm font-bold text-gray-900">{{ $requests->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Approved</span>
                                <span class="text-sm font-bold text-green-600">
                                    {{ $requests->where('status', 'approved')->count() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Pending</span>
                                <span class="text-sm font-bold text-amber-600">
                                    {{ $requests->where('status', 'pending')->count() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Declined</span>
                                <span class="text-sm font-bold text-red-600">
                                    {{ $requests->where('status', 'declined')->count() }}
                                </span>
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
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <footer class="px-6 lg:px-10 py-6 border-t border-gray-100 mt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-3 max-w-7xl mx-auto">
                <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold">CarryOn Academic Systems</span>
                <span class="text-xs text-gray-400">© {{ date('Y') }} CarryOn Academic Systems.</span>
            </div>
        </footer>
    </main>

</body>
</html>