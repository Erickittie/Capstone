<!DOCTYPE html><html lang="en" class="light" style=""><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=block" rel="stylesheet"><script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script><script id="tailwind-config">try{
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-container-low": "#f5f3f4",
                    "inverse-primary": "#b7c8de",
                    "on-tertiary-fixed": "#161c22",
                    "inverse-surface": "#303032",
                    "tertiary-container": "#242a30",
                    "surface-variant": "#e4e2e3",
                    "background": "#fbf9fa",
                    "surface-container-high": "#e9e7e9",
                    "on-tertiary-container": "#8b9198",
                    "tertiary-fixed-dim": "#c1c7cf",
                    "secondary-container": "#d0e1fb",
                    "on-secondary-fixed": "#0b1c30",
                    "on-surface": "#1b1c1d",
                    "on-secondary-container": "#54647a",
                    "error": "#ba1a1a",
                    "tertiary": "#0f161b",
                    "on-secondary-fixed-variant": "#38485d",
                    "surface-container-lowest": "#ffffff",
                    "primary": "#041627",
                    "surface-tint": "#4f6073",
                    "secondary-fixed": "#d3e4fe",
                    "on-primary": "#ffffff",
                    "primary-container": "#1a2b3c",
                    "secondary": "#505f76",
                    "on-primary-container": "#8192a7",
                    "on-background": "#1b1c1d",
                    "tertiary-fixed": "#dde3eb",
                    "surface-dim": "#dbd9db",
                    "secondary-fixed-dim": "#b7c8e1",
                    "on-surface-variant": "#44474c",
                    "on-secondary": "#ffffff",
                    "inverse-on-surface": "#f2f0f2",
                    "on-tertiary-fixed-variant": "#41474e",
                    "surface-bright": "#fbf9fa",
                    "on-primary-fixed": "#0b1d2d",
                    "outline-variant": "#c4c6cd",
                    "on-primary-fixed-variant": "#38485a",
                    "surface-container": "#efedef",
                    "surface": "#fbf9fa",
                    "on-error": "#ffffff",
                    "on-error-container": "#93000a",
                    "primary-fixed-dim": "#b7c8de",
                    "outline": "#74777d",
                    "surface-container-highest": "#e4e2e3",
                    "primary-fixed": "#d2e4fb",
                    "on-tertiary": "#ffffff",
                    "error-container": "#ffdad6"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.8px",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "margin": "24px",
                    "sm": "8px",
                    "lg": "24px",
                    "xs": "4px",
                    "xl": "32px",
                    "md": "16px",
                    "max-width": "1440px",
                    "gutter": "20px",
                    "base": "4px"
            },
            "fontFamily": {
                    "label-caps": ["Inter"],
                    "title-md": ["Inter"],
                    "headline-lg-mobile": ["Inter"],
                    "body-sm": ["Inter"],
                    "body-md": ["Inter"],
                    "display-lg": ["Inter"],
                    "headline-lg": ["Inter"]
            },
            "fontSize": {
                    "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}],
                    "title-md": ["18px", {"lineHeight": "24px", "fontWeight": "600"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}]
            }
          },
        },
      }
    }catch(_e){}</script><meta charset="utf-8"></head><body class="bg-surface text-on-surface">
<div class="flex min-h-screen">
<!-- SideNavBar Shell -->
<nav class="w-[260px] h-screen fixed left-0 top-0 flex flex-col py-lg bg-surface border-r border-outline-variant z-50"><div class="px-lg mb-xl">
    <h1 class="font-headline-lg text-headline-lg font-bold text-primary">CarryOn</h1>
    <p class="font-label-caps text-label-caps text-secondary tracking-widest uppercase">Admin Portal</p>
