<!DOCTYPE html><html class="light" lang="en" style=""><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>CarryOn Student Dashboard</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/student-dashboard.css') }}" rel="stylesheet">
</head>
<body class="bg-background text-on-surface flex flex-col min-h-screen" style="height: 995px; min-height: 995px;" data-mode="connect">
<!-- TopNavBar Component -->
<header class="sticky top-0 z-50 w-full bg-white border-b border-outline-variant shadow-sm px-margin py-md">
<div class="max-w-max-width mx-auto flex items-center justify-between">
<div class="flex items-center gap-xl">
<div>
<h1 class="font-headline-lg text-headline-lg font-black text-primary text-4xl">CarryOn</h1>
</div>
<nav class="hidden md:flex items-center gap-md">
<a class="flex items-center gap-sm px-md py-sm bg-secondary-container text-on-secondary-container font-bold rounded-lg" href="#">
<span class="material-symbols-outlined text-[20px]">dashboard</span>
<span class="font-body-md text-body-md">Dashboard</span>
</a>
</nav>
</div>
<div class="flex items-center gap-md">
<div class="h-8 w-8 rounded-full bg-surface-container-highest flex items-center justify-center border border-outline-variant cursor-pointer hover:text-primary transition-opacity duration-200">
<span class="material-symbols-outlined text-[20px]">notifications</span>
</div><div class="h-8 w-8 rounded-full bg-surface-container-highest flex items-center justify-center border border-outline-variant">
<span class="material-symbols-outlined text-[20px]">person</span>
</div>
</div>
</div>
</header>
<!-- Main Content Area -->
<main class="flex-grow w-full flex flex-col items-center">
<!-- Dashboard Canvas -->
<div class="p-margin max-w-max-width mx-auto w-full space-y-lg py-md">
<!-- Welcome Header -->
<h2 class="font-label-caps text-label-caps text-secondary mb-lg uppercase tracking-[0.2em] text-base">DASHBOARD</h2><div class="bg-white rounded-lg border border-outline-variant p-md mb-lg shadow-sm">
<div class="flex flex-col md:flex-row justify-between items-end md:items-center gap-md">
<div>
<h2 class="font-headline-lg text-headline-lg font-bold text-primary text-4xl">Welcome back, Alex.</h2>
<p class="font-body-md text-body-md text-on-surface-variant mt-xs">You have 3 milestones approaching this week across 2 projects.</p>
</div>
<div class="flex gap-sm">
<div class="text-right">
<span class="font-label-caps text-label-caps text-on-surface-variant block">CURRENT SEMESTER</span>
<span class="font-title-md text-title-md font-bold">Fall 2024</span>
</div>
</div>
</div>
</div>
<!-- Bento Grid Main Content -->
<div class="grid grid-cols-12 gap-lg">
<!-- Workload & Contribution -->
<div class="col-span-12 space-y-lg">
<!-- Contribution Scores -->
<h3 class="font-title-md text-title-md font-bold text-primary mb-sm border-b border-outline-variant pb-xs">My Classes</h3><div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
<div class="bg-surface-container-low p-md rounded-lg border border-outline-variant flex flex-col items-center text-center">
<span class="font-label-caps text-label-caps text-on-surface-variant mb-md text-sm">CS402: DISTRIBUTED SYSTEMS</span>
<div class="flex items-center justify-center h-16 mb-sm">
<span class="font-headline-lg text-headline-lg font-bold text-primary text-3xl">3 Groups</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant text-base">Active Collaborations</span>
</div>
<div class="bg-surface-container-low p-md rounded-lg border border-outline-variant flex flex-col items-center text-center">
<span class="font-label-caps text-label-caps text-on-surface-variant mb-md text-sm">PSY310: COGNITIVE ARCH</span>
<div class="flex items-center justify-center h-16 mb-sm">
<span class="font-headline-lg text-headline-lg font-bold text-primary text-3xl">2 Groups</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant text-base">Active Collaborations</span>
</div>
<div class="bg-surface-container-low p-md rounded-lg border border-outline-variant flex flex-col items-center text-center">
<span class="font-label-caps text-label-caps text-on-surface-variant mb-md text-sm">ART205: DIGITAL ETHICS</span>
<div class="flex items-center justify-center h-16 mb-sm">
<span class="font-headline-lg text-headline-lg font-bold text-primary text-3xl">4 Groups</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant text-base">Active Collaborations</span>
</div>
</div>
</div>
</div>
<!-- Footer Component -->
</div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rings = document.querySelectorAll('.contribution-ring');
        rings.forEach(ring => {
            const offset = ring.getAttribute('stroke-dashoffset');
            ring.style.strokeDashoffset = '251.2';
            setTimeout(() => {
                ring.style.strokeDashoffset = offset;
            }, 300);
        });
    });
</script>
<footer class="w-full py-xl border-t border-outline-variant mt-auto">
<div class="flex flex-col md:flex-row justify-between items-center max-w-max-width mx-auto gap-md px-margin">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-secondary">CARRYON ACADEMIC SYSTEMS</span>
<div class="flex flex-wrap justify-center gap-lg">
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary underline transition-opacity duration-200" href="#">Terms of Service</a>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary underline transition-opacity duration-200" href="#">Institutional Access</a>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary underline transition-opacity duration-200" href="#">Research Ethics</a>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary underline transition-opacity duration-200" href="#">Contact Support</a>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant">© 2024 CarryOn Academic Systems.</span>
</div>
</footer>


</body></html>