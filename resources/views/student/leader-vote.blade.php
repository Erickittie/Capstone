<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leader Vote - CS402 - CarryOn</title>
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
            <a href="/student/class/cs402/group-status" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">groups</span><span>Group Status</span>
            </a>
            <a href="/student/class/cs402/leader-vote" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px]">how_to_vote</span><span>Leader Vote</span>
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
                    <h1 class="text-xl font-bold text-gray-900 tracking-tight">Leader Vote</h1>
                    <p class="text-sm text-gray-500 mt-0.5">CS402: Distributed Systems · Group Alpha</p>
                </div>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">
            <!-- Election Status Banner -->
            <div id="vote-status-banner" class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl p-6 mb-8 text-white animate-in">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[28px]">how_to_vote</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold" id="election-title">Project Manager Election</h2>
                            <p class="text-purple-100 text-sm" id="election-subtitle">Voting is currently open — Select your candidate below</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span id="vote-badge" class="badge badge-open text-xs">
                            <span class="material-symbols-outlined text-[12px]">radio_button_checked</span>
                            Voting Open
                        </span>
                        <div class="text-right hidden sm:block">
                            <p class="text-[10px] uppercase tracking-wider text-purple-200 font-semibold">Votes Cast</p>
                            <p class="text-lg font-bold" id="vote-count-display">3 / 5</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Candidate Cards -->
            <div class="mb-6 animate-in animate-in-delay-1">
                <h3 class="font-bold text-gray-900 mb-1">Candidates</h3>
                <p class="text-sm text-gray-500 mb-5">Click on a candidate to select them, then confirm your vote</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="candidate-grid">
                    <!-- Candidate 1 - Alex (You) -->
                    <div class="vote-card bg-white rounded-xl border-2 border-gray-200 p-5 relative" data-candidate="alex" onclick="selectCandidate(this)">
                        <div class="absolute top-3 right-3 w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center candidate-check transition-all">
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-lg font-bold text-blue-700">A</div>
                            <div>
                                <p class="font-semibold text-gray-900">Alex Rivera <span class="text-xs text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded ml-1">You</span></p>
                                <p class="text-xs text-gray-400">Developer</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">monitoring</span>
                                <span>Contribution: <strong>91%</strong></span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">assignment_turned_in</span>
                                <span>Tasks: <strong>19/20</strong> completed</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span>
                                <span>On-time rate: <strong>95%</strong></span>
                            </div>
                        </div>
                        <!-- Vote bar (hidden until results) -->
                        <div class="vote-result hidden">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold text-gray-500">Votes</span>
                                <span class="text-xs font-bold text-gray-900 vote-pct">1 vote (20%)</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full progress-bar-fill" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Candidate 2 - Maria -->
                    <div class="vote-card bg-white rounded-xl border-2 border-gray-200 p-5 relative" data-candidate="maria" onclick="selectCandidate(this)">
                        <div class="absolute top-3 right-3 w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center candidate-check transition-all">
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-lg font-bold text-green-700">M</div>
                            <div>
                                <p class="font-semibold text-gray-900">Maria Cruz</p>
                                <p class="text-xs text-gray-400">Lead Developer</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">monitoring</span>
                                <span>Contribution: <strong>94%</strong></span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">assignment_turned_in</span>
                                <span>Tasks: <strong>20/20</strong> completed</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span>
                                <span>On-time rate: <strong>100%</strong></span>
                            </div>
                        </div>
                        <div class="vote-result hidden">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold text-gray-500">Votes</span>
                                <span class="text-xs font-bold text-gray-900 vote-pct">3 votes (60%)</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500 rounded-full progress-bar-fill" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Candidate 3 - James -->
                    <div class="vote-card bg-white rounded-xl border-2 border-gray-200 p-5 relative" data-candidate="james" onclick="selectCandidate(this)">
                        <div class="absolute top-3 right-3 w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center candidate-check transition-all">
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-lg font-bold text-purple-700">J</div>
                            <div>
                                <p class="font-semibold text-gray-900">James Tan</p>
                                <p class="text-xs text-gray-400">Developer</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">monitoring</span>
                                <span>Contribution: <strong>78%</strong></span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">assignment_turned_in</span>
                                <span>Tasks: <strong>15/20</strong> completed</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span>
                                <span>On-time rate: <strong>75%</strong></span>
                            </div>
                        </div>
                        <div class="vote-result hidden">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold text-gray-500">Votes</span>
                                <span class="text-xs font-bold text-gray-900 vote-pct">0 votes (0%)</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full progress-bar-fill" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Candidate 4 - Rosa -->
                    <div class="vote-card bg-white rounded-xl border-2 border-gray-200 p-5 relative" data-candidate="rosa" onclick="selectCandidate(this)">
                        <div class="absolute top-3 right-3 w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center candidate-check transition-all">
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center text-lg font-bold text-amber-700">R</div>
                            <div>
                                <p class="font-semibold text-gray-900">Rosa Mendez</p>
                                <p class="text-xs text-gray-400">Designer</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">monitoring</span>
                                <span>Contribution: <strong>85%</strong></span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">assignment_turned_in</span>
                                <span>Tasks: <strong>17/20</strong> completed</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span>
                                <span>On-time rate: <strong>88%</strong></span>
                            </div>
                        </div>
                        <div class="vote-result hidden">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold text-gray-500">Votes</span>
                                <span class="text-xs font-bold text-gray-900 vote-pct">1 vote (20%)</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 rounded-full progress-bar-fill" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Candidate 5 - Sofia -->
                    <div class="vote-card bg-white rounded-xl border-2 border-gray-200 p-5 relative" data-candidate="sofia" onclick="selectCandidate(this)">
                        <div class="absolute top-3 right-3 w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center candidate-check transition-all">
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center text-lg font-bold text-pink-700">S</div>
                            <div>
                                <p class="font-semibold text-gray-900">Sofia Lim</p>
                                <p class="text-xs text-gray-400">Researcher</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">monitoring</span>
                                <span>Contribution: <strong>72%</strong></span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">assignment_turned_in</span>
                                <span>Tasks: <strong>14/20</strong> completed</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span>
                                <span>On-time rate: <strong>70%</strong></span>
                            </div>
                        </div>
                        <div class="vote-result hidden">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs font-semibold text-gray-500">Votes</span>
                                <span class="text-xs font-bold text-gray-900 vote-pct">0 votes (0%)</span>
                            </div>
                            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-pink-500 rounded-full progress-bar-fill" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Vote Button -->
            <div class="flex items-center justify-between bg-white rounded-xl border border-gray-200 p-5 mb-8 animate-in animate-in-delay-2" id="vote-action-bar">
                <div>
                    <p class="text-sm text-gray-500" id="selection-label">No candidate selected</p>
                </div>
                <button id="submit-vote-btn" disabled
                    class="bg-gray-200 text-gray-400 px-6 py-2.5 rounded-lg font-semibold text-sm cursor-not-allowed transition-all duration-200 flex items-center gap-2"
                    onclick="showConfirmModal()">
                    <span class="material-symbols-outlined text-[18px]">how_to_vote</span>
                    Cast Vote
                </button>
            </div>

            <!-- Election History -->
            <div class="bg-white rounded-xl border border-gray-200 p-6 animate-in animate-in-delay-3">
                <h3 class="font-bold text-gray-900 mb-1">Election History</h3>
                <p class="text-sm text-gray-500 mb-4">Previous elections for this group</p>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-xs font-bold text-green-700">M</div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Maria Cruz elected as PM</p>
                                <p class="text-xs text-gray-400">Phase 1 · Sep 15, 2024 · 3 out of 5 votes</p>
                            </div>
                        </div>
                        <span class="badge badge-elected">
                            <span class="material-symbols-outlined text-[12px]">check_circle</span>
                            Elected
                        </span>
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

    <!-- Confirmation Modal -->
    <div id="confirm-modal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center">
        <div class="modal-panel bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-md mx-4 p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-600 text-[22px]">how_to_vote</span>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Confirm Your Vote</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 mb-5">
                <p class="text-sm text-gray-600">You are voting for:</p>
                <p class="text-lg font-bold text-gray-900 mt-1" id="confirm-candidate-name">—</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="closeConfirmModal()" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-200 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition-colors">Cancel</button>
                <button onclick="confirmVote()" class="flex-1 px-4 py-2.5 rounded-lg bg-gray-900 text-white font-semibold text-sm hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">check</span>
                    Confirm Vote
                </button>
            </div>
        </div>
    </div>

    <!-- Success Toast -->
    <div id="success-toast" class="fixed bottom-6 right-6 z-50 bg-green-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300">
        <span class="material-symbols-outlined text-[20px]">check_circle</span>
        <span class="font-medium text-sm">Vote submitted successfully!</span>
    </div>

    <script>
        let selectedCandidate = null;
        let hasVoted = false;

        const candidateNames = {
            alex: 'Alex Rivera',
            maria: 'Maria Cruz',
            james: 'James Tan',
            rosa: 'Rosa Mendez',
            sofia: 'Sofia Lim'
        };

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', toggleSidebar);

        function selectCandidate(card) {
            if (hasVoted) return;

            // Deselect all
            document.querySelectorAll('.vote-card').forEach(c => {
                c.classList.remove('selected');
                c.querySelector('.candidate-check').innerHTML = '';
                c.querySelector('.candidate-check').classList.remove('bg-gray-900', 'border-gray-900');
                c.querySelector('.candidate-check').classList.add('border-gray-300');
            });

            // Select this one
            card.classList.add('selected');
            const check = card.querySelector('.candidate-check');
            check.innerHTML = '<span class="material-symbols-outlined text-white text-[14px]">check</span>';
            check.classList.add('bg-gray-900', 'border-gray-900');
            check.classList.remove('border-gray-300');

            selectedCandidate = card.dataset.candidate;

            // Enable submit
            const btn = document.getElementById('submit-vote-btn');
            btn.disabled = false;
            btn.classList.remove('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
            btn.classList.add('bg-gray-900', 'text-white', 'hover:bg-gray-800', 'cursor-pointer');

            document.getElementById('selection-label').innerHTML =
                'Selected: <strong>' + candidateNames[selectedCandidate] + '</strong>';
        }

        function showConfirmModal() {
            if (!selectedCandidate) return;
            document.getElementById('confirm-candidate-name').textContent = candidateNames[selectedCandidate];
            document.getElementById('confirm-modal').classList.add('active');
        }

        function closeConfirmModal() {
            document.getElementById('confirm-modal').classList.remove('active');
        }

        function confirmVote() {
            hasVoted = true;
            closeConfirmModal();

            // Show success toast
            const toast = document.getElementById('success-toast');
            toast.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);

            // Show results
            document.querySelectorAll('.vote-result').forEach(el => el.classList.remove('hidden'));

            // Disable all voting
            document.querySelectorAll('.vote-card').forEach(c => {
                c.style.cursor = 'default';
            });

            // Update status
            document.getElementById('election-title').textContent = 'Election Complete';
            document.getElementById('election-subtitle').textContent = 'Maria Cruz has been elected as Project Manager';
            document.getElementById('vote-badge').innerHTML = '<span class="material-symbols-outlined text-[12px]">check_circle</span> Voting Closed';
            document.getElementById('vote-badge').className = 'badge badge-closed text-xs';
            document.getElementById('vote-count-display').textContent = '5 / 5';
            document.getElementById('selection-label').innerHTML = '<span class="text-green-600 font-medium">✓ Your vote has been recorded</span>';

            const btn = document.getElementById('submit-vote-btn');
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">check_circle</span> Vote Submitted';
            btn.classList.remove('bg-gray-900', 'text-white', 'hover:bg-gray-800', 'cursor-pointer');
            btn.classList.add('bg-green-50', 'text-green-700', 'cursor-not-allowed', 'border', 'border-green-200');

            // Highlight winner
            document.querySelectorAll('.vote-card').forEach(c => {
                if (c.dataset.candidate === 'maria') {
                    c.classList.add('ring-2', 'ring-green-500');
                    const nameEl = c.querySelector('.font-semibold');
                    nameEl.innerHTML += ' <span class="badge badge-elected ml-1"><span class="material-symbols-outlined text-[10px]">emoji_events</span> Winner</span>';
                }
            });
        }
    </script>
</body>
</html>
