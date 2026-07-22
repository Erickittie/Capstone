<!DOCTYPE html><html lang="en" class="light" style=""><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet"><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">try{
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-bright": "#fbf9fa",
                    "secondary-fixed": "#d3e4fe",
                    "on-primary-container": "#8192a7",
                    "on-background": "#1b1c1d",
                    "on-error-container": "#93000a",
                    "on-error": "#ffffff",
                    "surface-container": "#efedef",
                    "secondary": "#505f76",
                    "surface": "#fbf9fa",
                    "surface-variant": "#e4e2e3",
                    "secondary-container": "#d0e1fb",
                    "on-tertiary-container": "#8b9198",
                    "on-secondary-fixed-variant": "#38485d",
                    "primary-fixed-dim": "#b7c8de",
                    "on-tertiary-fixed-variant": "#41474e",
                    "on-tertiary-fixed": "#161c22",
                    "surface-container-high": "#e9e7e9",
                    "error": "#ba1a1a",
                    "outline": "#74777d",
                    "secondary-fixed-dim": "#b7c8e1",
                    "outline-variant": "#c4c6cd",
                    "on-secondary-container": "#54647a",
                    "surface-tint": "#4f6073",
                    "tertiary-fixed": "#dde3eb",
                    "on-surface-variant": "#44474c",
                    "tertiary-fixed-dim": "#c1c7cf",
                    "primary": "#041627",
                    "on-primary-fixed-variant": "#38485a",
                    "on-tertiary": "#ffffff",
                    "on-primary-fixed": "#0b1d2d",
                    "on-surface": "#1b1c1d",
                    "surface-dim": "#dbd9db",
                    "surface-container-low": "#f5f3f4",
                    "tertiary-container": "#242a30",
                    "on-secondary": "#ffffff",
                    "background": "#fbf9fa",
                    "surface-container-lowest": "#ffffff",
                    "inverse-primary": "#b7c8de",
                    "inverse-surface": "#303032",
                    "primary-container": "#1a2b3c",
                    "on-primary": "#ffffff",
                    "surface-container-highest": "#e4e2e3",
                    "on-secondary-fixed": "#0b1c30",
                    "inverse-on-surface": "#f2f0f2",
                    "tertiary": "#0f161b",
                    "primary-fixed": "#d2e4fb",
                    "error-container": "#ffdad6"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "max-width": "1440px",
                    "gutter": "20px",
                    "sm": "8px",
                    "md": "16px",
                    "xl": "32px",
                    "xs": "4px",
                    "margin": "24px",
                    "lg": "24px",
                    "base": "4px"
            },
            "fontFamily": {
                    "headline-lg": ["Inter", "sans-serif"],
                    "body-md": ["Inter", "sans-serif"],
                    "display-lg": ["Inter", "sans-serif"],
                    "body-sm": ["Inter", "sans-serif"],
                    "title-md": ["Inter", "sans-serif"],
                    "label-caps": ["Inter", "sans-serif"]
            },
            "fontSize": {
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "title-md": ["18px", {"lineHeight": "24px", "fontWeight": "600"}],
                    "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}]
            }
          },
        },
      }
    }catch(_e){}</script><meta charset="utf-8"></head><body class="flex min-h-screen">
<!-- SideNavBar Anchor -->
<nav class="w-[260px] h-screen fixed left-0 top-0 flex flex-col py-lg bg-surface border-r border-outline-variant z-50">
        <div class="px-lg mb-xl"><h1 class="font-headline-lg text-headline-lg font-bold text-primary">CarryOn</h1>
<p class="font-label-caps text-label-caps text-secondary tracking-widest uppercase">Admin Portal</p></div>
        <div class="flex-1 px-md space-y-1"><a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/overview">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-caps text-label-caps">Overview</span>
</a>
<a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="/users">
<span class="material-symbols-outlined">group</span>
<span class="font-label-caps text-label-caps">Users</span>
</a>
<a class="flex items-center gap-md px-md py-sm font-bold text-primary border-r-2 border-primary bg-surface-container-low transition-colors duration-150" href="#">
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
<!-- Main Content Canvas -->
<main class="flex-1 ml-[260px] bg-surface-bright min-h-screen">
<div class="max-w-[1200px] mx-auto px-lg py-xl">
<!-- Header Section -->
<header class="mb-lg">
<h2 class="font-headline-lg text-headline-lg text-primary mb-xs">Classes</h2>
<p class="text-on-surface-variant font-body-md text-body-md">Manage active curriculum, monitor enrollment, and update instructor assignments.</p>
</header>
<!-- Search & Filter Bar -->
<div class="mb-xl"><div class="flex flex-col md:flex-row items-center gap-lg"><div class="relative w-full max-w-2xl group"><div class="absolute inset-y-0 left-0 pl-md flex items-center pointer-events-none"><span class="material-symbols-outlined text-outline">search</span></div><input class="block w-full pl-[48px] pr-md py-md bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md text-body-md outline-none" placeholder="Search by class name or instructor" type="text"></div><div class="flex items-center bg-surface-container-low p-xs rounded-lg border border-outline-variant"><button class="px-lg py-sm rounded-md bg-surface-container-lowest text-primary font-bold shadow-sm transition-all font-body-sm text-body-sm">All</button><button class="px-lg py-sm rounded-md text-on-surface-variant hover:bg-surface-container-high transition-all font-body-sm text-body-sm">Has Alerts</button></div></div></div>
<!-- Table Container -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden shadow-sm">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant">
<th class="px-lg py-md font-label-caps text-label-caps text-on-surface-variant uppercase tracking-wider">ALL CLASSES</th>





