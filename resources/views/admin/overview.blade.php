<!DOCTYPE html><html lang="en" class="light"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet"><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">try{
        try {
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        "colors": {
                            "surface-tint": "#4f6073",
                            "secondary": "#505f76",
                            "inverse-on-surface": "#f2f0f2",
                            "tertiary-fixed-dim": "#c1c7cf",
                            "primary-container": "#1a2b3c",
                            "on-primary-container": "#8192a7",
                            "outline": "#74777d",
                            "on-tertiary-fixed-variant": "#41474e",
                            "on-tertiary-container": "#8b9198",
                            "on-surface": "#1b1c1d",
                            "on-secondary": "#ffffff",
                            "on-secondary-fixed-variant": "#38485d",
                            "secondary-fixed-dim": "#b7c8e1",
                            "tertiary-container": "#242a30",
                            "surface-container-low": "#f5f3f4",
                            "secondary-container": "#d0e1fb",
                            "on-secondary-container": "#54647a",
                            "inverse-primary": "#b7c8de",
                            "on-primary": "#ffffff",
                            "on-background": "#1b1c1d",
                            "tertiary": "#0f161b",
                            "on-tertiary-fixed": "#161c22",
                            "on-primary-fixed": "#0b1d2d",
                            "secondary-fixed": "#d3e4fe",
                            "error": "#ba1a1a",
                            "primary-fixed-dim": "#b7c8de",
                            "primary": "#041627",
                            "outline-variant": "#c4c6cd",
                            "on-surface-variant": "#44474c",
                            "on-primary-fixed-variant": "#38485a",
                            "background": "#fbf9fa",
                            "surface-container-lowest": "#ffffff",
                            "on-error-container": "#93000a",
                            "on-secondary-fixed": "#0b1c30",
                            "on-error": "#ffffff",
                            "surface-variant": "#e4e2e3",
                            "error-container": "#ffdad6",
                            "inverse-surface": "#303032",
                            "surface-bright": "#fbf9fa",
                            "primary-fixed": "#d2e4fb",
                            "surface-dim": "#dbd9db",
                            "surface": "#fbf9fa",
                            "on-tertiary": "#ffffff",
                            "surface-container-highest": "#e4e2e3",
                            "surface-container-high": "#e9e7e9",
                            "tertiary-fixed": "#dde3eb",
                            "surface-container": "#efedef"
                        },
                        "borderRadius": {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "0.75rem",
                            "full": "9999px"
                        },
                        "spacing": {
                            "xl": "32px",
                            "gutter": "20px",
                            "sm": "8px",
                            "md": "16px",
                            "lg": "24px",
                            "max-width": "1440px",
                            "margin": "24px",
                            "base": "4px",
                            "xs": "4px"
                        },
                        "fontFamily": {
                            "headline-lg": ["Inter"],
                            "body-md": ["Inter"],
                            "headline-lg-mobile": ["Inter"],
                            "body-sm": ["Inter"],
                            "display-lg": ["Inter"],
                            "title-md": ["Inter"],
                            "label-caps": ["Inter"]
                        },
                        "fontSize": {
                            "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                            "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                            "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                            "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                            "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                            "title-md": ["18px", {"lineHeight": "24px", "fontWeight": "600"}],
                            "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}]
                        }
                    },
                },
            }
        } catch (_e) {}
    }catch(_e){}</script><meta charset="utf-8"></head><body class="bg-background text-on-background min-h-screen">
    <!-- SideNavBar -->
    <nav class="w-[260px] h-screen fixed left-0 top-0 flex flex-col py-lg bg-surface border-r border-outline-variant z-50">
        <div class="px-lg mb-xl"><h1 class="font-headline-lg text-headline-lg font-bold text-primary">CarryOn</h1>
<p class="font-label-caps text-label-caps text-secondary tracking-widest uppercase">Admin Portal</p></div>
        <div class="flex-1 px-md space-y-1"><a class="flex items-center gap-md px-md py-sm font-bold text-primary border-r-2 border-primary bg-surface-container-low transition-colors duration-150" href="#">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-caps text-label-caps">Overview</span>
</a>
<a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/users">
<span class="material-symbols-outlined">group</span>
<span class="font-label-caps text-label-caps">Users</span>
</a>
<a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/classes">
<span class="material-symbols-outlined">school</span>
<span class="font-label-caps text-label-caps">Classes</span>
</a>
<a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/reports">
<span class="material-symbols-outlined">assessment</span>
<span class="font-label-caps text-label-caps">Reports</span>
</a></div>
        
        <div class="mt-auto px-md space-y-base border-t border-outline-variant pt-lg"><a class="flex items-center gap-md px-md py-sm text-secondary hover:text-primary transition-colors" href="#">
