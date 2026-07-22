<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager - CS402 - CarryOn</title>
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
            <a href="/student/class/cs402/leader-vote" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium transition-all duration-200 pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">how_to_vote</span><span>Leader Vote</span>
            </a>
            <a href="/student/class/cs402/task-manager" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-900 text-white rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px]">assignment</span><span>Task Manager</span>
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
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="/student/class/cs402" class="text-gray-400 hover:text-gray-900 transition-colors"><span class="material-symbols-outlined text-[20px]">arrow_back</span></a>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 tracking-tight">Task Manager</h1>
                        <p class="text-sm text-gray-500 mt-0.5">CS402: Distributed Systems · Group Alpha</p>
                    </div>
                </div>
                <!-- Role Toggle -->
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-400 font-medium hidden sm:inline">View as:</span>
                    <div class="flex bg-gray-100 rounded-lg p-0.5">
                        <button id="role-student" onclick="switchRole('student')" class="px-3 py-1.5 rounded-md text-xs font-semibold transition-all bg-white text-gray-900 shadow-sm">Student</button>
                        <button id="role-pm" onclick="switchRole('pm')" class="px-3 py-1.5 rounded-md text-xs font-semibold transition-all text-gray-500 hover:text-gray-700">Project Manager</button>
                    </div>
                </div>
            </div>
        </header>

        <div class="px-6 lg:px-10 py-8 max-w-7xl mx-auto">
            <!-- Task Stats -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6 animate-in">
                <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">Total Tasks</p>
                    <p class="text-2xl font-bold text-gray-900">8</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">In Progress</p>
                    <p class="text-2xl font-bold text-blue-600">3</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">Awaiting PM</p>
                    <p class="text-2xl font-bold text-amber-600">2</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 text-center">
                    <p class="text-[10px] uppercase tracking-wider text-gray-400 font-semibold mb-1">Completed</p>
                    <p class="text-2xl font-bold text-green-600">3</p>
                </div>
            </div>

            <!-- PM-only: Assign Task Button -->
            <div id="pm-assign-bar" class="hidden mb-6 animate-in">
                <button onclick="showAssignModal()" class="bg-gray-900 text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-gray-800 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Assign New Task
                </button>
            </div>

            <!-- Filter Tabs -->
            <div class="flex items-center gap-1 border-b border-gray-200 mb-6 animate-in animate-in-delay-1 overflow-x-auto">
                <button class="tab-btn active" onclick="filterTasks('all', this)">All Tasks</button>
                <button class="tab-btn" onclick="filterTasks('pending', this)">Pending</button>
                <button class="tab-btn" onclick="filterTasks('progress', this)">In Progress</button>
                <button class="tab-btn" onclick="filterTasks('submitted', this)">Submitted</button>
                <button class="tab-btn" onclick="filterTasks('approved', this)">Approved</button>
                <button class="tab-btn" onclick="filterTasks('rejected', this)">Rejected</button>
            </div>

            <!-- Task List -->
            <div class="space-y-4 animate-in animate-in-delay-2" id="task-list">

                <!-- Task 1 - In Progress -->
                <div class="task-item bg-white rounded-xl border border-gray-200 overflow-hidden" data-status="progress">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="badge badge-progress">In Progress</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Due: Oct 28, 2024</span>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">API Gateway Implementation</h4>
                            <p class="text-sm text-gray-500 mb-3">Design and implement the API gateway layer for the distributed system. Include rate limiting and authentication middleware.</p>
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">person</span> Assigned to: Alex Rivera</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">attach_file</span> 2 attachments</div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center justify-center gap-2 p-4 sm:border-l border-t sm:border-t-0 border-gray-100 bg-gray-50/50 min-w-[140px]">
                            <button class="text-xs font-semibold text-gray-600 hover:text-gray-900 flex items-center gap-1 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                                <span class="material-symbols-outlined text-[14px]">download</span> Download
                            </button>
                            <button onclick="showSubmitModal('API Gateway Implementation')" class="text-xs font-semibold text-white bg-gray-900 hover:bg-gray-800 flex items-center gap-1 px-3 py-1.5 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-[14px]">upload</span> Submit
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Task 2 - Submitted / Awaiting PM -->
                <div class="task-item bg-white rounded-xl border border-gray-200 overflow-hidden" data-status="submitted">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="badge badge-submitted">Awaiting PM Approval</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Submitted: Oct 22, 2024</span>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Load Balancer Documentation</h4>
                            <p class="text-sm text-gray-500 mb-3">Write comprehensive documentation for the load balancer module including configuration guides and architecture diagrams.</p>
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">person</span> Assigned to: Alex Rivera</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">attach_file</span> 1 submission</div>
                            </div>
                            <!-- PM Review Section (hidden by default) -->
                            <div class="pm-review-section hidden mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">PM Review Actions</p>
                                <div class="flex items-center gap-2">
                                    <button onclick="approveTask(this)" class="text-xs font-semibold text-white bg-green-600 hover:bg-green-700 flex items-center gap-1 px-4 py-2 rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-[14px]">check_circle</span> Approve
                                    </button>
                                    <button onclick="showRejectModal('Load Balancer Documentation')" class="text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 flex items-center gap-1 px-4 py-2 rounded-lg transition-colors border border-red-200">
                                        <span class="material-symbols-outlined text-[14px]">cancel</span> Reject & Return
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center justify-center gap-2 p-4 sm:border-l border-t sm:border-t-0 border-gray-100 bg-amber-50/50 min-w-[140px]">
                            <div class="flex items-center gap-1.5 text-amber-700">
                                <span class="material-symbols-outlined text-[20px]">hourglass_top</span>
                                <span class="text-xs font-semibold">Pending<br>Review</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Task 3 - Submitted / Awaiting PM -->
                <div class="task-item bg-white rounded-xl border border-gray-200 overflow-hidden" data-status="submitted">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="badge badge-submitted">Awaiting PM Approval</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Submitted: Oct 20, 2024</span>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Database Schema Design</h4>
                            <p class="text-sm text-gray-500 mb-3">Design the distributed database schema with sharding strategy and replication topology.</p>
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">person</span> Assigned to: James Tan</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">attach_file</span> 1 submission</div>
                            </div>
                            <div class="pm-review-section hidden mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">PM Review Actions</p>
                                <div class="flex items-center gap-2">
                                    <button onclick="approveTask(this)" class="text-xs font-semibold text-white bg-green-600 hover:bg-green-700 flex items-center gap-1 px-4 py-2 rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-[14px]">check_circle</span> Approve
                                    </button>
                                    <button onclick="showRejectModal('Database Schema Design')" class="text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 flex items-center gap-1 px-4 py-2 rounded-lg transition-colors border border-red-200">
                                        <span class="material-symbols-outlined text-[14px]">cancel</span> Reject & Return
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center justify-center gap-2 p-4 sm:border-l border-t sm:border-t-0 border-gray-100 bg-amber-50/50 min-w-[140px]">
                            <div class="flex items-center gap-1.5 text-amber-700">
                                <span class="material-symbols-outlined text-[20px]">hourglass_top</span>
                                <span class="text-xs font-semibold">Pending<br>Review</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Task 4 - Pending -->
                <div class="task-item bg-white rounded-xl border border-gray-200 overflow-hidden" data-status="pending">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="badge badge-pending">Pending</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Due: Nov 5, 2024</span>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Unit Testing Suite</h4>
                            <p class="text-sm text-gray-500 mb-3">Write comprehensive unit tests for all microservice endpoints with minimum 80% code coverage.</p>
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">person</span> Assigned to: Alex Rivera</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">attach_file</span> 1 attachment</div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center justify-center gap-2 p-4 sm:border-l border-t sm:border-t-0 border-gray-100 bg-gray-50/50 min-w-[140px]">
                            <button class="text-xs font-semibold text-gray-600 hover:text-gray-900 flex items-center gap-1 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                                <span class="material-symbols-outlined text-[14px]">download</span> Download
                            </button>
                            <button onclick="showSubmitModal('Unit Testing Suite')" class="text-xs font-semibold text-white bg-gray-900 hover:bg-gray-800 flex items-center gap-1 px-3 py-1.5 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-[14px]">upload</span> Submit
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Task 5 - In Progress -->
                <div class="task-item bg-white rounded-xl border border-gray-200 overflow-hidden" data-status="progress">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="badge badge-progress">In Progress</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Due: Nov 1, 2024</span>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Service Mesh Configuration</h4>
                            <p class="text-sm text-gray-500 mb-3">Configure the service mesh for inter-service communication with mTLS and circuit breakers.</p>
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">person</span> Assigned to: Rosa Mendez</div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center justify-center gap-2 p-4 sm:border-l border-t sm:border-t-0 border-gray-100 bg-gray-50/50 min-w-[140px]">
                            <button class="text-xs font-semibold text-gray-600 hover:text-gray-900 flex items-center gap-1 px-3 py-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                                <span class="material-symbols-outlined text-[14px]">download</span> Download
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Task 6 - Rejected / Revision -->
                <div class="task-item bg-white rounded-xl border border-red-200 overflow-hidden" data-status="rejected">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="badge badge-rejected">Returned for Revision</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Returned: Oct 19, 2024</span>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Frontend Mockups</h4>
                            <p class="text-sm text-gray-500 mb-2">Create high-fidelity mockups for the monitoring dashboard UI.</p>
                            <div class="bg-red-50 border border-red-100 rounded-lg p-3 mb-3">
                                <p class="text-xs font-semibold text-red-700 mb-0.5">PM Feedback:</p>
                                <p class="text-sm text-red-600">"The dashboard layout needs more responsive considerations. Please revise the mobile breakpoints and add dark mode variants."</p>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">person</span> Assigned to: James Tan</div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center justify-center gap-2 p-4 sm:border-l border-t sm:border-t-0 border-gray-100 bg-red-50/50 min-w-[140px]">
                            <button onclick="showSubmitModal('Frontend Mockups')" class="text-xs font-semibold text-white bg-red-600 hover:bg-red-700 flex items-center gap-1 px-3 py-1.5 rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-[14px]">refresh</span> Resubmit
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Task 7 - Approved -->
                <div class="task-item bg-white rounded-xl border border-green-200 overflow-hidden" data-status="approved">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="badge badge-approved">Approved</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Approved: Oct 18, 2024</span>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">System Architecture Document</h4>
                            <p class="text-sm text-gray-500 mb-3">Document the overall system architecture including component diagrams and data flow.</p>
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">person</span> Assigned to: Maria Cruz</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">check_circle</span> Marked Complete</div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center justify-center gap-2 p-4 sm:border-l border-t sm:border-t-0 border-gray-100 bg-green-50/50 min-w-[140px]">
                            <div class="flex items-center gap-1.5 text-green-700">
                                <span class="material-symbols-outlined text-[22px]">task_alt</span>
                                <span class="text-xs font-semibold">Complete</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Task 8 - Approved -->
                <div class="task-item bg-white rounded-xl border border-green-200 overflow-hidden" data-status="approved">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="badge badge-approved">Approved</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Approved: Oct 15, 2024</span>
                                </div>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-1">Requirements Specification</h4>
                            <p class="text-sm text-gray-500 mb-3">Create the Software Requirements Specification (SRS) document with functional and non-functional requirements.</p>
                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">person</span> Assigned to: Sofia Lim</div>
                                <div class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">check_circle</span> Marked Complete</div>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-center justify-center gap-2 p-4 sm:border-l border-t sm:border-t-0 border-gray-100 bg-green-50/50 min-w-[140px]">
                            <div class="flex items-center gap-1.5 text-green-700">
                                <span class="material-symbols-outlined text-[22px]">task_alt</span>
                                <span class="text-xs font-semibold">Complete</span>
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

    <!-- Submit Task Modal -->
    <div id="submit-modal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center">
        <div class="modal-panel bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-lg mx-4 p-6">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 text-[22px]">upload_file</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Submit Task</h3>
                        <p class="text-sm text-gray-500" id="submit-task-name">—</p>
                    </div>
                </div>
                <button onclick="closeSubmitModal()" class="text-gray-400 hover:text-gray-600"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Upload File</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-gray-400 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-gray-300 text-[36px] mb-2">cloud_upload</span>
                        <p class="text-sm text-gray-500">Drag & drop your file here, or <span class="text-blue-600 font-medium">browse</span></p>
                        <p class="text-xs text-gray-400 mt-1">PDF, DOCX, ZIP up to 50MB</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Notes (Optional)</label>
                    <textarea rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none resize-none" placeholder="Add any notes for the project manager..."></textarea>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-6">
                <button onclick="closeSubmitModal()" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-200 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition-colors">Cancel</button>
                <button onclick="submitTask()" class="flex-1 px-4 py-2.5 rounded-lg bg-gray-900 text-white font-semibold text-sm hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">send</span>
                    Submit for Approval
                </button>
            </div>
        </div>
    </div>

    <!-- Assign Task Modal (PM only) -->
    <div id="assign-modal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center">
        <div class="modal-panel bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-lg mx-4 p-6">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                        <span class="material-symbols-outlined text-purple-600 text-[22px]">assignment_add</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Assign New Task</h3>
                        <p class="text-sm text-gray-500">Create and assign a task to a group member</p>
                    </div>
                </div>
                <button onclick="closeAssignModal()" class="text-gray-400 hover:text-gray-600"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Task Title</label>
                    <input type="text" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none" placeholder="e.g., Integration Testing">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                    <textarea rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none resize-none" placeholder="Describe the task requirements..."></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Assign To</label>
                        <select class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none bg-white">
                            <option>Alex Rivera</option>
                            <option>James Tan</option>
                            <option>Rosa Mendez</option>
                            <option>Sofia Lim</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Due Date</label>
                        <input type="date" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-gray-900 focus:border-transparent outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Attach File (Optional)</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-gray-400 transition-colors cursor-pointer">
                        <p class="text-sm text-gray-500"><span class="material-symbols-outlined text-gray-300 text-[18px] mr-1 align-middle">attach_file</span> Attach reference files</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-6">
                <button onclick="closeAssignModal()" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-200 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition-colors">Cancel</button>
                <button onclick="assignTask()" class="flex-1 px-4 py-2.5 rounded-lg bg-gray-900 text-white font-semibold text-sm hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">add_task</span>
                    Assign Task
                </button>
            </div>
        </div>
    </div>

    <!-- Reject Modal (PM only) -->
    <div id="reject-modal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center">
        <div class="modal-panel bg-white rounded-2xl shadow-2xl border border-gray-200 w-full max-w-lg mx-4 p-6">
            <div class="flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-600 text-[22px]">undo</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Return for Revision</h3>
                        <p class="text-sm text-gray-500" id="reject-task-name">—</p>
                    </div>
                </div>
                <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-600"><span class="material-symbols-outlined">close</span></button>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Feedback for Student</label>
                <textarea rows="4" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent outline-none resize-none" placeholder="Explain what needs to be revised..."></textarea>
            </div>
            <div class="flex items-center gap-3 mt-6">
                <button onclick="closeRejectModal()" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-200 text-gray-700 font-semibold text-sm hover:bg-gray-50 transition-colors">Cancel</button>
                <button onclick="rejectTask()" class="flex-1 px-4 py-2.5 rounded-lg bg-red-600 text-white font-semibold text-sm hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[16px]">undo</span>
                    Return to Student
                </button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div id="toast" class="fixed bottom-6 right-6 z-50 bg-green-600 text-white px-5 py-3 rounded-xl shadow-lg flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300">
        <span class="material-symbols-outlined text-[20px]">check_circle</span>
        <span class="font-medium text-sm" id="toast-msg">Action completed!</span>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', toggleSidebar);

        // Role switching
        function switchRole(role) {
            const studentBtn = document.getElementById('role-student');
            const pmBtn = document.getElementById('role-pm');
            const pmBar = document.getElementById('pm-assign-bar');
            const pmSections = document.querySelectorAll('.pm-review-section');

            if (role === 'pm') {
                pmBtn.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
                pmBtn.classList.remove('text-gray-500');
                studentBtn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
                studentBtn.classList.add('text-gray-500');
                pmBar.classList.remove('hidden');
                pmSections.forEach(s => s.classList.remove('hidden'));
            } else {
                studentBtn.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
                studentBtn.classList.remove('text-gray-500');
                pmBtn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
                pmBtn.classList.add('text-gray-500');
                pmBar.classList.add('hidden');
                pmSections.forEach(s => s.classList.add('hidden'));
            }
        }

        // Tab filtering
        function filterTasks(status, btn) {
            document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
            btn.classList.add('active');

            document.querySelectorAll('.task-item').forEach(item => {
                if (status === 'all' || item.dataset.status === status) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        // Submit modal
        function showSubmitModal(name) {
            document.getElementById('submit-task-name').textContent = name;
            document.getElementById('submit-modal').classList.add('active');
        }
        function closeSubmitModal() { document.getElementById('submit-modal').classList.remove('active'); }
        function submitTask() {
            closeSubmitModal();
            showToast('Task submitted for PM approval!');
        }

        // Assign modal
        function showAssignModal() { document.getElementById('assign-modal').classList.add('active'); }
        function closeAssignModal() { document.getElementById('assign-modal').classList.remove('active'); }
        function assignTask() {
            closeAssignModal();
            showToast('Task assigned successfully!');
        }

        // Reject modal
        function showRejectModal(name) {
            document.getElementById('reject-task-name').textContent = name;
            document.getElementById('reject-modal').classList.add('active');
        }
        function closeRejectModal() { document.getElementById('reject-modal').classList.remove('active'); }
        function rejectTask() {
            closeRejectModal();
            showToast('Task returned to student for revision.');
        }

        // Approve
        function approveTask(btn) {
            const card = btn.closest('.task-item');
            card.querySelector('.badge').className = 'badge badge-approved';
            card.querySelector('.badge').textContent = 'Approved';
            card.dataset.status = 'approved';
            card.classList.remove('border-gray-200');
            card.classList.add('border-green-200');
            const sidebar = card.querySelector('.bg-amber-50\\/50');
            if (sidebar) {
                sidebar.classList.remove('bg-amber-50/50');
                sidebar.classList.add('bg-green-50/50');
                sidebar.innerHTML = '<div class="flex items-center gap-1.5 text-green-700"><span class="material-symbols-outlined text-[22px]">task_alt</span><span class="text-xs font-semibold">Complete</span></div>';
            }
            btn.closest('.pm-review-section').remove();
            showToast('Task approved — marked as complete!');
        }

        // Toast
        function showToast(msg) {
            const t = document.getElementById('toast');
            document.getElementById('toast-msg').textContent = msg;
            t.classList.remove('translate-y-20', 'opacity-0');
            setTimeout(() => t.classList.add('translate-y-20', 'opacity-0'), 3000);
        }
    </script>
</body>
</html>
