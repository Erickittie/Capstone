<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Details - CarryOn Academic Management</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/course-detail.css') }}" rel="stylesheet">
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

        <!-- Course Banner Header -->
        <div class="bg-gradient-to-r from-[#0B8793] to-[#20BF6B] text-white px-6 py-6 md:px-8 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between shrink-0 gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-white/80">
                    <a href="/dashboard" class="hover:text-white transition">Dashboard</a>
                    <span>/</span>
                    <span id="banner-breadcrumb" class="text-white">Capstone 1</span>
                </div>
                <h1 id="banner-title" class="text-2xl md:text-3xl font-black mt-1.5">[11010] Capstone Project 1</h1>
                <p id="banner-subtitle" class="text-white/80 text-sm mt-0.5 font-medium">Summer Semester 2026 &bull; Section A &bull; Dr. Julian Vance</p>
            </div>
            
            <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/20 self-start md:self-auto">
                <span class="material-symbols-outlined text-[24px] text-white/95">groups</span>
                <div>
                    <span class="block text-[11px] uppercase tracking-wider text-white/70 font-bold leading-none">Total Enrolled</span>
                    <span class="block text-lg font-bold text-white mt-1 leading-none" id="total-student-badge">12 Students</span>
                </div>
            </div>
        </div>

        <!-- Custom Tab Navigation Bar -->
        <div class="bg-white border-b border-gray-200 px-6 md:px-8 shrink-0 flex items-center justify-between overflow-x-auto scrollbar-none">
            <div class="flex gap-6 text-[14px] whitespace-nowrap">
                <button id="tab-courses" class="tab-btn py-4 text-gray-500 hover:text-gray-900 font-medium active">
                    Overview
                </button>
                <button id="tab-students" class="tab-btn py-4 text-gray-500 hover:text-gray-900 font-medium">
                    👥 Roster & CSV Import
                </button>
                <button id="tab-groupings" class="tab-btn py-4 text-gray-500 hover:text-gray-900 font-medium">
                    🔀 Student Groupings
                </button>
                <button id="tab-announcements" class="tab-btn py-4 text-gray-500 hover:text-gray-900 font-medium">
                    📢 Announcements
                </button>
                <button id="tab-requests" class="tab-btn py-4 text-gray-500 hover:text-gray-900 font-medium relative">
                    📥 Join & Task Requests
                    <span class="absolute top-2 right-[-8px] w-2 h-2 bg-red-500 rounded-full" id="requests-dot"></span>
                </button>
            </div>
            
            <div class="hidden lg:flex items-center gap-2 py-2 shrink-0">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-xs text-gray-500 font-medium">Live Session Connected</span>
            </div>
        </div>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-6">

            <!-- ================= TAB 1: OVERVIEW ================= -->
            <div id="content-courses" class="space-y-6">
                <!-- Course Card Banner/Overview -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm space-y-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 leading-tight">[11010] Capstone Project 1 Overview</h2>
                        <p class="text-xs text-gray-500 mt-1 font-medium">Summer Semester 2026 &bull; Section A</p>
                    </div>

                    <div class="prose max-w-none text-sm text-gray-650 space-y-4">
                        <p>
                            The Capstone Project 1 course is a culminating, multi-disciplinary team-based design experience. 
                            It provides students with the opportunity to integrate foundational concepts and apply software engineering methodology, 
                            project management strategies, and architectural designs to build solutions for real-world academic or industry problems.
                        </p>
                        <p>
                            In this semester, the curriculum is structured around forming high-functioning engineering teams, establishing clear 
                            backlogs and sprints, designing robust system architectures, and executing on the initial proof-of-concept.
                        </p>
                    </div>

                    <!-- Course Core Objectives Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 border-t border-gray-150">
                        <div class="p-4 rounded-xl bg-teal-50/50 border border-teal-150/40">
                            <div class="flex items-center gap-2 text-teal-800 font-bold text-xs uppercase tracking-wide">
                                <span class="material-symbols-outlined text-[18px]">groups</span>
                                <span>Team & Proposal Setup</span>
                            </div>
                            <p class="text-xs text-gray-650 mt-2">Define project scope, allocate roles, and establish collaboration and version control rules.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-purple-50/50 border border-purple-150/40">
                            <div class="flex items-center gap-2 text-purple-800 font-bold text-xs uppercase tracking-wide">
                                <span class="material-symbols-outlined text-[18px]">schema</span>
                                <span>System Architecture</span>
                            </div>
                            <p class="text-xs text-gray-650 mt-2">Construct UML models, database schemas, API contracts, and user interface mockups.</p>
                        </div>
                        <div class="p-4 rounded-xl bg-amber-50/50 border border-amber-150/40">
                            <div class="flex items-center gap-2 text-amber-800 font-bold text-xs uppercase tracking-wide">
                                <span class="material-symbols-outlined text-[18px]">developer_mode</span>
                                <span>Proof of Concept</span>
                            </div>
                            <p class="text-xs text-gray-650 mt-2">Develop a functional prototype demonstrating core mechanics and validating key technical assumptions.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= TAB 2: ROSTER & CSV IMPORT ================= -->
            <div id="content-students" class="hidden space-y-6">
                <!-- Split Grid: Left Roster Table, Right Add/Import Options -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-start">
                    <!-- Left: Current Class Roster (3 Cols wide) -->
                    <div class="lg:col-span-3 bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-150 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-gray-50/50">
                            <div>
                                <h3 class="text-[15px] font-bold text-gray-900">Current Student Roster</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Students registered in Capstone Project 1.</p>
                            </div>
                            <div class="relative max-w-xs w-full sm:w-64">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[18px]">search</span>
                                <input type="text" id="roster-search" placeholder="Search student roster..." class="w-full pl-9 pr-3 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-1 focus:ring-black focus:border-black bg-white transition">
                            </div>
                        </div>

                        <!-- Roster Table -->
                        <div class="overflow-x-auto max-h-[460px] overflow-y-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                                        <th class="px-6 py-3">Student Name</th>
                                        <th class="px-6 py-3">Student ID</th>
                                        <th class="px-6 py-3">Email Address</th>
                                        <th class="px-6 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="student-roster-body" class="divide-y divide-gray-150 text-[13px]">
                                    <!-- Populated dynamically via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right: Add / Import CSV Options (2 Cols wide) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- CSV File Import Box -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-6 space-y-5">
                            <div class="flex items-center justify-between border-b border-gray-150 pb-3">
                                <h3 class="text-[15px] font-bold text-gray-900">Import Student CSV Roster</h3>
                                <span class="material-symbols-outlined text-gray-400 text-[20px]">upload_file</span>
                            </div>

                            <!-- Drop Zone -->
                            <div id="drop-zone" class="border-2 border-dashed border-gray-200 hover:border-black rounded-xl p-8 text-center cursor-pointer transition bg-gray-50/50 hover:bg-gray-50 flex flex-col items-center justify-center space-y-3 group">
                                <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-black transition">cloud_upload</span>
                                <div>
                                    <p class="text-[14px] font-semibold text-gray-900">Drag & drop your CSV file here</p>
                                    <p class="text-[11px] text-gray-400 mt-1">Roster CSV layout (Name, Email, StudentID)</p>
                                </div>
                                <input type="file" id="csv-file-input" class="hidden" accept=".csv">
                                <button type="button" id="browse-btn" class="px-4 py-2 border border-gray-200 hover:bg-white text-gray-700 font-semibold text-[12px] rounded-lg transition bg-gray-50">
                                    Browse Files
                                </button>
                            </div>

                            <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg border border-gray-150">
                                <div class="flex items-center gap-2.5">
                                    <span class="material-symbols-outlined text-gray-400">download_sheet</span>
                                    <div class="text-[12px]">
                                        <span class="font-semibold block text-gray-900">CarryOn Roster Template</span>
                                        <span class="text-gray-400 block -mt-0.5">Template CSV file format</span>
                                    </div>
                                </div>
                                <a href="#" onclick="alert('Downloading template CSV...')" class="text-[12px] font-semibold text-gray-955 hover:underline">Download</a>
                            </div>
                        </div>

                        <!-- Manual Add Student Form -->
                        <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-6 space-y-4">
                            <div class="flex items-center justify-between border-b border-gray-150 pb-3">
                                <h3 class="text-[15px] font-bold text-gray-900">Add Student Manually</h3>
                                <span class="material-symbols-outlined text-gray-400 text-[20px]">person_add</span>
                            </div>
                            <form id="manual-add-form" class="space-y-4" onsubmit="event.preventDefault(); handleManualAdd();">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Full Name</label>
                                    <input type="text" id="manual-name" placeholder="e.g. Marcus Aurelius" required class="w-full border border-gray-200 rounded-lg text-xs py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Student ID</label>
                                        <input type="text" id="manual-id" placeholder="e.g. 2026-9099" required class="w-full border border-gray-200 rounded-lg text-xs py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Email Address</label>
                                        <input type="email" id="manual-email" placeholder="e.g. m.aurelius@inst.edu" required class="w-full border border-gray-200 rounded-lg text-xs py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition">
                                    </div>
                                </div>
                                <button type="submit" class="w-full py-2.5 bg-black hover:bg-gray-800 text-white font-semibold text-[13px] rounded-lg transition flex items-center justify-center gap-1.5 shadow-sm">
                                    <span class="material-symbols-outlined text-[16px]">add</span>
                                    <span>Enroll Student</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- CSV Preview Modal/Card if parsed -->
                <div id="roster-preview-card" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hidden transition-all duration-300">
                    <div class="px-6 py-4 border-b border-gray-150 flex items-center justify-between bg-teal-50/20">
                        <div>
                            <h3 class="text-[14px] font-bold text-teal-800 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px] text-teal-600 animate-pulse">playlist_add_check</span>
                                <span>Parsed CSV Preview (<span id="parsed-count">0</span> students found)</span>
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">Please review the imported students list below before final enrollment.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button id="clear-roster-btn" class="px-3 py-1.5 border border-gray-200 text-gray-600 hover:bg-gray-50 text-[12px] font-semibold rounded-lg transition">Cancel</button>
                            <button id="confirm-roster-btn" class="px-4 py-1.5 bg-teal-600 hover:bg-teal-700 text-white text-[12px] font-semibold rounded-lg transition shadow-sm">Confirm & Import</button>
                        </div>
                    </div>
                    <div class="max-h-60 overflow-y-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/80 text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                                    <th class="px-6 py-2.5">Name</th>
                                    <th class="px-6 py-2.5">Student ID</th>
                                    <th class="px-6 py-2.5">Email</th>
                                    <th class="px-6 py-2.5 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody id="roster-preview-body" class="divide-y divide-gray-150 text-[13px]">
                                <!-- CSV Rows parsed here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ================= TAB 3: STUDENT GROUPINGS ================= -->
            <div id="content-groupings" class="hidden space-y-6 flex-1 flex flex-col">
                <!-- Group Settings Controls Bar -->
                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4 shrink-0 bg-white border border-gray-200 p-4 rounded-xl shadow-xs">
                    <div class="flex flex-wrap items-center gap-4">
                        <!-- Group For Selector (Project, Activity) -->
                        <div class="flex items-center gap-2">
                            <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Group Assignment For:</label>
                            <select id="group-target" class="border border-gray-200 rounded-lg text-xs py-1.5 px-3 focus:outline-none focus:ring-1 focus:ring-black focus:border-black bg-gray-50/50">
                                <option value="" selected>Select a project task</option>
                                <optgroup label="💼 Capstone Projects" id="group-target-projects">
                                    <option value="capstone-milestone-1">Capstone Milestone 1 - Proposal & Team Setup</option>
                                    <option value="capstone-milestone-2">Capstone Milestone 2 - System Architecture</option>
                                    <option value="capstone-final">Capstone Final Defense & Presentation</option>
                                </optgroup>
                                <optgroup label="📋 Classroom Activities" id="group-target-activities">
                                    <option value="activity-1">Activity 1 - Threat Modeling Exercise</option>
                                    <option value="activity-2">Activity 2 - Agile Backlog Sprint Planning</option>
                                    <option value="activity-3">Activity 3 - Git Merge Conflict Resolution</option>
                                </optgroup>
                            </select>
                        </div>
                        
                        <!-- Groups Counter selection -->
                        <div class="flex items-center gap-2">
                            <label for="groups-count" class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Divide Into:</label>
                            <input type="number" id="groups-count" value="3" min="2" max="6" class="w-14 border border-gray-200 rounded-lg text-xs py-1.5 px-2.5 focus:outline-none focus:ring-1 focus:ring-black focus:border-black">
                            <span class="text-xs text-gray-400">Teams</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button id="randomize-btn" class="px-4 py-2 bg-black hover:bg-gray-800 text-white rounded-lg text-[13px] font-semibold transition flex items-center gap-1.5 shadow-sm">
                            <span class="material-symbols-outlined text-[16px]">shuffle</span>
                            <span>Auto Allocate</span>
                        </button>
                        <button id="reset-btn" class="px-4 py-2 border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-lg text-[13px] font-semibold transition">
                            Reset Board
                        </button>
                        <button onclick="alert('Group configuration saved successfully!')" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg text-[13px] font-semibold transition flex items-center gap-1.5 shadow-sm">
                            <span class="material-symbols-outlined text-[16px]">save</span>
                            <span>Save Groupings</span>
                        </button>
                    </div>
                </div>

                <!-- Groupings Main UI container, hidden by default -->
                <div id="groupings-main-ui" class="space-y-6 hidden">
                    <!-- Workflow Selector (Sketch Flows: Box 1 & Box 2) -->
                    <div class="bg-white border border-gray-200 p-5 rounded-xl shadow-xs space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-150 pb-3 gap-3">
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Grouping Creation Order (Workflow Mode)</span>
                                <h4 class="text-sm font-bold text-gray-900 mt-0.5">Determine how groupings and projects relate</h4>
                            </div>
                            <div class="flex bg-gray-150 p-0.5 rounded-lg border border-gray-200 self-start sm:self-auto">
                                <button id="wf-mode-a" class="px-3.5 py-1 text-xs font-semibold rounded-md bg-white text-gray-900 shadow-xs transition">
                                    Flow A: Make Activity First
                                </button>
                                <button id="wf-mode-b" class="px-3.5 py-1 text-xs font-semibold rounded-md text-gray-500 hover:text-gray-900 transition">
                                    Flow B: Create Group First
                                </button>
                            </div>
                        </div>
                        
                        <!-- Visual Helper step diagram depending on selected Mode -->
                        <div id="wf-helper-mode-a" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-teal-50/40 border border-teal-100 p-3 rounded-lg flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-xs mt-0.5">1</span>
                                <div class="text-xs">
                                    <span class="font-bold text-teal-800 block">Create Activity / Project first</span>
                                    <span class="text-gray-500 block mt-0.5">Define milestones, instructions, and parameters first.</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 border border-gray-150 p-3 rounded-lg flex items-start gap-2.5 opacity-80">
                                <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center font-bold text-xs mt-0.5">2</span>
                                <div class="text-xs">
                                    <span class="font-bold text-gray-700 block">Form or Select Student Groups</span>
                                    <span class="text-gray-500 block mt-0.5">Drag-and-drop students or random-allocate students to groups.</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 border border-gray-150 p-3 rounded-lg flex items-start gap-2.5 opacity-80">
                                <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center font-bold text-xs mt-0.5">3</span>
                                <div class="text-xs">
                                    <span class="font-bold text-gray-700 block">Bind and Deploy</span>
                                    <span class="text-gray-500 block mt-0.5">Deploy the created project directly to the custom groups.</span>
                                </div>
                            </div>
                        </div>

                        <div id="wf-helper-mode-b" class="grid grid-cols-1 md:grid-cols-3 gap-4 hidden">
                            <div class="bg-indigo-50/40 border border-indigo-100 p-3 rounded-lg flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs mt-0.5">1</span>
                                <div class="text-xs">
                                    <span class="font-bold text-indigo-800 block">Create Groups First</span>
                                    <span class="text-gray-500 block mt-0.5">Divide your roster into teams first using randomize/drag-drop.</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 border border-gray-150 p-3 rounded-lg flex items-start gap-2.5 opacity-80">
                                <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center font-bold text-xs mt-0.5">2</span>
                                <div class="text-xs">
                                    <span class="font-bold text-gray-700 block">Establish Activities / Projects</span>
                                    <span class="text-gray-500 block mt-0.5">Set up the deliverables and bind them to the existing groups.</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 border border-gray-150 p-3 rounded-lg flex items-start gap-2.5 opacity-80">
                                <span class="w-5 h-5 rounded-full bg-gray-400 text-white flex items-center justify-center font-bold text-xs mt-0.5">3</span>
                                <div class="text-xs">
                                    <span class="font-bold text-gray-700 block">Track Live Contribution</span>
                                    <span class="text-gray-500 block mt-0.5">Groups tackle multiple projects over the semester seamlessly.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Drag-and-Drop Board Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 min-h-[500px]">
                        <!-- Left: Unassigned Students Pool -->
                        <div class="lg:col-span-1 bg-white border border-gray-200 rounded-xl shadow-xs flex flex-col h-[520px] lg:h-auto overflow-hidden">
                            <div class="px-5 py-4 border-b border-gray-150 flex items-center justify-between shrink-0 bg-gray-50/20">
                                <h3 class="text-[12px] font-bold text-gray-500 uppercase tracking-wider">Unassigned Pool</h3>
                                <span id="unassigned-count" class="px-2 py-0.5 text-[11px] font-bold bg-gray-100 text-gray-700 rounded-full">0</span>
                            </div>
                            <div id="unassigned-container" class="p-4 space-y-3 overflow-y-auto flex-1 bg-gray-50/30 border-dashed border-2 border-transparent transition" dropzone="true">
                                <!-- Student draggable cards go here -->
                            </div>
                        </div>

                        <!-- Right: Group/Team Columns -->
                        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch h-full lg:h-auto overflow-y-auto" id="group-containers-grid">
                            <!-- Group Bins dynamically generated here -->
                        </div>
                    </div>
                </div>

                <!-- Groupings Placeholder card, visible by default -->
                <div id="groupings-placeholder" class="bg-white border border-gray-200 rounded-xl p-16 text-center flex flex-col items-center justify-center space-y-4 shadow-sm">
                    <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 mb-2 border border-gray-150">
                        <span class="material-symbols-outlined text-3xl">fact_check</span>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg">No Project Task Selected</h3>
                    <p class="text-xs text-gray-500 max-w-sm leading-relaxed">Select a project task or classroom activity from the dropdown menu above to start managing and allocating student groups.</p>
                </div>
            </div>

            <!-- ================= TAB 4: ANNOUNCEMENTS ================= -->
            <div id="content-announcements" class="hidden space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                    <!-- Left Column: Form (1 Col) -->
                    <div class="bg-white border border-gray-200 rounded-xl shadow-xs p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-150 pb-3">
                            <h3 class="text-[15px] font-bold text-gray-900">Post Announcement</h3>
                            <span class="material-symbols-outlined text-gray-400">campaign</span>
                        </div>
                        <form id="announcement-form" class="space-y-4" onsubmit="event.preventDefault(); handlePostAnnouncement();">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Announcement Title</label>
                                <input type="text" id="ann-title" placeholder="e.g. Milestone 1 Deliverables Updated" required class="w-full border border-gray-200 rounded-lg text-xs py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Announcement Content</label>
                                <textarea id="ann-content" rows="4" placeholder="Type instructions, news, or notifications for students..." required class="w-full border border-gray-200 rounded-lg text-xs py-2 px-3 focus:outline-none focus:ring-1 focus:ring-black"></textarea>
                            </div>
                            <button type="submit" class="w-full py-2.5 bg-black hover:bg-gray-800 text-white font-semibold text-[13px] rounded-lg transition shadow-sm">
                                Deploy Announcement
                            </button>
                        </form>
                    </div>

                    <!-- Right Column: Announcements feed (2 Cols) -->
                    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-xs overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-150 flex items-center justify-between bg-gray-50/50">
                            <div>
                                <h3 class="text-[15px] font-bold text-gray-900">Broadcast History</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Announcements posted to Capstone Project 1.</p>
                            </div>
                            <span class="px-2 py-0.5 text-[11px] font-bold bg-teal-50 text-teal-700 rounded-full" id="ann-stat-badge">2 Posted</span>
                        </div>
                        <div class="divide-y divide-gray-150" id="announcements-feed-container">
                            <!-- Announcements posted here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= TAB 5: JOIN & TASK REQUESTS ================= -->
            <div id="content-requests" class="hidden space-y-6">
                <!-- Requests grid -->
                <div class="max-w-4xl mx-auto space-y-4">
                    <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-xs flex items-center justify-between">
                        <div>
                            <h3 class="text-[15px] font-bold text-gray-900">Instructor Action Requests</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Manage class join requests, calendar dates adjustments, and exception approvals.</p>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-bold bg-red-50 text-red-600 rounded-full" id="requests-header-badge">3 Pending</span>
                    </div>

                    <!-- List container -->
                    <div class="space-y-3" id="requests-list-container">
                        <!-- Request 1: Class Join -->
                        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition hover:border-gray-300" id="req-1">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    AG
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-gray-900">Alexander the Great</span>
                                        <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 rounded-md">Join Class</span>
                                    </div>
                                    <span class="block text-xs text-gray-500 mt-0.5">Email: alexander@institution.edu &bull; Student ID: 2026-9912</span>
                                    <p class="text-xs text-gray-600 mt-2 bg-gray-50 p-2.5 rounded-lg border border-gray-100">"I recently added this subject to my summer loader, please enroll me to the roster and assign me a grouping bin."</p>
                                </div>
                            </div>
                            <div class="flex sm:flex-col gap-2 shrink-0 self-end sm:self-auto">
                                <button onclick="handleApproveJoin('req-1', '2026-9912', 'Alexander the Great', 'alexander@institution.edu')" class="px-4 py-1.5 bg-teal-600 hover:bg-teal-700 text-white font-semibold text-xs rounded-lg transition shadow-xs">
                                    Approve Join
                                </button>
                                <button onclick="handleRejectRequest('req-1')" class="px-4 py-1.5 border border-gray-200 hover:bg-gray-50 text-gray-600 font-semibold text-xs rounded-lg transition">
                                    Decline
                                </button>
                            </div>
                        </div>

                        <!-- Request 2: Calendar Approval -->
                        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition hover:border-gray-300" id="req-2">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    GA
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-gray-900">Group Alpha</span>
                                        <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider bg-purple-50 text-purple-700 rounded-md">Calendar Event Approval</span>
                                    </div>
                                    <span class="block text-xs text-gray-500 mt-0.5">Capstone 1 &bull; Proposal & Team Setup</span>
                                    <p class="text-xs text-gray-600 mt-2 bg-gray-50 p-2.5 rounded-lg border border-gray-100">Requesting approval to schedule a peer-review consult slot on <strong>July 20, 2026 (10:00 AM)</strong>. Requires instructor approval for calendar reservation.</p>
                                </div>
                            </div>
                            <div class="flex sm:flex-col gap-2 shrink-0 self-end sm:self-auto">
                                <button onclick="handleApproveRequest('req-2', 'Calendar reservation approved and updated!')" class="px-4 py-1.5 bg-teal-600 hover:bg-teal-700 text-white font-semibold text-xs rounded-lg transition shadow-xs">
                                    Approve Date
                                </button>
                                <button onclick="handleRejectRequest('req-2')" class="px-4 py-1.5 border border-gray-200 hover:bg-gray-50 text-gray-600 font-semibold text-xs rounded-lg transition">
                                    Decline
                                </button>
                            </div>
                        </div>

                        <!-- Request 3: Grouping Exception -->
                        <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition hover:border-gray-300" id="req-3">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-sm shrink-0">
                                    JC
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-gray-900">Julius Caesar</span>
                                        <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 rounded-md">Group Transfer Request</span>
                                    </div>
                                    <span class="block text-xs text-gray-500 mt-0.5">Email: caesar@institution.edu &bull; Student ID: 2026-8841</span>
                                    <p class="text-xs text-gray-600 mt-2 bg-gray-50 p-2.5 rounded-lg border border-gray-100">Requested exception transfer: Move student from <strong>Group Beta</strong> to <strong>Group Alpha</strong>. Approved by team leads of both groups.</p>
                                </div>
                            </div>
                            <div class="flex sm:flex-col gap-2 shrink-0 self-end sm:self-auto">
                                <button onclick="handleApproveTransfer('req-3', '2026-8841', 'group-1')" class="px-4 py-1.5 bg-teal-600 hover:bg-teal-700 text-white font-semibold text-xs rounded-lg transition shadow-xs">
                                    Approve Move
                                </button>
                                <button onclick="handleRejectRequest('req-3')" class="px-4 py-1.5 border border-gray-200 hover:bg-gray-50 text-gray-600 font-semibold text-xs rounded-lg transition">
                                    Decline
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Script Logic -->
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

        // ================= TASK-BASED BANNER UPDATE =================
        // Map task query param values to display info
        const taskMap = {
            'capstone-milestone-1': {
                breadcrumb: 'Milestone 1',
                title: 'Capstone Milestone 1 - Proposal & Team Setup',
                subtitle: 'Summer Semester 2026 • Section A • Dr. Julian Vance'
            },
            'capstone-milestone-2': {
                breadcrumb: 'Milestone 2',
                title: 'Capstone Milestone 2 - System Architecture',
                subtitle: 'Summer Semester 2026 • Section A • Dr. Julian Vance'
            },
            'capstone-final': {
                breadcrumb: 'Final Defense',
                title: 'Capstone Final Defense & Presentation',
                subtitle: 'Summer Semester 2026 • Section A • Dr. Julian Vance'
            },
            'activity-1': {
                breadcrumb: 'Activity 1',
                title: 'Activity 1 - Threat Modeling Exercise',
                subtitle: 'Summer Semester 2026 • Section A • Dr. Julian Vance'
            },
            'activity-2': {
                breadcrumb: 'Activity 2',
                title: 'Activity 2 - Agile Backlog Sprint Planning',
                subtitle: 'Summer Semester 2026 • Section A • Dr. Julian Vance'
            },
            'activity-3': {
                breadcrumb: 'Activity 3',
                title: 'Activity 3 - Git Merge Conflict Resolution',
                subtitle: 'Summer Semester 2026 • Section A • Dr. Julian Vance'
            }
        };

        // Read query param and update banner
        const urlParams = new URLSearchParams(window.location.search);
        const taskParam = urlParams.get('task');
        if (taskParam && taskMap[taskParam]) {
            const info = taskMap[taskParam];
            // Update breadcrumb text
            document.getElementById('banner-breadcrumb').textContent = info.breadcrumb;
            // Update main title
            document.getElementById('banner-title').textContent = info.title;
            // Update subtitle
            document.getElementById('banner-subtitle').textContent = info.subtitle;

            // Also pre-select matching option in the groupings dropdown
            const groupTarget = document.getElementById('group-target');
            if (groupTarget) {
                for (let i = 0; i < groupTarget.options.length; i++) {
                    if (groupTarget.options[i].value === taskParam) {
                        groupTarget.selectedIndex = i;
                        break;
                    }
                }
            }
        }

        // Tab Switching logic
        const tabs = {
            'tab-courses': document.getElementById('content-courses'),
            'tab-students': document.getElementById('content-students'),
            'tab-groupings': document.getElementById('content-groupings'),
            'tab-announcements': document.getElementById('content-announcements'),
            'tab-requests': document.getElementById('content-requests')
        };

        function switchTab(activeId) {
            Object.keys(tabs).forEach(tabId => {
                const btn = document.getElementById(tabId);
                const content = tabs[tabId];
                if (tabId === activeId) {
                    btn.classList.add('active', 'text-gray-900', 'font-semibold');
                    btn.classList.remove('text-gray-500');
                    content.classList.remove('hidden');
                } else {
                    btn.classList.remove('active', 'text-gray-900', 'font-semibold');
                    btn.classList.add('text-gray-500');
                    content.classList.add('hidden');
                }
            });
            // Re-render groupings board if tab groupings is clicked to ensure heights match
            if (activeId === 'tab-groupings') {
                updateGroupingsUiState();
            }
        }

        document.getElementById('tab-courses').addEventListener('click', () => switchTab('tab-courses'));
        document.getElementById('tab-students').addEventListener('click', () => switchTab('tab-students'));
        document.getElementById('tab-groupings').addEventListener('click', () => switchTab('tab-groupings'));
        document.getElementById('tab-announcements').addEventListener('click', () => switchTab('tab-announcements'));
        document.getElementById('tab-requests').addEventListener('click', () => switchTab('tab-requests'));

        // Mock student database
        let students = [
            { id: "2026-9041", name: "Liam Chen", email: "l.chen@institution.edu", initials: "LC", color: "blue" },
            { id: "2026-8812", name: "Sarah Miller", email: "s.miller@institution.edu", initials: "SM", color: "emerald" },
            { id: "2026-3401", name: "Emma Wilson", email: "e.wilson@institution.edu", initials: "EW", color: "purple" },
            { id: "2026-9099", name: "Marcus Aurelius", email: "m.aurelius@institution.edu", initials: "MA", color: "amber" },
            { id: "2026-7811", name: "Sophia Reynolds", email: "s.reynolds@institution.edu", initials: "SR", color: "pink" },
            { id: "2026-1021", name: "Jacob Jones", email: "j.jones@institution.edu", initials: "JJ", color: "teal" },
            { id: "2026-4439", name: "Naomi Takahashi", email: "n.taka@institution.edu", initials: "NT", color: "red" },
            { id: "2026-8902", name: "Carlos Santana", email: "c.santana@institution.edu", initials: "CS", color: "indigo" },
            { id: "2026-1120", name: "Isabella Martinez", email: "i.martinez@institution.edu", initials: "IM", color: "rose" },
            { id: "2026-5544", name: "David Kim", email: "d.kim@institution.edu", initials: "DK", color: "emerald" },
            { id: "2026-2230", name: "Aria Smith", email: "a.smith@institution.edu", initials: "AS", color: "sky" },
            { id: "2026-7788", name: "Ethan Vance", email: "e.vance@institution.edu", initials: "EV", color: "indigo" }
        ];

        // Track placements: studentId -> 'unassigned' or 'group-1', 'group-2', etc.
        let studentPlacements = {};

        // Color mapper helper
        const colors = {
            blue: { bg: 'bg-blue-50', text: 'text-blue-700' },
            emerald: { bg: 'bg-emerald-50', text: 'text-emerald-700' },
            purple: { bg: 'bg-purple-50', text: 'text-purple-700' },
            amber: { bg: 'bg-amber-50', text: 'text-amber-700' },
            pink: { bg: 'bg-pink-50', text: 'text-pink-700' },
            teal: { bg: 'bg-teal-50', text: 'text-teal-700' },
            red: { bg: 'bg-red-50', text: 'text-red-700' },
            indigo: { bg: 'bg-indigo-50', text: 'text-indigo-700' },
            rose: { bg: 'bg-rose-50', text: 'text-rose-700' },
            sky: { bg: 'bg-sky-50', text: 'text-sky-700' }
        };

        // Initialize Placements
        function initPlacements() {
            students.forEach(s => {
                if (!studentPlacements[s.id]) {
                    studentPlacements[s.id] = 'unassigned';
                }
            });
        }

        // Render Roster list
        function renderRoster() {
            const tbody = document.getElementById('student-roster-body');
            const searchVal = document.getElementById('roster-search').value.toLowerCase();
            tbody.innerHTML = '';

            const filtered = students.filter(s => 
                s.name.toLowerCase().includes(searchVal) ||
                s.id.includes(searchVal) ||
                s.email.toLowerCase().includes(searchVal)
            );

            // Update badge in courses view and banner
            document.getElementById('total-student-badge').innerText = `${students.length} Students`;
            const row1Stat = document.getElementById('course-r1-stat');
            if (row1Stat) {
                row1Stat.innerText = `${students.length} Students Roster`;
            }

            if (filtered.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                            <span class="material-symbols-outlined text-3xl mb-1 block">search_off</span>
                            No matching students found
                        </td>
                    </tr>
                `;
                return;
            }

            filtered.forEach(s => {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-gray-50/50 transition';
                
                const colorObj = colors[s.color] || colors.blue;
                
                tr.innerHTML = `
                    <td class="px-6 py-3 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full ${colorObj.bg} ${colorObj.text} flex items-center justify-center font-bold text-[12px]">
                            ${s.initials}
                        </div>
                        <span class="font-semibold text-gray-900 block truncate">${s.name}</span>
                    </td>
                    <td class="px-6 py-3 font-mono text-[11px] text-gray-500">${s.id}</td>
                    <td class="px-6 py-3 text-gray-500 text-xs">${s.email}</td>
                    <td class="px-6 py-3 text-right">
                        <button onclick="removeStudent('${s.id}')" class="text-red-500 hover:text-red-700 font-semibold text-xs flex items-center gap-1 ml-auto">
                            <span class="material-symbols-outlined text-[16px]">delete</span>
                            Remove
                        </button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Add Student manually
        function handleManualAdd() {
            const name = document.getElementById('manual-name').value.trim();
            const id = document.getElementById('manual-id').value.trim();
            const email = document.getElementById('manual-email').value.trim();

            if (students.find(s => s.id === id)) {
                alert('A student with this ID is already enrolled!');
                return;
            }

            const nameParts = name.split(' ');
            const initials = nameParts.map(p => p[0]).slice(0, 2).join('').toUpperCase();
            
            const colorKeys = Object.keys(colors);
            const randomColor = colorKeys[Math.floor(Math.random() * colorKeys.length)];

            const newSt = { id, name, email, initials, color: randomColor };
            students.push(newSt);
            studentPlacements[id] = 'unassigned';

            // Reset form
            document.getElementById('manual-name').value = '';
            document.getElementById('manual-id').value = '';
            document.getElementById('manual-email').value = '';

            renderRoster();
            renderGroupingsBoard();
            alert(`${name} enrolled successfully!`);
        }

        // Remove student
        function removeStudent(stId) {
            if (confirm('Are you sure you want to remove this student?')) {
                students = students.filter(s => s.id !== stId);
                delete studentPlacements[stId];
                renderRoster();
                renderGroupingsBoard();
            }
        }

        // Search Roster
        document.getElementById('roster-search').addEventListener('input', renderRoster);



        // ================= CSV Parsing Simulator =================
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('csv-file-input');
        const browseBtn = document.getElementById('browse-btn');
        const previewCard = document.getElementById('roster-preview-card');
        const previewBody = document.getElementById('roster-preview-body');
        const parsedCountSpan = document.getElementById('parsed-count');
        const clearBtn = document.getElementById('clear-roster-btn');
        const confirmBtn = document.getElementById('confirm-roster-btn');

        const csvMockData = [
            { id: "2026-8841", name: "Julius Caesar", email: "caesar@institution.edu" },
            { id: "2026-7732", name: "Cleopatra Philopator", email: "cleo@institution.edu" },
            { id: "2026-1104", name: "Joan of Arc", email: "joan@institution.edu" },
            { id: "2026-4409", name: "Leonardo da Vinci", email: "vinci@institution.edu" }
        ];

        function handleCSVImport() {
            previewBody.innerHTML = '';
            csvMockData.forEach(st => {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-gray-50/50 transition';
                
                const initials = st.name.split(' ').map(n => n[0]).slice(0, 2).join('');
                
                tr.innerHTML = `
                    <td class="px-6 py-2.5 flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full bg-teal-50 text-teal-700 flex items-center justify-center font-bold text-[10px]">
                            ${initials}
                        </div>
                        <span class="font-semibold text-gray-900 block truncate">${st.name}</span>
                    </td>
                    <td class="px-6 py-2.5 font-mono text-[11px] text-gray-500">${st.id}</td>
                    <td class="px-6 py-2.5 text-gray-500 text-xs">${st.email}</td>
                    <td class="px-6 py-2.5 text-right">
                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-teal-600 bg-teal-50 px-2 py-0.5 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span> Ready
                        </span>
                    </td>
                `;
                previewBody.appendChild(tr);
            });

            parsedCountSpan.innerText = csvMockData.length;
            previewCard.classList.remove('hidden');
            previewCard.scrollIntoView({ behavior: 'smooth' });
        }

        browseBtn.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', handleCSVImport);

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drop-zone-active');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('drop-zone-active');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drop-zone-active');
            handleCSVImport();
        });

        clearBtn.addEventListener('click', () => {
            previewCard.classList.add('hidden');
            previewBody.innerHTML = '';
            fileInput.value = '';
        });

        confirmBtn.addEventListener('click', () => {
            let newlyEnrolledCount = 0;
            csvMockData.forEach(st => {
                if (!students.find(s => s.id === st.id)) {
                    const initials = st.name.split(' ').map(n => n[0]).slice(0, 2).join('');
                    const colorKeys = Object.keys(colors);
                    const randomColor = colorKeys[Math.floor(Math.random() * colorKeys.length)];

                    students.push({
                        id: st.id,
                        name: st.name,
                        email: st.email,
                        initials: initials,
                        color: randomColor
                    });
                    studentPlacements[st.id] = 'unassigned';
                    newlyEnrolledCount++;
                }
            });
            renderRoster();
            renderGroupingsBoard();
            previewCard.classList.add('hidden');
            previewBody.innerHTML = '';
            fileInput.value = '';
            alert(`Roster updated! ${newlyEnrolledCount} new students successfully imported.`);
        });

        // ================= STUDENT GROUPINGS BOARD LOGIC =================
        const unassignedContainer = document.getElementById('unassigned-container');
        const groupsCountInput = document.getElementById('groups-count');
        const groupingsGrid = document.getElementById('group-containers-grid');
        const randomizeBtn = document.getElementById('randomize-btn');
        const resetBtn = document.getElementById('reset-btn');

        // Dynamic creation of group columns
        function renderGroupingsBoard() {
            const count = parseInt(groupsCountInput.value) || 3;
            groupingsGrid.innerHTML = '';
            
            groupingsGrid.className = `lg:col-span-3 grid grid-cols-1 md:grid-cols-${count > 4 ? 3 : count} gap-6 items-stretch h-full lg:h-auto overflow-y-auto`;

            const groupNames = ["Alpha Team", "Beta Team", "Gamma Team", "Delta Team", "Epsilon Team", "Zeta Team"];

            for (let i = 1; i <= count; i++) {
                const groupDiv = document.createElement('div');
                groupDiv.className = 'bg-white border border-gray-200 rounded-xl shadow-xs flex flex-col min-h-[350px] overflow-hidden';
                
                const groupName = groupNames[i - 1] || `Group ${i}`;
                const groupId = `group-${i}`;

                groupDiv.innerHTML = `
                    <div class="px-5 py-4 border-b border-gray-150 flex items-center justify-between shrink-0 bg-gray-50/50">
                        <span class="font-bold text-gray-900 text-[13px] uppercase tracking-wider">${groupName}</span>
                        <span class="group-count text-[11px] font-bold text-gray-500" id="${groupId}-counter">0 students</span>
                    </div>
                    <div class="group-bin p-4 space-y-3 flex-1 border-2 border-dashed border-transparent transition bg-gray-50/10" dropzone="true" id="${groupId}">
                        <!-- Dropped students here -->
                    </div>
                `;
                groupingsGrid.appendChild(groupDiv);
            }

            unassignedContainer.innerHTML = '';

            students.forEach(st => {
                const card = createDraggableCard(st);
                let binId = studentPlacements[st.id] || 'unassigned';
                
                if (binId.startsWith('group-')) {
                    const groupNum = parseInt(binId.split('-')[1]);
                    if (groupNum > count) {
                        binId = 'unassigned';
                        studentPlacements[st.id] = 'unassigned';
                    }
                }

                if (binId === 'unassigned') {
                    unassignedContainer.appendChild(card);
                } else {
                    const bin = document.getElementById(binId);
                    if (bin) {
                        bin.appendChild(card);
                    }
                }
            });

            updateCounters();
            attachDragDropEvents();
        }

        function createDraggableCard(st) {
            const card = document.createElement('div');
            card.id = `card-${st.id}`;
            card.draggable = true;
            card.className = 'bg-white border border-gray-200 rounded-lg p-3 shadow-xs hover:border-black cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3';
            
            const colorObj = colors[st.color] || colors.blue;

            card.innerHTML = `
                <span class="material-symbols-outlined text-gray-400 text-[20px] shrink-0 cursor-grab">drag_indicator</span>
                <div class="w-8 h-8 rounded-full ${colorObj.bg} ${colorObj.text} flex items-center justify-center font-bold text-[12px] shrink-0">
                    ${st.initials}
                </div>
                <div class="overflow-hidden flex-1">
                    <span class="font-semibold text-gray-900 block leading-tight text-[13px] truncate">${st.name}</span>
                    <span class="text-[10px] text-gray-400 block truncate">${st.email}</span>
                </div>
            `;
            return card;
        }

        let draggedCard = null;

        function attachDragDropEvents() {
            const cards = document.querySelectorAll('[draggable="true"]');
            const bins = document.querySelectorAll('[dropzone="true"]');

            cards.forEach(card => {
                card.addEventListener('dragstart', (e) => {
                    draggedCard = card;
                    card.style.opacity = '0.4';
                    e.dataTransfer.setData('text/plain', card.id);
                });

                card.addEventListener('dragend', () => {
                    card.style.opacity = '1';
                    draggedCard = null;
                });
            });

            bins.forEach(bin => {
                bin.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    bin.classList.add('drag-over');
                });

                bin.addEventListener('dragleave', () => {
                    bin.classList.remove('drag-over');
                });

                bin.addEventListener('drop', (e) => {
                    e.preventDefault();
                    bin.classList.remove('drag-over');
                    if (draggedCard) {
                        bin.appendChild(draggedCard);
                        const studentId = draggedCard.id.replace('card-', '');
                        studentPlacements[studentId] = bin.id;
                        updateCounters();
                    }
                });
            });
        }

        function updateCounters() {
            const unassignedCount = unassignedContainer.querySelectorAll('[draggable="true"]').length;
            document.getElementById('unassigned-count').innerText = unassignedCount;

            const count = parseInt(groupsCountInput.value) || 3;
            for (let i = 1; i <= count; i++) {
                const binId = `group-${i}`;
                const bin = document.getElementById(binId);
                if (bin) {
                    const c = bin.querySelectorAll('[draggable="true"]').length;
                    document.getElementById(`${binId}-counter`).innerText = `${c} student${c === 1 ? '' : 's'}`;
                }
            }
        }

        randomizeBtn.addEventListener('click', () => {
            const count = parseInt(groupsCountInput.value) || 3;
            const shuffledStudents = [...students].sort(() => 0.5 - Math.random());
            
            shuffledStudents.forEach((st, index) => {
                const targetGroupNum = (index % count) + 1;
                studentPlacements[st.id] = `group-${targetGroupNum}`;
            });

            renderGroupingsBoard();
        });

        resetBtn.addEventListener('click', () => {
            students.forEach(st => {
                studentPlacements[st.id] = 'unassigned';
            });
            renderGroupingsBoard();
        });

        groupsCountInput.addEventListener('change', renderGroupingsBoard);

        const groupTarget = document.getElementById('group-target');
        const groupingsMainUi = document.getElementById('groupings-main-ui');
        const groupingsPlaceholder = document.getElementById('groupings-placeholder');

        function updateGroupingsUiState() {
            const selectedVal = groupTarget.value;
            if (selectedVal === "") {
                groupingsMainUi.classList.add('hidden');
                groupingsPlaceholder.classList.remove('hidden');
            } else {
                groupingsMainUi.classList.remove('hidden');
                groupingsPlaceholder.classList.add('hidden');
                renderGroupingsBoard();
            }
        }

        groupTarget.addEventListener('change', (e) => {
            const val = e.target.value;
            if (val !== "") {
                students.forEach(st => {
                    studentPlacements[st.id] = 'unassigned';
                });
                updateGroupingsUiState();

                // Update banner header to match selected task
                if (taskMap[val]) {
                    document.getElementById('banner-breadcrumb').textContent = taskMap[val].breadcrumb;
                    document.getElementById('banner-title').textContent = taskMap[val].title;
                    document.getElementById('banner-subtitle').textContent = taskMap[val].subtitle;
                }

                alert(`Loaded group assignment configuration for: ${e.target.options[e.target.selectedIndex].text}`);
            } else {
                updateGroupingsUiState();
                // Reset banner to defaults
                document.getElementById('banner-breadcrumb').textContent = 'Capstone 1';
                document.getElementById('banner-title').textContent = '[11010] Capstone Project 1';
                document.getElementById('banner-subtitle').textContent = 'Summer Semester 2026 \u2022 Section A \u2022 Dr. Julian Vance';
            }
        });

        // ================= Workflow mode switching (Box 1 vs Box 2) =================
        const wfA = document.getElementById('wf-mode-a');
        const wfB = document.getElementById('wf-mode-b');
        const helperA = document.getElementById('wf-helper-mode-a');
        const helperB = document.getElementById('wf-helper-mode-b');

        wfA.addEventListener('click', () => {
            wfA.className = 'px-3.5 py-1 text-xs font-semibold rounded-md bg-white text-gray-900 shadow-xs transition';
            wfB.className = 'px-3.5 py-1 text-xs font-semibold rounded-md text-gray-500 hover:text-gray-900 transition';
            helperA.classList.remove('hidden');
            helperB.classList.add('hidden');
        });

        wfB.addEventListener('click', () => {
            wfB.className = 'px-3.5 py-1 text-xs font-semibold rounded-md bg-white text-gray-900 shadow-xs transition';
            wfA.className = 'px-3.5 py-1 text-xs font-semibold rounded-md text-gray-500 hover:text-gray-900 transition';
            helperB.classList.remove('hidden');
            helperA.classList.add('hidden');
        });

        // ================= ANNOUNCEMENTS TAB LOGIC =================
        let announcements = [
            {
                title: "Important Milestone 1 Specs Updated",
                course: "[11010] Capstone Project 1",
                date: "July 12, 2026 &bull; 10:14 AM",
                body: "Please make sure to review the adjusted grading rubric under milestone specifications. Contributions must align with task-ledger entries."
            },
            {
                title: "Practicum Resume Upload Deadline",
                course: "[11060] Practicum & Industry Prep",
                date: "July 08, 2026 &bull; 4:30 PM",
                body: "All graduating seniors must upload their finalized portfolios and CVs to the designated link for peer reviews."
            }
        ];

        function renderAnnouncements() {
            const container = document.getElementById('announcements-feed-container');
            container.innerHTML = '';
            document.getElementById('ann-stat-badge').innerText = `${announcements.length} Posted`;

            announcements.forEach(ann => {
                const div = document.createElement('div');
                div.className = 'p-6 hover:bg-gray-50/50 transition';
                div.innerHTML = `
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md mb-2">${ann.course}</span>
                            <h4 class="text-sm font-bold text-gray-900">${ann.title}</h4>
                            <span class="block text-[11px] text-gray-400 mt-1">${ann.date}</span>
                            <p class="text-xs text-gray-600 mt-3 leading-relaxed whitespace-pre-line">${ann.body}</p>
                        </div>
                    </div>
                `;
                container.appendChild(div);
            });
        }

        function handlePostAnnouncement() {
            const title = document.getElementById('ann-title').value.trim();
            const content = document.getElementById('ann-content').value.trim();
            const targetName = "[11010] Capstone Project 1";

            const dateStr = new Date().toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            }) + ' &bull; ' + new Date().toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });

            announcements.unshift({
                title: title,
                course: targetName,
                date: dateStr,
                body: content
            });

            document.getElementById('ann-title').value = '';
            document.getElementById('ann-content').value = '';

            renderAnnouncements();
            alert('Your announcement has been broadcast successfully!');
        }

        // ================= REQUESTS TAB LOGIC =================
        let requestsCount = 3;

        function updateRequestsBadge() {
            const badge = document.getElementById('requests-header-badge');
            const dot = document.getElementById('requests-dot');
            badge.innerText = `${requestsCount} Pending`;
            
            if (requestsCount === 0) {
                badge.innerText = "No Pending Requests";
                badge.className = "px-2.5 py-1 text-xs font-bold bg-gray-100 text-gray-500 rounded-full";
                if (dot) dot.classList.add('hidden');
            } else {
                badge.className = "px-2.5 py-1 text-xs font-bold bg-red-50 text-red-600 rounded-full";
                if (dot) dot.classList.remove('hidden');
            }
        }

        function handleRejectRequest(reqId) {
            const el = document.getElementById(reqId);
            if (el) {
                el.style.opacity = '0.5';
                setTimeout(() => {
                    el.remove();
                    requestsCount--;
                    updateRequestsBadge();
                }, 400);
            }
        }

        function handleApproveRequest(reqId, message) {
            alert(message);
            handleRejectRequest(reqId);
        }

        function handleApproveJoin(reqId, studentId, studentName, studentEmail) {
            // Enroll student dynamically
            if (!students.find(s => s.id === studentId)) {
                const initials = studentName.split(' ').map(n => n[0]).slice(0, 2).join('');
                const colorKeys = Object.keys(colors);
                const randomColor = colorKeys[Math.floor(Math.random() * colorKeys.length)];

                students.push({
                    id: studentId,
                    name: studentName,
                    email: studentEmail,
                    initials: initials,
                    color: randomColor
                });
                studentPlacements[studentId] = 'unassigned';
            }

            renderRoster();
            renderGroupingsBoard();
            alert(`Approved! ${studentName} (${studentId}) has been successfully enrolled into the class roster.`);
            handleRejectRequest(reqId);
        }

        function handleApproveTransfer(reqId, studentId, targetBinId) {
            studentPlacements[studentId] = targetBinId;
            renderGroupingsBoard();
            alert(`Exception approved! Julius Caesar has been transferred to Group Alpha.`);
            handleRejectRequest(reqId);
        }

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

        // Initialize page components
        initPlacements();
        renderRoster();
        updateGroupingsUiState();
        renderAnnouncements();
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
