<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>
<body class="bg-background text-on-background font-body-md selection:bg-primary-fixed selection:text-on-primary-fixed">
<!-- Top AppBar Navigation -->
<header class="sticky top-0 z-50 bg-surface border-b border-outline-variant flex justify-between items-center h-16 px-lg w-full">
<div class="flex items-center gap-4">
<img alt="CarryOn Logo" class="h-8 w-8 object-contain" src="https://lh3.googleusercontent.com/aida/AP1WRLucGBg9N8aMpW00YSYyHNzx-amGnR6QlTIRwF4F1pZ4HoaIpRqg00ZNtc3mzJ7eM3-MzUKtT1Sx61tJndtNKM6ImqO-uWv52or527CVhlEgUSAj1lpeBXc5WJwf2TpaXHN6nc9ZEt4Ii_h6lH68TwqQvwxIOv2ymTD-PNcVuUS3KurctUGJtRIMYj3jnQ2STh9Ym72seVDwTE0164ulig_vvjLsw9RDOBXCbhMepaE3oOZYWYwAnPyTjg"/>
<span class="font-headline-lg text-title-md font-bold text-primary">CarryOn</span>
</div>
<nav class="hidden md:flex items-center gap-xl">
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-all" href="#features">Features</a>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-all" href="#how-it-works">Workflows</a>
<a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-all" href="#pricing">Institutions</a>
</nav>
<div class="flex items-center gap-md">
<a href="/login"
class="px-md py-sm font-label-caps text-label-caps text-primary hover:bg-surface-container-low rounded-lg transition-colors">
Login
</a>
<a href="/registration"
class="bg-primary text-on-primary px-xl py-md rounded-lg font-title-md text-title-md hover:shadow-lg transition-shadow flex items-center justify-center gap-sm">
Get Started for Free
<span class="material-symbols-outlined">arrow_forward</span>
</a>
</div>
</header>
<main>
<!-- Hero Section -->
<section class="relative overflow-hidden pt-20 pb-32 px-margin border-b border-outline-variant bg-surface">
<div class="max-w-max-width mx-auto flex flex-col md:flex-row items-center gap-xl relative z-10">
<div class="flex-1 space-y-lg text-center md:text-left">
<div class="inline-flex items-center px-sm py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed-variant font-label-caps text-[10px] uppercase tracking-widest">
                        Scholastic Project Management 1.0
                    </div>
<h1 class="font-display-lg text-display-lg text-primary max-w-2xl leading-tight">
                        Balance academic rigor with <span class="text-secondary">effortless collaboration.</span>
</h1>
<p class="font-body-md text-body-md text-on-surface-variant max-w-xl">
                        CarryOn is the dedicated workspace where students and instructors synchronize. High-fidelity tracking, peer-verified contributions, and a unified task ledger for academic success.
                    </p>
<div class="flex flex-col sm:flex-row gap-md justify-center md:justify-start">
<button class="bg-primary text-on-primary px-xl py-md rounded-lg font-title-md text-title-md hover:shadow-lg transition-shadow flex items-center justify-center gap-sm">
                            Get Started for Free
                            <span class="material-symbols-outlined">arrow_forward</span>
</button>
<button class="border border-outline px-xl py-md rounded-lg font-title-md text-title-md text-on-surface hover:bg-surface-container-low transition-colors">
                            View Case Studies
                        </button>