<span class="material-symbols-outlined">help</span>
<span class="font-label-caps text-label-caps">Help</span>
</a>
<a class="flex items-center gap-md px-md py-sm text-secondary hover:text-primary transition-colors" href="/login">
<span class="material-symbols-outlined">logout</span>
<span class="font-label-caps text-label-caps">Logout</span>
</a></div>
    </nav>

    <!-- Main Canvas -->
    <main class="ml-[260px] min-h-screen flex flex-col">
        <!-- Content Body -->
        <div class="p-lg max-w-max-width mx-auto w-full space-y-lg pt-md">
            <!-- Dashboard Header -->
            <div class="flex flex-col gap-xs">
                <h2 class="font-headline-lg text-headline-lg text-primary">Platform Overview</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Centralized administrative monitoring and system status.</p>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-lg items-start">
                
                <!-- 1. Classes by Enrollment Section -->
                <section class="xl:col-span-2 space-y-md">
                    <div class="flex items-center justify-between">
                        <h3 class="font-title-md text-title-md text-primary">Classes by Enrollment</h3>
                        <button class="text-body-sm text-secondary hover:text-primary font-bold">Manage All Classes</button>
                    </div>
                    <div class="bg-surface-container-lowest border border-outline-variant rounded-lg overflow-hidden shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-outline-variant">
                                    <th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase">Class Name</th>
                                    <th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase">Instructor</th>
                                    <th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase">Enrollment Count</th>
                                    <th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                <tr class="hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-md">
                                            <div class="w-8 h-8 rounded bg-primary-container flex items-center justify-center">
                                                <span class="material-symbols-outlined text-white text-sm">code</span>
                                            </div>
                                            <div>
                                                <div class="font-body-md font-bold text-primary">Advanced Algorithms 401</div>
                                                <div class="text-[10px] text-secondary">CS_DEPT_A1</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md text-body-sm text-on-surface-variant">Dr. Aris Thorne</td>
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-sm">
                                            <div class="flex-1 min-w-[80px] h-2 bg-outline-variant rounded-full overflow-hidden">
                                                <div class="h-full bg-primary w-[85%]"></div>
                                            </div>
                                            <span class="text-body-sm font-bold min-w-[60px] text-right">128/150</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md text-right">
                                        <span class="px-2 py-1 bg-secondary-container text-on-secondary-container text-[10px] font-bold rounded-full uppercase">In Progress</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-md">
                                            <div class="w-8 h-8 rounded bg-primary-container flex items-center justify-center">
                                                <span class="material-symbols-outlined text-white text-sm">history_edu</span>
                                            </div>
                                            <div>
                                                <div class="font-body-md font-bold text-primary">Quantum History 102</div>
                                                <div class="text-[10px] text-secondary">PHYS_DEPT_Q2</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md text-body-sm text-on-surface-variant">Prof. Elena Vance</td>
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-sm">
                                            <div class="flex-1 min-w-[80px] h-2 bg-outline-variant rounded-full overflow-hidden">
                                                <div class="h-full bg-primary w-[96%]"></div>
                                            </div>
                                            <span class="text-body-sm font-bold min-w-[60px] text-right">48/50</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md text-right">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-[10px] font-bold rounded-full uppercase">Published</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-md">
                                            <div class="w-8 h-8 rounded bg-primary-container flex items-center justify-center">
                                                <span class="material-symbols-outlined text-white text-sm">biotech</span>
                                            </div>
                                            <div>
                                                <div class="font-body-md font-bold text-primary">Molecular Ethics</div>
                                                <div class="text-[10px] text-secondary">BIO_DEPT_E1</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md text-body-sm text-on-surface-variant">Sarah Jenkins</td>
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-sm">
                                            <div class="flex-1 min-w-[80px] h-2 bg-outline-variant rounded-full overflow-hidden">
                                                <div class="h-full bg-primary w-[41%]"></div>
                                            </div>
                                            <span class="text-body-sm font-bold min-w-[60px] text-right">82/200</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md text-right">
                                        <span class="px-2 py-1 bg-amber-100 text-amber-800 text-[10px] font-bold rounded-full uppercase">Review</span>
                                    </td>
                                </tr>
                                <tr class="hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-md">
                                            <div class="w-8 h-8 rounded bg-primary-container flex items-center justify-center">
                                                <span class="material-symbols-outlined text-white text-sm">psychology</span>
                                            </div>
                                            <div>
                                                <div class="font-body-md font-bold text-primary">Cognitive Frameworks</div>
                                                <div class="text-[10px] text-secondary">PSY_DEPT_C3</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md text-body-sm text-on-surface-variant">Dr. Liam Chen</td>
                                    <td class="px-lg py-md">
                                        <div class="flex items-center gap-sm">
                                            <div class="flex-1 min-w-[80px] h-2 bg-outline-variant rounded-full overflow-hidden">
                                                <div class="h-full bg-primary w-[75%]"></div>
                                            </div>
                                            <span class="text-body-sm font-bold min-w-[60px] text-right">75/100</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-md text-right">
                                        <span class="px-2 py-1 bg-secondary-container text-on-secondary-container text-[10px] font-bold rounded-full uppercase">In Progress</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Sidebar Modules-->
                <div class="space-y-lg">
                    <!-- 2. User Breakdown Section -->
                    <section class="space-y-md">
                        <h3 class="font-title-md text-title-md text-primary">User Breakdown</h3>
                        <div class="bg-surface-container-lowest border border-outline-variant p-lg rounded-lg shadow-sm">
                            <div class="space-y-md">
                                <!-- Student Distribution -->
                                <div class="space-y-xs">
                                    <div class="flex justify-between items-end">
                                        <span class="text-body-sm font-bold text-primary">Students</span>
                                        <span class="text-title-md font-bold text-primary">12,450</span>
                                    </div>
                                    <div class="h-3 bg-surface-container-low rounded-full overflow-hidden">
                                        <div class="h-full bg-primary w-[82%]"></div>
                                    </div>
                                    <p class="text-[10px] text-secondary">82% of total population</p>
                                </div>
                                <!-- Instructor Distribution -->
                                <div class="space-y-xs">
                                    <div class="flex justify-between items-end">
                                        <span class="text-body-sm font-bold text-primary">Instructors</span>
                                        <span class="text-title-md font-bold text-primary">840</span>
                                    </div>
                                    <div class="h-3 bg-surface-container-low rounded-full overflow-hidden">
                                        <div class="h-full bg-secondary w-[12%]"></div>
                                    </div>
                                    <p class="text-[10px] text-secondary">12% of total population</p>
                                </div>
                                <!-- Admin Distribution -->
                                <div class="space-y-xs">
                                    <div class="flex justify-between items-end">
                                        <span class="text-body-sm font-bold text-primary">Admins</span>
                                        <span class="text-title-md font-bold text-primary">42</span>
                                    </div>
                                    <div class="h-3 bg-surface-container-low rounded-full overflow-hidden">
                                        <div class="h-full bg-outline w-[6%]"></div>
                                    </div>
                                    <p class="text-[10px] text-secondary">6% of total population</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 3. Recent Platform Activity Section -->
                    <section class="space-y-md">
                        <h3 class="font-title-md text-title-md text-primary">Recent Platform Activity</h3>
                        <div class="bg-surface-container-lowest border border-outline-variant p-md rounded-lg shadow-sm space-y-md">
                            <!-- Activity Item 1 -->
                            <div class="flex gap-md border-b border-outline-variant pb-md last:border-0 last:pb-0">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary text-[18px]">add_circle</span>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-body-sm text-primary font-bold">New Course Created</p>
                                    <p class="text-[12px] text-on-surface-variant">"Computational Ethics 505" added to Philosophy Dept.</p>
                                    <span class="text-[10px] text-secondary uppercase font-bold tracking-wider">2 mins ago</span>
                                </div>
                            </div>
                            <!-- Activity Item 2 -->
                            <div class="flex gap-md border-b border-outline-variant pb-md last:border-0 last:pb-0">
                                <div class="w-8 h-8 rounded-full bg-secondary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-secondary text-[18px]">manage_accounts</span>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-body-sm text-primary font-bold">User Role Updated</p>
                                    <p class="text-[12px] text-on-surface-variant">Sarah Jenkins elevated to Department Head.</p>
                                    <span class="text-[10px] text-secondary uppercase font-bold tracking-wider">45 mins ago</span>
                                </div>
                            </div>
                            <!-- Activity Item 3 -->
                            <div class="flex gap-md border-b border-outline-variant pb-md last:border-0 last:pb-0">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-green-700 text-[18px]">cloud_done</span>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-body-sm text-primary font-bold">System Backup Completed</p>
                                    <p class="text-[12px] text-on-surface-variant">Weekly system state successfully archived.</p>
                                    <span class="text-[10px] text-secondary uppercase font-bold tracking-wider">2 hours ago</span>
                                </div>
                            </div>
                            <!-- Activity Item 4 -->
                            <div class="flex gap-md border-b border-outline-variant pb-md last:border-0 last:pb-0">
                                </div></div></section></div></div></div></main>

</body></html>