</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<!-- Row 1 -->
<tr class="hover:bg-surface-container transition-colors duration-150">
<td class="px-lg py-md">
<span class="font-title-md text-title-md text-primary">Advanced Data Analysis</span>
</td>




<td class="px-lg py-md text-right">
<button class="p-sm rounded-full hover:bg-surface-container-high text-on-surface-variant hover:text-primary transition-all">
<a href = "/ClassDetails"><span class="material-symbols-outlined">visibility</span></a>
</button>
</td>
</tr>
<!-- Row 2 -->
<tr class="hover:bg-surface-container transition-colors duration-150">
<td class="px-lg py-md">
<span class="font-title-md text-title-md text-primary">Human Computer Interaction</span>
</td>




<td class="px-lg py-md text-right">
<button class="p-sm rounded-full hover:bg-surface-container-high text-on-surface-variant hover:text-primary transition-all">
<span class="material-symbols-outlined">visibility</span>
</button>
</td>
</tr>
<!-- Row 3 -->
<tr class="hover:bg-surface-container transition-colors duration-150">
<td class="px-lg py-md">
<span class="font-title-md text-title-md text-primary">Global Economics &amp; Policy</span>
</td>




<td class="px-lg py-md text-right">
<button class="p-sm rounded-full hover:bg-surface-container-high text-on-surface-variant hover:text-primary transition-all">
<span class="material-symbols-outlined">visibility</span>
</button>
</td>
</tr>
<!-- Row 4 -->
<tr class="hover:bg-surface-container transition-colors duration-150">
<td class="px-lg py-md">
<span class="font-title-md text-title-md text-primary">Biotechnology Seminar</span>
</td>




<td class="px-lg py-md text-right">
<button class="p-sm rounded-full hover:bg-surface-container-high text-on-surface-variant hover:text-primary transition-all">
<span class="material-symbols-outlined">visibility</span>
</button>
</td>
</tr>
<!-- Row 5 -->
<tr class="hover:bg-surface-container transition-colors duration-150">
<td class="px-lg py-md">
<span class="font-title-md text-title-md text-primary">Introduction to Ethics</span>
</td>




<td class="px-lg py-md text-right">
<button class="p-sm rounded-full hover:bg-surface-container-high text-on-surface-variant hover:text-primary transition-all">
<span class="material-symbols-outlined">visibility</span>
</button>
</td>
</tr>
</tbody>
</table>
<!-- Pagination / Footer -->
<div class="px-lg py-md bg-surface-container-low border-t border-outline-variant flex items-center justify-between">
<p class="font-body-sm text-body-sm text-on-surface-variant">Showing 1 to 5 of 124 classes</p>
<div class="flex items-center gap-sm">
<button class="p-xs rounded border border-outline-variant hover:bg-surface-container text-on-surface-variant disabled:opacity-50" disabled="">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<span class="font-label-caps text-label-caps px-sm">Page 1 of 25</span>
<button class="p-xs rounded border border-outline-variant hover:bg-surface-container text-on-surface-variant">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>
</div>
<!-- Stats Overview (Bento Grid Style) -->

</div>
</main>
<!-- Custom Script for Micro-interactions -->
<script class="">
        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.addEventListener('click', (e) => {
                    // Prevent row click if clicking the edit button specifically
                    if (!e.target.closest('button')) {
                        console.log('Row clicked, navigate to class details...');
                    }
                });
            });

            const searchInput = document.querySelector('input[type="text"]');
            searchInput.addEventListener('focus', () => {
                searchInput.parentElement.classList.add('scale-[1.01]');
                searchInput.parentElement.classList.add('shadow-md');
            });
            searchInput.addEventListener('blur', () => {
                searchInput.parentElement.classList.remove('scale-[1.01]');
                searchInput.parentElement.classList.remove('shadow-md');</script></body></html>