</div>
<div class="flex items-center gap-md pt-md justify-center md:justify-start">
<div class="flex -space-x-2">
<div class="w-8 h-8 rounded-full border-2 border-surface bg-slate-200 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A high-quality portrait of a serious young university student in a bright library setting, soft focus background of books, modern academic attire, professional lighting." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWvbB86Ip1B3Y5GFcSEdmFAWPezT0jwk0uB6P6pKjtH0Vc6pZMg_bP_pKkqoCjdwARXPVSkT75baJZPvKCsUZZkwRxrKwi7FGhJvkzHHZIXxAuvQsVIMo3cssnPLnXGO-Kh3kCSZmoFUf66sC8AK3tRvvEakJjmeuZ7kCwUd87sK8avkV_ZqtCReW-s1kIjbSOLqkY6adtnOD4thgiEw_j8kCIl56e_gmW1WeWX__GVwo81SBe2i_9"/>
</div>
<div class="w-8 h-8 rounded-full border-2 border-surface bg-slate-300 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A focused female graduate student wearing glasses and a light gray blazer, working in a clean minimalist laboratory environment, looking directly at the camera with a subtle smile." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCcO53hhlzPPu4d4tPwr3pl3G7tVsNd5S-2R_HKH1E9_5V87AjtkuLrwEUblMYBqWEOm3u9_8a4hud5Y--aFAsp5MdS-UEAq-FuFGNPZYXrsTDishBS8j8qP4UHC5_QzT0HSBs7aAmP2yHMS6X6uQ9UO-xLxKQYSbBeKKVGIXs5hkT8rJ85_yNBkj3alP6z_ied-mVHd_M_spyfBvQkbMjuBXqLkwGd1KDu1WconqXKo4z7_7xGbsLg"/>
</div>
<div class="w-8 h-8 rounded-full border-2 border-surface bg-slate-400 overflow-hidden">
<img class="w-full h-full object-cover" data-alt="A diverse male academic researcher in a modern office with large windows, bright daylight, high-key lighting, corporate minimalist aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuClrzJFcVWzdBWvYO1EBOn7YEPqjxNVUD41gflboP9N9aaYfbUp3n7Pkwzi74O4GCBSE02M3o1DpzkjRS0KgJUb47f43Rcp8Z2Z90QbJQfng-iKuR3zwzCyO7PgSgoTkaf0uGEZC1PF5TMytl2nevtpS4cyRVdFV-PXkpOUgfr9bE_NmdWk1LNo5PdleAcKN8JmXiNW5a4F6Bs-43YB4lzHLs4wFbFwV7Umx51MzduIhL12t1ZJHDSS"/>
</div>
</div>
<span class="text-body-sm font-label-caps text-on-surface-variant italic">Trusted by 12,000+ Students</span>
</div>
</div>
<div class="flex-1 w-full max-w-2xl">
<div class="relative p-base bg-outline-variant rounded-xl academic-glow">
<div class="bg-surface-container-lowest rounded-lg overflow-hidden border border-outline-variant aspect-[4/3] relative">
<img class="w-full h-full object-cover" data-alt="A clean and modern digital dashboard interface for academic project management, showing gantt charts, student contribution graphs, and task cards in a palette of deep navy and soft grays. The design is high-density, professional, and clear." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqan9VFneFtX8IkjvQc0yrMxGwBixxzWoiFbAx85dYKIVtAqxuGLXxbGkiFqIKTzDamMDaacSj-q4C1Au2wk_K3DjT70am1xBJy8tBFPB7r7pSIt8ErsZxUzi-6NXaX5dSXK_7y5outUoQ2k5AcDuDx_coEYCpw4p-mM4zawOZCPYbGWgiLLo-u1H20q-T62oOtxpWsrcIqeZrCB3Z416aGm4sZcghP4Vrr3LC7DWW61pB_ylFiiFH"/>
</div>
</div>
</div>
</div>
<!-- Atmospheric element -->
<div class="absolute -right-20 top-20 w-[500px] h-[500px] bg-secondary-fixed opacity-10 rounded-full blur-[120px] pointer-events-none"></div>
</section>
<!-- Features Bento Grid -->
<section class="py-32 px-margin bg-background" id="features">
<div class="max-w-max-width mx-auto">
<div class="mb-xl">
<h2 class="font-label-caps text-label-caps text-secondary mb-base uppercase tracking-tighter">Core Infrastructure</h2>
<h3 class="font-headline-lg text-headline-lg text-primary">High-fidelity tools for modern scholars</h3>
</div>
<div class="bento-grid">
<!-- Contribution Tracking -->
<div class="col-span-12 md:col-span-8 bg-surface border border-outline-variant p-lg rounded-xl flex flex-col justify-between hover:border-primary transition-colors">
<div class="space-y-sm">
<span class="material-symbols-outlined text-primary text-3xl">monitoring</span>
<h4 class="font-title-md text-title-md text-primary">Contribution Tracking</h4>
<p class="font-body-md text-on-surface-variant max-w-md">Real-time telemetry on every commit, edit, and discussion. See exactly who is carrying the weight with automated heatmaps and frequency analysis.</p>
</div>
<div class="mt-lg rounded-lg border border-outline-variant overflow-hidden h-48 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="A detailed data visualization showing a contribution heatmap for a group project, featuring shades of deep blue and slate. The aesthetic is clean, professional, and academic, representing high-velocity productivity." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD3Ji3S3f5bj99YYI5r9d2HfNe4flCdBn2A5lRwqmrTyAYnmA42hmvTawl0eZxNXX_7OcaLbzgKIW--j_p8yVwzseKR3A-LEQS0cclvp5jO0lS6i9ZLoA0vJgW8KVrAYsbrO5n6q9ba6dx9kNe43Ub5iO-ozc7MNXJSuzFRK1DeK7zLF0NcuKPLfAwNfAGF4ZDMhNyALICj0swRwRgV3uwJrn2zfnK4eeLuwEiT0Xu6rqnmItcMZmGB"/>
</div>
</div>
<!-- Peer Voting -->
<div class="col-span-12 md:col-span-4 bg-primary text-on-primary p-lg rounded-xl space-y-md flex flex-col justify-center">
<span class="material-symbols-outlined text-on-primary-container text-3xl">how_to_reg</span>
<h4 class="font-title-md text-title-md">Peer Voting</h4>
<p class="font-body-sm text-on-primary-container">Democratize project direction and performance reviews with cryptographic, anonymous peer-to-peer validation cycles.</p>
<div class="pt-sm">
<div class="flex items-center gap-sm bg-primary-container/30 p-sm rounded border border-white/10">
<span class="material-symbols-outlined text-sm">check_circle</span>
<span class="text-xs font-label-caps uppercase">Consensus Reached</span>
</div>
</div>
</div>
<!-- Task Ledger -->
<div class="col-span-12 md:col-span-5 bg-surface border border-outline-variant p-lg rounded-xl space-y-md">
<span class="material-symbols-outlined text-primary text-3xl">assignment</span>
<h4 class="font-title-md text-title-md text-primary">Task Ledger</h4>
<p class="font-body-sm text-on-surface-variant">An immutable record of responsibilities. Every task assigned is logged with strict deadlines and academic milestone linking.</p>
<div class="space-y-sm pt-md">
<div class="h-1 w-full bg-surface-container-high rounded-full overflow-hidden">
<div class="bg-primary h-full w-2/3"></div>
</div>
<div class="flex justify-between text-[10px] font-label-caps text-on-surface-variant">
<span>MILESTONE 01</span>
<span>68% COMPLETE</span>
</div>
</div>
</div>
<!-- Academic Integration -->
<div class="col-span-12 md:col-span-7 bg-surface-container-low border border-outline-variant p-lg rounded-xl flex items-center gap-lg">
<div class="flex-1 space-y-sm">
<h4 class="font-title-md text-title-md text-primary">LMS Integration</h4>
<p class="font-body-sm text-on-surface-variant">Direct hooks into Canvas, Blackboard, and Moodle for seamless grade synchronization and enrollment management.</p>
<button class="text-primary font-label-caps text-label-caps flex items-center gap-xs hover:gap-sm transition-all">
                                LEARN MORE <span class="material-symbols-outlined text-sm">north_east</span>
