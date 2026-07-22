<!DOCTYPE html><html lang="en" class="light" style=""><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet"><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">try{try{
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "inverse-primary": "#b7c8de",
                            "surface-container-lowest": "#ffffff",
                            "tertiary": "#0f161b",
                            "surface-dim": "#dbd9db",
                            "on-tertiary-fixed-variant": "#41474e",
                            "on-tertiary": "#ffffff",
                            "primary-fixed": "#d2e4fb",
                            "on-surface": "#1b1c1d",
                            "secondary": "#505f76",
                            "surface-tint": "#4f6073",
                            "surface-container-low": "#f5f3f4",
                            "inverse-on-surface": "#f2f0f2",
                            "primary": "#041627",
                            "outline": "#74777d",
                            "error-container": "#ffdad6",
                            "secondary-container": "#d0e1fb",
                            "on-secondary-fixed-variant": "#38485d",
                            "tertiary-container": "#242a30",
                            "on-tertiary-container": "#8b9198",
                            "surface": "#fbf9fa",
                            "secondary-fixed": "#d3e4fe",
                            "on-secondary-fixed": "#0b1c30",
                            "surface-container-high": "#e9e7e9",
                            "on-secondary-container": "#54647a",
                            "tertiary-fixed-dim": "#c1c7cf",
                            "tertiary-fixed": "#dde3eb",
                            "on-primary-fixed-variant": "#38485a",
                            "primary-fixed-dim": "#b7c8de",
                            "on-primary-fixed": "#0b1d2d",
                            "surface-container": "#efedef",
                            "on-tertiary-fixed": "#161c22",
                            "on-secondary": "#ffffff",
                            "on-error-container": "#93000a",
                            "surface-container-highest": "#e4e2e3",
                            "secondary-fixed-dim": "#b7c8e1",
                            "on-error": "#ffffff",
                            "error": "#ba1a1a",
                            "outline-variant": "#c4c6cd",
                            "surface-variant": "#e4e2e3",
                            "on-primary-container": "#8192a7",
                            "on-primary": "#ffffff",
                            "background": "#fbf9fa",
                            "primary-container": "#1a2b3c",
                            "on-background": "#1b1c1d",
                            "surface-bright": "#fbf9fa",
                            "inverse-surface": "#303032",
                            "on-surface-variant": "#44474c"
                        },
                        "borderRadius": {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "0.75rem",
                            "full": "9999px"
                        },
                        "spacing": {
                            "margin": "24px",
                            "xs": "4px",
                            "md": "16px",
                            "gutter": "20px",
                            "sm": "8px",
                            "xl": "32px",
                            "base": "4px",
                            "max-width": "1440px",
                            "lg": "24px"
                        },
                        "fontFamily": {
                            "display-lg": ["Inter"],
                            "body-sm": ["Inter"],
                            "body-md": ["Inter"],
                            "title-md": ["Inter"],
                            "headline-lg": ["Inter"],
                            "headline-lg-mobile": ["Inter"],
                            "label-caps": ["Inter"]
                        },
                        "fontSize": {
                            "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                            "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                            "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                            "title-md": ["18px", {"lineHeight": "24px", "fontWeight": "600"}],
                            "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                            "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                            "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}]
                        }
                    },
                },
            }
        } catch (_e) {}
    }catch(_e){}}catch(_e){}</script></head><body class="flex min-h-screen font-body-md text-on-background bg-background">

    <!-- SideNavBar -->
    <nav class="w-[260px] h-screen fixed left-0 top-0 flex flex-col py-lg bg-surface border-r border-outline-variant z-50">
        <div class="px-lg mb-xl">
            <h1 class="font-headline-lg text-headline-lg font-bold text-primary">CarryOn</h1>
            <p class="font-label-caps text-label-caps text-secondary tracking-widest uppercase">Admin Portal</p>
        </div>
        <div class="flex-1 px-md space-y-1">
            <a class="flex items-center gap-md px-md py-sm transition-colors duration-150 text-secondary hover:bg-surface-container-low hover:text-primary" href="/overview">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="font-label-caps text-label-caps">Overview</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm transition-colors duration-150 font-bold text-primary border-r-2 border-primary bg-surface-container-low" href="/users">
                <span class="material-symbols-outlined">group</span>
                <span class="font-label-caps text-label-caps">Users</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="#">
                <span class="material-symbols-outlined">school</span>
                <span class="font-label-caps text-label-caps">Classes</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="#">
                <span class="material-symbols-outlined">assessment</span>
                <span class="font-label-caps text-label-caps">Reports</span>
            </a>
        </div>
        <div class="mt-auto px-md space-y-base border-t border-outline-variant pt-lg">
            <a class="flex items-center gap-md px-md py-sm text-secondary hover:text-primary transition-colors" href="#">
                <span class="material-symbols-outlined">help</span>
                <span class="font-label-caps text-label-caps">Help</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm text-secondary hover:text-primary transition-colors" href="/login">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-label-caps text-label-caps">Logout</span>
            </a>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="ml-[260px] flex-1 min-h-screen flex flex-col">
        <div class="p-lg max-w-max-width mx-auto w-full pt-xl">
            
            <!-- Breadcrumb/Back Link -->
            <div class="mb-lg">
                <button class="flex items-center gap-xs text-on-surface-variant hover:text-primary transition-colors font-label-caps text-label-caps group">
                    <span class="material-symbols-outlined text-[20px] transition-transform group-hover:-translate-x-1">chevron_left</span>
                    <a href = "/users"><span class="">Back to Users</span></a>
                </button>
            </div>

            <!-- Profile Header Card -->
            <div class="card p-xl mb-lg shadow-sm border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-lg">
                <div class="flex items-center gap-lg">
                    <div class="w-24 h-24 rounded-2xl overflow-hidden bg-primary-container flex items-center justify-center text-on-primary-container font-headline-lg text-headline-lg shadow-inner">
                        SH
                    </div>
                    <div>
                        <h2 class="font-display-lg text-headline-lg md:text-display-lg text-primary leading-tight">Sarah Dubois</h2>
                        <p class="font-body-md text-on-surface-variant flex items-center gap-sm mt-1">
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                            s.dubois@university.edu
                        </p>
                    </div>
                </div>
            </div>

            <!-- Two-Column Grid Content -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
                
                <!-- Left Column: Account Details & Actions -->
                <div class="lg:col-span-7 space-y-lg">
                    
                    <!-- Account Details 2x2 Grid -->
                    <div class="card p-lg">
                        <h3 class="font-title-md text-title-md text-primary flex items-center gap-md mb-lg">
                            <span class="material-symbols-outlined text-primary">badge</span> 
                            Account Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-md"><div class="p-md bg-surface-container-lowest border border-outline-variant/40 rounded-xl"><label class="font-label-caps text-label-caps text-on-surface-variant block mb-1">Department</label><p class="font-title-md text-primary">Computer Science &amp; IT</p></div><div class="p-md bg-surface-container-lowest border border-outline-variant/40 rounded-xl"><label class="font-label-caps text-label-caps text-on-surface-variant block mb-1">Provisioned by</label><p class="font-title-md text-primary">System Admin</p></div><div class="p-md bg-surface-container-lowest border border-outline-variant/40 rounded-xl"><label class="font-label-caps text-label-caps text-on-surface-variant block mb-1">Last Login</label><p class="font-title-md text-primary">Today, 8:30 AM</p></div><div class="p-md bg-surface-container-lowest border border-outline-variant/40 rounded-xl"><label class="font-label-caps text-label-caps text-on-surface-variant block mb-1">Status</label><div class="flex items-center gap-xs"><span class="w-2 h-2 rounded-full bg-green-500"></span><p class="font-title-md text-primary">Active</p></div></div></div>
                    </div>

                    <!-- Management Actions -->
                    <div class="card p-lg">
                        <h3 class="font-title-md text-title-md text-primary flex items-center gap-md mb-lg">
                            <span class="material-symbols-outlined">settings</span> 
                            Account Management
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-md mb-xl">
                            <button class="flex flex-col items-center justify-center p-md border border-outline-variant rounded-xl hover:bg-surface-container-low transition-all text-center group">
                                <span class="material-symbols-outlined text-secondary group-hover:text-primary mb-2">lock_reset</span>
                                <span class="font-label-caps text-label-caps text-primary">Reset Password</span>
                            </button>
                            <button class="flex flex-col items-center justify-center p-md border border-outline-variant rounded-xl hover:bg-surface-container-low transition-all text-center group">
                                <span class="material-symbols-outlined text-secondary group-hover:text-primary mb-2">edit</span>
                                <span class="font-label-caps text-label-caps text-primary">Edit Profile</span>
                            </button>
                            <button class="flex flex-col items-center justify-center p-md border border-outline-variant rounded-xl hover:bg-surface-container-low transition-all text-center group">
                                <span class="material-symbols-outlined text-secondary group-hover:text-primary mb-2">history</span>
                                <span class="font-label-caps text-label-caps text-primary">Activity Log</span>
                            </button>
                        </div>

                        <!-- Destructive & Admin Actions -->
                        <div class="pt-lg border-t border-outline-variant space-y-md">
                            <button class="w-full flex items-center justify-center gap-md p-md border border-primary/20 bg-primary/5 text-primary rounded-xl hover:bg-primary/10 transition-all font-label-caps text-label-caps">
                                <span class="material-symbols-outlined text-[20px]">move_item</span>
                                Transfer classes to another instructor
                            </button>
                            <div class="flex flex-col md:flex-row gap-md">
                                <button class="flex-1 flex items-center justify-center gap-md p-md border border-error/20 bg-error/5 text-error rounded-xl hover:bg-error/10 transition-all font-label-caps text-label-caps">
                                    <span class="material-symbols-outlined text-[20px]">block</span>
                                    Suspend Account
                                </button>
                                <button class="flex-1 flex items-center justify-center gap-md p-md border border-error/20 bg-error/5 text-error rounded-xl hover:bg-error/10 transition-all font-label-caps text-label-caps">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                    Remove Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Classes Assigned -->
                <div class="lg:col-span-5">
                    <div class="card p-lg h-full">
                        <div class="flex items-center justify-between mb-lg">
                            <h3 class="font-title-md text-title-md text-primary flex items-center gap-md">
                                <span class="material-symbols-outlined">school</span> 
                                Classes Assigned
                            </h3>
                            <span class="bg-primary-container text-on-primary-container px-2 py-0.5 rounded-full font-label-caps text-[10px]">3 ACTIVE</span>
                        </div>
                        <div class="space-y-md">
                            <!-- Class Card 1 -->
                            <div class="flex items-center justify-between p-md border border-outline-variant rounded-xl hover:bg-surface-container-low transition-all cursor-pointer group">
                                <div class="flex items-center gap-md">
                                    <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-colors">
                                        <span class="material-symbols-outlined">code</span>
                                    </div>
                                    <div>
                                        <p class="font-title-md text-primary leading-tight">CS101: Intro to Programming</p>
                                        <p class="font-body-sm text-on-surface-variant">Active • 42 Students</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Class Card 2 -->
                            <div class="flex items-center justify-between p-md border border-outline-variant rounded-xl hover:bg-surface-container-low transition-all cursor-pointer group">
                                <div class="flex items-center gap-md">
                                    <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-colors">
                                        <span class="material-symbols-outlined">hub</span>
                                    </div>
                                    <div>
                                        <p class="font-title-md text-primary leading-tight">CS305: Advanced Algorithms</p>
                                        <p class="font-body-sm text-on-surface-variant">Active • 38 Students</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Class Card 3 -->
                            <div class="flex items-center justify-between p-md border border-outline-variant rounded-xl hover:bg-surface-container-low transition-all cursor-pointer group">
                                <div class="flex items-center gap-md">
                                    <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-colors">
                                        <span class="material-symbols-outlined">architecture</span>
                                    </div>
                                    <div>
                                        <p class="font-title-md text-primary leading-tight">SE402: Software Engineering</p>
                                        <p class="font-body-sm text-on-surface-variant">Active • 44 Students</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Stats below for consistency with overall feel -->
                        
                        
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script class="">
        // Micro-interactions for buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('mousedown', () => button.classList.add('scale-95'));
            button.addEventListener('mouseup', () =></script></body></html>