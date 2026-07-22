<!DOCTYPE html><html class="light" lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Login - CarryOn Academic Systems</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body class="bg-background min-h-screen flex flex-col">
<!-- Top Navigation (Shell suppressed as per transactional rule, but branding maintained) -->
<header class="w-full h-16 flex items-center px-margin max-w-max-width mx-auto">
<div class="flex items-center gap-base">
<span class="font-display-lg text-headline-lg font-bold text-primary">CarryOn</span>
</div>
</header>
<!-- Main Content: Login Canvas -->
<main class="flex-grow flex items-center justify-center px-margin py-xl">
<div class="w-full max-w-[440px]">
<!-- Login Card -->
<div class="login-card bg-surface-container-lowest border border-outline-variant rounded-lg p-xl space-y-md">
<!-- Brand Identity -->
<div class="flex flex-col items-center text-center space-y-md">
<img alt="CarryOn Logo" class="w-16 h-16 object-contain rounded-md" src="https://lh3.googleusercontent.com/aida/AP1WRLucGBg9N8aMpW00YSYyHNzx-amGnR6QlTIRwF4F1pZ4HoaIpRqg00ZNtc3mzJ7eM3-MzUKtT1Sx61tJndtNKM6ImqO-uWv52or527CVhlEgUSAj1lpeBXc5WJwf2TpaXHN6nc9ZEt4Ii_h6lH68TwqQvwxIOv2ymTD-PNcVuUS3KurctUGJtRIMYj3jnQ2STh9Ym72seVDwTE0164ulig_vvjLsw9RDOBXCbhMepaE3oOZYWYwAnPyTjg">
<div>
<h1 class="font-headline-lg text-headline-lg text-primary">Welcome back</h1>
<p class="font-body-sm text-body-sm text-on-surface-variant">Access your academic workspace</p>
</div>
</div>
<!-- SSO Action -->

<!-- Divider -->

<!-- Email Form -->
<form class="space-y-md" onsubmit="event.preventDefault();">
<div class="space-y-xs">
<label class="font-label-caps text-label-caps text-on-surface-variant block uppercase" for="email">Academic Email</label>
<div class="relative">
<span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline" data-icon="mail">mail</span>
<input class="w-full h-11 pl-[44px] pr-md border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary transition-colors bg-surface-container-low" id="email" placeholder="name@institution.edu" type="email">
</div>
</div>
<div class="space-y-xs">
<div class="flex justify-between items-center">
<label class="font-label-caps text-label-caps text-on-surface-variant block uppercase" for="password">Password</label>
<a class="font-body-sm text-body-sm text-secondary hover:text-primary transition-colors" href="#">Forgot password?</a>
</div>
<div class="relative">
<span class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline" data-icon="lock">lock</span>
<input class="w-full h-11 pl-[44px] pr-md border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:border-primary transition-colors bg-surface-container-low" id="password" placeholder="••••••••" type="password">
</div>
</div>
<div class="pt-sm space-y-sm">
<button class="w-full h-12 bg-primary text-on-primary font-headline-lg-mobile text-body-md rounded-lg hover:opacity-90 active:scale-[0.98] transition-all" type="submit">
                            Log In
                        </button>
<a href="/dashboard" class="w-full h-12 border border-outline text-primary font-headline-lg-mobile text-body-md rounded-lg flex items-center justify-center hover:bg-surface-container-low active:scale-[0.98] transition-all">
                            Access Teacher Dashboard
</a>
<a href="/StudentDashboard" class="w-full h-12 border border-outline text-primary font-headline-lg-mobile text-body-md rounded-lg flex items-center justify-center hover:bg-surface-container-low active:scale-[0.98] transition-all">
                            Access Student Dashboard
</a>
<a href="/overview" class="w-full h-12 border border-outline text-primary font-headline-lg-mobile text-body-md rounded-lg flex items-center justify-center hover:bg-surface-container-low active:scale-[0.98] transition-all">
                            Access Admin Dashboard
</a>
</div>
</form>
<!-- Help Link -->
<div class="text-center pt-md">
<p class="font-body-sm text-body-sm text-on-surface-variant">
                        New to CarryOn? 
                        <a class="text-primary font-semibold hover:underline" href="#">Contact your Administrator</a>
</p>
</div>
</div>
<!-- Contextual Information (Academic Rigor) -->
<div class="mt-lg grid grid-cols-2 gap-md opacity-60">
<div class="flex items-start gap-sm">
<span class="material-symbols-outlined text-[18px]" data-icon="verified_user">verified_user</span>
<p class="font-body-sm text-[12px] leading-tight">Secure Research Environment</p>
</div>
<div class="flex items-start gap-sm">
<span class="material-symbols-outlined text-[18px]" data-icon="history_edu">history_edu</span>
<p class="font-body-sm text-[12px] leading-tight">FERPA &amp; GDPR Compliant</p>
</div>
</div>
</div>
</main>
<!-- Simple Transactional Footer -->
<footer class="w-full py-xl border-t border-outline-variant">
<div class="max-w-max-width mx-auto px-margin flex flex-col md:flex-row justify-between items-center gap-md">
<p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 CarryOn Academic Systems. All rights reserved.</p>
<div class="flex gap-lg">
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Research Ethics</a>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Institutional Access</a>
<a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Contact Support</a>
</div>
</div>
</footer>
<script>
        // Micro-interaction for input focusing
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.querySelector('.material-symbols-outlined').style.color = '#041627';
            });
            input.addEventListener('blur', () => {
                input.parentElement.querySelector('.material-symbols-outlined').style.color = '#74777d';
            });
        });

        // Simple login validation simulation
        const loginBtn = document.querySelector('button[type="submit"]');
        loginBtn.addEventListener('click', (e) => {
            const originalText = loginBtn.innerText;
            loginBtn.innerText = 'Verifying...';
            loginBtn.disabled = true;
            loginBtn.style.opacity = '0.7';
            
            setTimeout(() => {
                loginBtn.innerText = originalText;
                loginBtn.disabled = false;
                loginBtn.style.opacity = '1';
            }, 1500);
        });
    </script>


</body></html>