</button>
</div>
<div class="flex-1 hidden sm:block">
<div class="grid grid-cols-2 gap-sm">
<div class="h-16 bg-surface-container-highest rounded border border-outline-variant"></div>
<div class="h-16 bg-surface-container-highest rounded border border-outline-variant"></div>
<div class="h-16 bg-surface-container-highest rounded border border-outline-variant"></div>
<div class="h-16 bg-surface-container-highest rounded border border-outline-variant"></div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- How It Works (Split View) -->
<section class="py-32 px-margin border-t border-outline-variant bg-surface-bright" id="how-it-works">
<div class="max-w-max-width mx-auto">
<div class="text-center mb-24">
<h2 class="font-display-lg text-headline-lg text-primary">One platform. Two Perspectives.</h2>
<p class="text-on-surface-variant mt-sm">Tailored workflows for the entire academic ecosystem.</p>
</div>
<div class="grid md:grid-cols-2 gap-gutter">
<!-- For Students -->
<div class="space-y-xl p-xl border border-outline-variant rounded-2xl bg-surface hover:shadow-xl transition-all">
<div class="flex items-center gap-md">
<div class="w-12 h-12 rounded-lg bg-secondary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-on-secondary-fixed">school</span>
</div>
<h3 class="font-headline-lg text-headline-lg text-primary">For Students</h3>
</div>
<div class="space-y-lg">
<div class="flex gap-md">
<span class="font-display-lg text-secondary opacity-20">01</span>
<div>
<h4 class="font-title-md text-primary">Join Your Cohort</h4>
<p class="text-body-sm text-on-surface-variant">Sync with your university credentials and automatically find your project teams.</p>
</div>
</div>
<div class="flex gap-md">
<span class="font-display-lg text-secondary opacity-20">02</span>
<div>
<h4 class="font-title-md text-primary">Execute Tasks</h4>
<p class="text-body-sm text-on-surface-variant">Use our high-density task boards to manage deadlines and dependencies with precision.</p>
</div>
</div>
<div class="flex gap-md">
<span class="font-display-lg text-secondary opacity-20">03</span>
<div>
<h4 class="font-title-md text-primary">Prove Your Value</h4>
<p class="text-body-sm text-on-surface-variant">Your contribution metrics are automatically compiled into a project portfolio for grading.</p>
</div>
</div>
</div>
</div>
<!-- For Instructors -->
<div class="space-y-xl p-xl border border-outline-variant rounded-2xl bg-primary text-on-primary hover:shadow-xl transition-all">
<div class="flex items-center gap-md">
<div class="w-12 h-12 rounded-lg bg-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-on-primary-container">analytics</span>
</div>
<h3 class="font-headline-lg text-headline-lg">For Instructors</h3>
</div>
<div class="space-y-lg">
<div class="flex gap-md">
<span class="font-display-lg text-on-primary opacity-20">01</span>
<div>
<h4 class="font-title-md">Monitor Health</h4>
<p class="text-body-sm text-on-primary-container">Get high-level alerts for teams that are lagging or facing internal conflict.</p>
</div>
</div>
<div class="flex gap-md">
<span class="font-display-lg text-on-primary opacity-20">02</span>
<div>
<h4 class="font-title-md">Verify Fairness</h4>
<p class="text-body-sm text-on-primary-container">Use peer voting data to adjust individual grades based on actual effort, not just outcomes.</p>
</div>
</div>
<div class="flex gap-md">
<span class="font-display-lg text-on-primary opacity-20">03</span>
<div>
<h4 class="font-title-md">Bulk Grading</h4>
<p class="text-body-sm text-on-primary-container">Export comprehensive project reports directly to your LMS gradebook in one click.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Final CTA -->
<section class="py-32 px-margin text-center">
<div class="max-w-3xl mx-auto space-y-xl">
<h2 class="font-display-lg text-display-lg text-primary">Ready to elevate your academic project experience?</h2>
<p class="text-body-md text-on-surface-variant">Join thousands of researchers and students using CarryOn to deliver high-impact results without the friction.</p>
<div class="flex flex-col sm:flex-row justify-center items-center gap-md">
<button class="bg-primary text-on-primary px-xl py-lg rounded-lg font-title-md text-title-md hover:opacity-90 transition-all w-full sm:w-auto shadow-lg">
                        Get Started for Free
                    </button>