</div>
<div class="flex-1 px-md space-y-1">
    <a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="#">
        <span class="material-symbols-outlined">dashboard</span>
        <span class="font-label-caps text-label-caps">Overview</span>
    </a>
    <a class="flex items-center gap-md px-md py-sm text-secondary hover:bg-surface-container-low hover:text-primary transition-colors duration-150" href="#">
        <span class="material-symbols-outlined">group</span>
        <span class="font-label-caps text-label-caps">Users</span>
    </a>
    <a class="flex items-center gap-md px-md py-sm font-bold text-primary border-r-2 border-primary bg-surface-container-low transition-colors duration-150" href="#">
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
</div></nav>
<!-- Main Content Canvas -->
<main class="flex-1 ml-[260px] p-xl mx-auto w-full">
<!-- Breadcrumb / Header Actions -->
<div class="flex justify-between items-start mb-lg">
<div>
<a href = "/classes"><button class="flex items-center text-secondary font-label-caps text-label-caps gap-xs mb-md hover:text-primary transition-colors group">
<span class="material-symbols-outlined text-[16px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                        Back to Classes
                    </button></a>
<h2 class="font-headline-lg text-headline-lg text-primary mb-xs">Advanced Algorithms 401</h2>
<p class="font-body-md text-body-md text-secondary">Instructor: Dr. Aris Thorne</p>
</div>
<div class="flex gap-sm">


</div>
</div><div class="mt-lg bg-surface border border-outline-variant rounded-lg overflow-hidden w-full">
    <div class="px-lg py-sm bg-surface-container-low border-b border-outline-variant">
        <h3 class="font-label-caps text-label-caps text-secondary uppercase tracking-widest">Class Information</h3>
    </div>
    <div class="p-lg w-full">
        <div class="space-y-md">
            <div class="flex justify-between items-center">
                <p class="font-label-caps text-label-caps text-secondary uppercase">Term</p>
                <p class="font-bold text-body-md text-primary">Fall 2024</p>
            </div>
            <div class="flex justify-between items-center">
                <p class="font-label-caps text-label-caps text-secondary uppercase">Created</p>
                <p class="font-bold text-body-md text-primary">Aug 15, 2024</p>
            </div>
            <div class="flex justify-between items-center">
                <p class="font-label-caps text-label-caps text-secondary uppercase">Projects</p>
                <p class="font-bold text-body-md text-primary">4</p>
            </div>
            <div class="flex justify-between items-center">
                <p class="font-label-caps text-label-caps text-secondary uppercase">Total Tasks</p>
                <p class="font-bold text-body-md text-primary">128</p>
            </div>
        </div>
    </div>
</div><div class="mt-lg bg-surface border border-outline-variant rounded-lg overflow-hidden w-full">
    <div class="px-lg py-sm bg-surface-container-low border-b border-outline-variant">
        <h3 class="font-label-caps text-label-caps text-secondary uppercase tracking-widest">Admin Options</h3>
    </div>
    <div class="p-lg w-full">
        <div class="space-y-md">
            <button class="flex justify-between items-center w-full group hover:text-primary transition-colors">
                <div class="flex items-center gap-md">
                    <span class="material-symbols-outlined text-secondary group-hover:text-primary">download</span>
                    <p class="font-label-caps text-label-caps text-secondary uppercase group-hover:text-primary">Export Class Report</p>
                </div>
                <span class="material-symbols-outlined text-secondary text-[16px]">chevron_right</span>
            </button>
            <button class="flex justify-between items-center w-full group hover:text-primary transition-colors">
                <div class="flex items-center gap-md">
                    <span class="material-symbols-outlined text-secondary group-hover:text-primary">person_search</span>
                    <p class="font-label-caps text-label-caps text-secondary uppercase group-hover:text-primary">Reassign Instructor</p>
                </div>
                <span class="material-symbols-outlined text-secondary text-[16px]">chevron_right</span>
            </button>
        </div>
    </div>
</div>
<!-- Bento Grid Section -->

<!-- Lower Section: Roster and Projects -->

</main>
</div>
<!-- Micro-interaction Script -->
<script class="">
        document.querySelectorAll('.tonal-layer-1').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-2px)';
                card.style.transition = 'transform 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    </script>

</body></html>