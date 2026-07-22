<!DOCTYPE html><html class="light" lang="en" style=""><head><meta charset="utf-8"><meta content="width=device-width, initial-scale=1.0" name="viewport"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet"><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">try{
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
                    "body-sm": ["Inter"],
                    "display-lg": ["Inter"],
                    "title-md": ["Inter"],
                    "label-caps": ["Inter"]
            },
            "fontSize": {
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "title-md": ["18px", {"lineHeight": "24px", "fontWeight": "600"}],
                    "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}]
            }
          },
        },
      }
    }catch(_e){}</script></head><body class="text-on-background bg-background">
<!-- Sidebar-->
<aside class="w-[260px] h-screen fixed left-0 top-0 bg-surface border-r border-outline-variant flex flex-col py-lg z-50">
<div class="px-lg mb-xl">
<h1 class="font-headline-lg text-headline-lg font-bold text-primary">CarryOn</h1>
<p class="font-label-caps text-label-caps text-secondary tracking-widest uppercase">Admin Portal</p>
</div>
<nav class="flex-1 px-md space-y-base overflow-y-auto custom-scrollbar"><a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/overview">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-caps text-label-caps">Overview</span>
</a>
<a class="flex items-center gap-md px-md py-sm font-bold text-primary border-r-2 border-primary bg-surface-container-low transition-colors duration-150" href="#">
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
</a></nav>
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
</aside>
<!-- Top App Bar -->
<!-- Main Content Canvas -->
<main class="ml-[260px] px-lg text-on-background pt-lg">
<!-- Header & Top Actions -->
<div class="mb-md">
<div class="flex justify-between items-end mb-lg">
<div>
<h2 class="font-headline-lg text-headline-lg text-primary">User Management</h2>
<p class="text-on-surface-variant font-body-md mt-1">Orchestrate academic roles and institutional access control.</p>
</div>
<div class="flex gap-md">
<button class="px-lg py-sm bg-primary text-on-primary font-title-md rounded-lg flex items-center gap-sm hover:opacity-90 transition-all active:scale-95 shadow-md">
<span class="material-symbols-outlined" data-icon="person_add">person_add</span>
                        Create Instructor
                    </button>
</div>
</div>
<!-- Summary Bento Grid -->
</div>
<!-- User Management Table Container -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
<!-- Table Header / Filters -->
<div class="p-md border-b border-outline-variant flex flex-wrap items-center justify-between gap-md bg-surface">
<div class="flex items-center gap-md"><div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
<input type="text" placeholder="Search by name or email" class="pl-10 pr-4 py-2 bg-white border border-outline-variant rounded-lg text-body-sm focus:ring-1 focus:ring-primary w-64">
</div>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm" data-icon="filter_list">filter_list</span>
<select class="pl-10 pr-8 py-2 bg-white border border-outline-variant rounded-lg text-body-sm focus:ring-1 focus:ring-primary appearance-none">
<option>All Roles</option>
<option>Instructor</option>
<option>Student</option>
<option>Admin</option>
</select>
</div>

</div>
<div class="text-body-sm text-secondary font-medium">
                    Showing 1-10 of 2,842 users
                </div>