<button class="px-xl py-lg rounded-lg font-title-md text-title-md text-primary border border-outline hover:bg-surface-container-low transition-all w-full sm:w-auto">
                        Talk to an Academic Advisor
                    </button>
</div>
<div class="pt-lg flex items-center justify-center gap-xl grayscale opacity-50 overflow-hidden">
<div class="font-label-caps text-label-caps flex items-center gap-sm">
<span class="material-symbols-outlined">security</span>
                        EDU SECURE
                    </div>
<div class="font-label-caps text-label-caps flex items-center gap-sm">
<span class="material-symbols-outlined">verified_user</span>
                        FERPA COMPLIANT
                    </div>
<div class="font-label-caps text-label-caps flex items-center gap-sm">
<span class="material-symbols-outlined">api</span>
                        LTI READY
                    </div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="bg-surface border-t border-outline-variant pt-20 pb-10 px-margin">
<div class="max-w-max-width mx-auto grid grid-cols-1 md:grid-cols-4 gap-xl">
<div class="col-span-1 md:col-span-1 space-y-md">
<div class="flex items-center gap-4">
<img alt="CarryOn Logo" class="h-6 w-6" src="https://lh3.googleusercontent.com/aida/AP1WRLucGBg9N8aMpW00YSYyHNzx-amGnR6QlTIRwF4F1pZ4HoaIpRqg00ZNtc3mzJ7eM3-MzUKtT1Sx61tJndtNKM6ImqO-uWv52or527CVhlEgUSAj1lpeBXc5WJwf2TpaXHN6nc9ZEt4Ii_h6lH68TwqQvwxIOv2ymTD-PNcVuUS3KurctUGJtRIMYj3jnQ2STh9Ym72seVDwTE0164ulig_vvjLsw9RDOBXCbhMepaE3oOZYWYwAnPyTjg"/>
<span class="font-headline-lg text-title-md font-bold text-primary">CarryOn</span>
</div>
<p class="text-body-sm text-on-surface-variant">Empowering the next generation of academic leaders with rigorous project management infrastructure.</p>
</div>
<div class="space-y-md">
<h5 class="font-label-caps text-label-caps text-primary uppercase">Platform</h5>
<ul class="space-y-sm text-body-sm text-on-surface-variant">
<li><a class="hover:text-primary" href="#">Contribution Tracking</a></li>
<li><a class="hover:text-primary" href="#">Peer Voting</a></li>
<li><a class="hover:text-primary" href="#">LMS Integrations</a></li>
<li><a class="hover:text-primary" href="#">Security &amp; Compliance</a></li>
</ul>
</div>
<div class="space-y-md">
<h5 class="font-label-caps text-label-caps text-primary uppercase">Resources</h5>
<ul class="space-y-sm text-body-sm text-on-surface-variant">
<li><a class="hover:text-primary" href="#">Documentation</a></li>
<li><a class="hover:text-primary" href="#">Academic Blog</a></li>
<li><a class="hover:text-primary" href="#">Case Studies</a></li>
<li><a class="hover:text-primary" href="#">Help Center</a></li>
</ul>
</div>
<div class="space-y-md">
<h5 class="font-label-caps text-label-caps text-primary uppercase">Company</h5>
<ul class="space-y-sm text-body-sm text-on-surface-variant">
<li><a class="hover:text-primary" href="#">About Us</a></li>
<li><a class="hover:text-primary" href="#">Careers</a></li>
<li><a class="hover:text-primary" href="#">Contact</a></li>
<li><a class="hover:text-primary" href="#">Legal</a></li>
</ul>
</div>
</div>
<div class="max-w-max-width mx-auto mt-20 pt-10 border-t border-outline-variant flex flex-col md:flex-row justify-between items-center gap-md text-body-sm text-on-surface-variant opacity-60">
<p>© 2024 CarryOn Academic. All rights reserved.</p>
<div class="flex gap-xl">
<a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
<a class="hover:text-primary transition-colors" href="#">Cookie Settings</a>
</div>
</div>
</footer>
<script>
        // Micro-interactions for scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Simple Intersection Observer for reveal effects
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section').forEach(section => {
            section.classList.add('transition-all', 'duration-700', 'opacity-0', 'translate-y-10');
            observer.observe(section);
        });
    </script>
</body></html>