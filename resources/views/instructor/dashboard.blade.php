<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FAF9FB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructor Dashboard - CarryOn Academic Management</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    
    <script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/group-assignment.css') }}" rel="stylesheet">
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
            <!-- Dashboard (Active) -->
            <a href="/dashboard" class="flex items-center gap-3 px-3.5 py-2.5 bg-gray-100 text-gray-900 rounded-lg text-[14px] font-semibold transition-all duration-200">
                <span class="material-symbols-outlined text-[20px] text-gray-950">grid_view</span>
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

        <!-- Main Body Layout: Split between Center Content and Right Sidebar -->
        <div class="flex-1 flex flex-col lg:flex-row min-h-0 overflow-y-auto">
            
            <!-- CENTER: Dashboard and Classes -->
            <main class="flex-1 p-6 md:p-8 space-y-6 overflow-y-auto">
                
                <!-- Category Title Row with Options Icon -->
                <div class="flex items-center justify-between border-b border-gray-200 pb-3 mb-4">
                    <h2 class="text-xl font-bold text-gray-900 tracking-tight">Instructor Dashboard</h2>
                    <button class="p-1 text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-lg transition">
                        <span class="material-symbols-outlined text-[24px]">more_vert</span>
                    </button>
                </div>

                <!-- Classes Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    
                    <!-- Course Card 1 -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <!-- Card Image / Header -->
                        <div class="relative h-[120px] bg-gradient-to-br from-[#0B8793] to-[#20BF6B] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 bg-black/5 mix-blend-overlay"></div>
                            <!-- Left: Circular icons -->
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Announcements">
                                    <span class="material-symbols-outlined text-[18px]">menu_book</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="People">
                                    <span class="material-symbols-outlined text-[18px]">group</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Assignments">
                                    <span class="material-symbols-outlined text-[18px]">edit_document</span>
                                </div>
                            </div>
                            <button class="absolute top-2 right-2 text-white/80 hover:text-white hover:bg-white/10 p-1 rounded transition">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                        
                        <!-- Card Details -->
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">[11010] Capstone 1 (9:20 - 11:10 AM)</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">[11010] Capstone 1 (9:20 - 11:10 AM)</span>
                                <span class="text-[11px] text-gray-400 mt-0.5 block">Summer 2026</span>
                            </div>
                        </div>
                        
                        <!-- Card Footer actions -->
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="relative text-gray-500 hover:text-[#007A5E] transition">
                                <span class="absolute -top-1.5 -right-1.5 w-4 h-4 bg-[#007A5E] text-white text-[9px] font-bold rounded-full flex items-center justify-center">1</span>
                                <span class="material-symbols-outlined text-[20px]">campaign</span>
                            </button>
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                    <!-- Course Card 2 -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <!-- Card Image / Header -->
                        <div class="relative h-[120px] bg-gradient-to-br from-[#0D7377] to-[#14A76C] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 bg-black/5 mix-blend-overlay"></div>
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white">
                                    <span class="material-symbols-outlined text-[18px]">menu_book</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white">
                                    <span class="material-symbols-outlined text-[18px]">group</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white">
                                    <span class="material-symbols-outlined text-[18px]">edit_document</span>
                                </div>
                            </div>
                            <button class="absolute top-2 right-2 text-white/80 hover:text-white hover:bg-white/10 p-1 rounded transition">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                        
                        <!-- Card Details -->
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">2ndSem2025 - 11060 | Practicum...</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">Prac (11060)</span>
                                <span class="text-[11px] text-gray-400 mt-0.5 block">2nd Semester 2025-2026</span>
                            </div>
                        </div>
                        
                        <!-- Card Footer actions -->
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">campaign</span>
                            </button>
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                    <!-- Course Card 3 -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <!-- Card Image / Header -->
                        <div class="relative h-[120px] bg-gradient-to-br from-[#1A365D] to-[#2B6CB0] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 flex flex-col justify-between p-3 bg-[#0f3458] text-white">
                                <div class="flex justify-between items-start w-full">
                                    <span class="material-symbols-outlined text-[24px] text-white/90">flight_takeoff</span>
                                    <button class="text-white/80 hover:text-white p-1 rounded">
                                        <span class="material-symbols-outlined text-[20px]">more_vert</span>
                                    </button>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm leading-tight text-white/90 uppercase tracking-wider">Passport to Canvas</h4>
                                    <p class="text-[9px] text-white/70">Quick Start Guide for Students</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Details -->
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">Passport to Canvas</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">Canvas 100</span>
                                <span class="text-[11px] text-transparent mt-0.5 block">Placeholder</span>
                            </div>
                        </div>
                        
                        <!-- Card Footer actions -->
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                    <!-- Capstone Milestone 1 - Proposal & Team Setup -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <div class="relative h-[120px] bg-gradient-to-br from-[#0B8793] to-[#14B8A6] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 bg-black/5 mix-blend-overlay"></div>
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Proposal">
                                    <span class="material-symbols-outlined text-[18px]">description</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Team">
                                    <span class="material-symbols-outlined text-[18px]">group</span>
                                </div>
                            </div>
                            <button class="absolute top-2 right-2 text-white/80 hover:text-white hover:bg-white/10 p-1 rounded transition">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail?task=capstone-milestone-1" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">Capstone Milestone 1 - Proposal & Team Setup</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">Capstone Projects</span>
                                <span class="text-[11px] text-gray-400 mt-0.5 block">Summer 2026</span>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                    <!-- Capstone Milestone 2 - System Architecture -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <div class="relative h-[120px] bg-gradient-to-br from-[#0D7377] to-[#38A89D] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 bg-black/5 mix-blend-overlay"></div>
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Architecture">
                                    <span class="material-symbols-outlined text-[18px]">architecture</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Design">
                                    <span class="material-symbols-outlined text-[18px]">design_services</span>
                                </div>
                            </div>
                            <button class="absolute top-2 right-2 text-white/80 hover:text-white hover:bg-white/10 p-1 rounded transition">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail?task=capstone-milestone-2" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">Capstone Milestone 2 - System Architecture</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">Capstone Projects</span>
                                <span class="text-[11px] text-gray-400 mt-0.5 block">Summer 2026</span>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                    <!-- Capstone Final Defense & Presentation -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <div class="relative h-[120px] bg-gradient-to-br from-[#1A365D] to-[#4A90D9] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 bg-black/5 mix-blend-overlay"></div>
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Defense">
                                    <span class="material-symbols-outlined text-[18px]">gavel</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Presentation">
                                    <span class="material-symbols-outlined text-[18px]">slideshow</span>
                                </div>
                            </div>
                            <button class="absolute top-2 right-2 text-white/80 hover:text-white hover:bg-white/10 p-1 rounded transition">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail?task=capstone-final" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">Capstone Final Defense & Presentation</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">Capstone Projects</span>
                                <span class="text-[11px] text-gray-400 mt-0.5 block">Summer 2026</span>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                    <!-- Activity 1 - Threat Modeling Exercise -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <div class="relative h-[120px] bg-gradient-to-br from-[#6B21A8] to-[#A855F7] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 bg-black/5 mix-blend-overlay"></div>
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Security">
                                    <span class="material-symbols-outlined text-[18px]">shield</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Modeling">
                                    <span class="material-symbols-outlined text-[18px]">schema</span>
                                </div>
                            </div>
                            <button class="absolute top-2 right-2 text-white/80 hover:text-white hover:bg-white/10 p-1 rounded transition">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail?task=activity-1" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">Activity 1 - Threat Modeling Exercise</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">Classroom Activities</span>
                                <span class="text-[11px] text-gray-400 mt-0.5 block">Summer 2026</span>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                    <!-- Activity 2 - Agile Backlog Sprint Planning -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <div class="relative h-[120px] bg-gradient-to-br from-[#B45309] to-[#F59E0B] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 bg-black/5 mix-blend-overlay"></div>
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Sprint">
                                    <span class="material-symbols-outlined text-[18px]">sprint</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Planning">
                                    <span class="material-symbols-outlined text-[18px]">view_kanban</span>
                                </div>
                            </div>
                            <button class="absolute top-2 right-2 text-white/80 hover:text-white hover:bg-white/10 p-1 rounded transition">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail?task=activity-2" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">Activity 2 - Agile Backlog Sprint Planning</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">Classroom Activities</span>
                                <span class="text-[11px] text-gray-400 mt-0.5 block">Summer 2026</span>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                    <!-- Activity 3 - Git Merge Conflict Resolution -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden flex flex-col hover:shadow-md transition">
                        <div class="relative h-[120px] bg-gradient-to-br from-[#DC2626] to-[#F87171] p-4 flex items-end shrink-0">
                            <div class="absolute inset-0 bg-black/5 mix-blend-overlay"></div>
                            <div class="flex gap-2">
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Git">
                                    <span class="material-symbols-outlined text-[18px]">merge</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-black/20 border border-white/20 flex items-center justify-center text-white" title="Resolve">
                                    <span class="material-symbols-outlined text-[18px]">build</span>
                                </div>
                            </div>
                            <button class="absolute top-2 right-2 text-white/80 hover:text-white hover:bg-white/10 p-1 rounded transition">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="/instructor/course-detail?task=activity-3" class="font-semibold text-[#007A5E] hover:underline text-sm leading-snug line-clamp-1">Activity 3 - Git Merge Conflict Resolution</a>
                                <span class="text-xs text-gray-500 font-medium mt-1 block">Classroom Activities</span>
                                <span class="text-[11px] text-gray-400 mt-0.5 block">Summer 2026</span>
                            </div>
                        </div>
                        <div class="px-4 py-3 border-t border-gray-150 flex gap-4 shrink-0 bg-gray-50/50">
                            <button class="text-gray-500 hover:text-[#007A5E] transition">
                                <span class="material-symbols-outlined text-[20px]">assignment</span>
                            </button>
                        </div>
                    </div>

                </div>
            </main>

            <!-- RIGHT: Notifications Panel -->
            <aside class="w-full lg:w-[320px] bg-white border-t lg:border-t-0 lg:border-l border-gray-200 flex flex-col shrink-0 overflow-y-auto">
                <div class="p-4 border-b border-gray-200 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-500">notifications</span>
                    <h3 class="text-[14px] font-bold text-gray-900">Notifications</h3>
                </div>
                
                <div class="divide-y divide-gray-100 flex-1">
                    <!-- Notification 1 -->
                    <div class="p-4 hover:bg-gray-50 transition relative group">
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] mt-0.5">assignment</span>
                            <div class="flex-1 min-w-0">
                                <a href="#" class="text-xs font-semibold text-[#007A5E] block hover:underline truncate">Important Checklist: Project Phase 1</a>
                                <span class="text-[11px] text-gray-400 block mt-0.5">[CS402] Advanced AI Ethics</span>
                                <span class="text-[10px] text-gray-400 block mt-0.5">Jun 27 at 2:04pm</span>
                            </div>
                            <button class="text-gray-300 hover:text-red-600 opacity-0 group-hover:opacity-100 transition" title="Dismiss">
                                <span class="material-symbols-outlined text-[16px]">close</span>
                            </button>
                        </div>
                    </div>

                    <!-- Notification 2 -->
                    <div class="p-4 hover:bg-gray-50 transition relative group">
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] mt-0.5">assignment</span>
                            <div class="flex-1 min-w-0">
                                <a href="#" class="text-xs font-semibold text-[#007A5E] block hover:underline truncate">Asyn Class: 06/29</a>
                                <span class="text-[11px] text-gray-400 block mt-0.5">[CS402] Advanced AI Ethics</span>
                                <span class="text-[10px] text-gray-400 block mt-0.5">Jun 29 at 8:56am</span>
                            </div>
                            <button class="text-gray-300 hover:text-red-600 opacity-0 group-hover:opacity-100 transition" title="Dismiss">
                                <span class="material-symbols-outlined text-[16px]">close</span>
                            </button>
                        </div>
                    </div>

                    <!-- Notification 3 -->
                    <div class="p-4 hover:bg-gray-50 transition relative group">
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] mt-0.5">assignment</span>
                            <div class="flex-1 min-w-0">
                                <a href="#" class="text-xs font-semibold text-[#007A5E] block hover:underline truncate">Individual Assignment: Data Privacy</a>
                                <span class="text-[11px] text-gray-400 block mt-0.5">[CS402] Advanced AI Ethics</span>
                                <span class="text-[10px] text-gray-400 block mt-0.5">50 points &bull; Closed</span>
                            </div>
                            <button class="text-gray-300 hover:text-red-600 opacity-0 group-hover:opacity-100 transition" title="Dismiss">
                                <span class="material-symbols-outlined text-[16px]">close</span>
                            </button>
                        </div>
                    </div>

                    <!-- Notification 4 -->
                    <div class="p-4 hover:bg-gray-50 transition relative group">
                        <div class="flex items-start gap-2.5">
                            <span class="material-symbols-outlined text-gray-400 text-[20px] mt-0.5">assignment</span>
                            <div class="flex-1 min-w-0">
                                <a href="#" class="text-xs font-semibold text-[#007A5E] block hover:underline truncate">IMPORTANT: Timeline Submission</a>
                                <span class="text-[11px] text-gray-400 block mt-0.5">[CS402] Advanced AI Ethics</span>
                                <span class="text-[10px] text-gray-400 block mt-0.5">Jul 1 at 8:00am</span>
                            </div>
                            <button class="text-gray-300 hover:text-red-600 opacity-0 group-hover:opacity-100 transition" title="Dismiss">
                                <span class="material-symbols-outlined text-[16px]">close</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <a href="#" class="block text-center py-2.5 border-t border-gray-200 font-semibold text-xs text-gray-600 hover:text-black hover:bg-gray-50 transition mt-auto">
                    Show All
                </a>
            </aside>

        </div>
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