</div>
<!-- Table Data -->
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant">
<th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase tracking-wider">Name</th>
<th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase tracking-wider">Email Address</th>
<th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase tracking-wider">Role</th>
<th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase tracking-wider">Status</th>
<th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase tracking-wider">Classes Enrolled</th>
<th class="px-lg py-md font-label-caps text-label-caps text-secondary uppercase tracking-wider text-right">Actions</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<!-- User Row 1 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-md">
<div class="w-8 h-8 rounded bg-primary-fixed text-on-primary-fixed flex items-center justify-center font-bold text-xs">EK</div>
<span class="font-title-md text-title-md text-primary">Elena Kostic</span>
</div>
</td>
<td class="px-lg py-md font-body-sm text-secondary">e.kostic@university.edu</td>
<td class="px-lg py-md">
<span class="bg-secondary-container/30 text-on-secondary-container px-3 py-1 rounded-full text-xs font-semibold">Instructor</span>
</td>
<td class="px-lg py-md">
<div class="flex items-center gap-2">
<div class="w-2 h-2 rounded-full bg-emerald-500"></div>
<span class="font-body-sm text-on-surface">Active</span>
</div>
</td>
<td class="px-lg py-md font-body-sm text-secondary">6 Courses</td>
<td class="px-lg py-md text-right">
<div class="flex justify-end gap-1 transition-opacity"><button class="p-2 text-outline hover:text-primary transition-colors" title="Edit User"><span class="material-symbols-outlined">edit</span></button></div>
</td>
</tr>
<!-- User Row 2 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-md">
<div class="w-8 h-8 rounded bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center font-bold text-xs">JM</div>
<span class="font-title-md text-title-md text-primary">Julian Martinez</span>
</div>
</td>
<td class="px-lg py-md font-body-sm text-secondary">j.martinez@university.edu</td>
<td class="px-lg py-md">
<span class="bg-surface-container-highest text-on-surface-variant px-3 py-1 rounded-full text-xs font-semibold">Student</span>
</td>
<td class="px-lg py-md">
<div class="flex items-center gap-2">
<div class="w-2 h-2 rounded-full bg-emerald-500"></div>
<span class="font-body-sm text-on-surface">Active</span>
</div>
</td>
<td class="px-lg py-md font-body-sm text-secondary">4 Classes</td>
<td class="px-lg py-md text-right">
<div class="flex justify-end gap-1 transition-opacity"><button class="p-2 text-outline hover:text-primary transition-colors" title="Edit User"><a href = "/StudentDetails"><span class="material-symbols-outlined">edit</span></a></button></div>
</td>
</tr>
<!-- User Row 3 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-md">
<div class="w-8 h-8 rounded bg-surface-variant text-on-surface-variant flex items-center justify-center font-bold text-xs">SD</div>
<span class="font-title-md text-title-md text-primary">Sarah Dubois</span>
</div>
</td>
<td class="px-lg py-md font-body-sm text-secondary">s.dubois@university.edu</td>
<td class="px-lg py-md">
<span class="bg-secondary-container/30 text-on-secondary-container px-3 py-1 rounded-full text-xs font-semibold">Instructor</span>
</td>
<td class="px-lg py-md">
<div class="flex items-center gap-2">
<div class="w-2 h-2 rounded-full bg-amber-500"></div>
<span class="font-body-sm text-on-surface">Pending</span>
</div>
</td>
<td class="px-lg py-md font-body-sm text-secondary">5 Courses</td>
<td class="px-lg py-md text-right">
<div class="flex justify-end gap-1 transition-opacity"><button class="p-2 text-outline hover:text-primary transition-colors" title="Edit User"><a href = "/TeacherDetails"><span class="material-symbols-outlined">edit</span></a></button></div>
</td>
</tr>
<!-- User Row 4 -->
<tr class="hover:bg-surface-container-lowest transition-colors group">
<td class="px-lg py-md">
<div class="flex items-center gap-md">
<div class="w-8 h-8 rounded bg-primary-container text-white flex items-center justify-center font-bold text-xs">AT</div>
<span class="font-title-md text-title-md text-primary">Aris Thorne</span>
</div>
</td>
<td class="px-lg py-md font-body-sm text-secondary">a.thorne@university.edu</td>
<td class="px-lg py-md">
<span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-semibold">Admin</span>
</td>
<td class="px-lg py-md">
<div class="flex items-center gap-2">
<div class="w-2 h-2 rounded-full bg-emerald-500"></div>
<span class="font-body-sm text-on-surface">Active</span>
</div>
</td>
<td class="px-lg py-md font-body-sm text-secondary">All Access</td>
<td class="px-lg py-md text-right">
<div class="flex justify-end gap-1 transition-opacity"><button class="p-2 text-outline hover:text-primary transition-colors" title="Edit User"><span class="material-symbols-outlined">edit</span></button></div>
</td>
</tr>
</tbody>
</table>
</div>
<!-- Pagination Footer -->
<div class="p-md border-t border-outline-variant bg-surface flex items-center justify-between">
<button class="px-md py-1 border border-outline-variant rounded text-xs font-bold text-secondary hover:bg-surface-container-low disabled:opacity-50" disabled="">Previous</button>
<div class="flex gap-2">
<button class="w-8 h-8 flex items-center justify-center bg-primary text-on-primary rounded font-bold text-xs">1</button>
<button class="w-8 h-8 flex items-center justify-center text-secondary hover:bg-surface-container-low rounded font-bold text-xs">2</button>
<button class="w-8 h-8 flex items-center justify-center text-secondary hover:bg-surface-container-low rounded font-bold text-xs">3</button>
<span class="w-8 h-8 flex items-center justify-center text-secondary text-xs">...</span>
<button class="w-8 h-8 flex items-center justify-center text-secondary hover:bg-surface-container-low rounded font-bold text-xs">284</button>
</div>
<button class="px-md py-1 border border-outline-variant rounded text-xs font-bold text-secondary hover:bg-surface-container-low">Next</button>
</div>
</div>
<!-- Secondary Insights (Consistent with SCREEN_20 Layout style) -->
</main>
</body></html>