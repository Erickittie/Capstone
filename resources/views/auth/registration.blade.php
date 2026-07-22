<!DOCTYPE html><html class="light" lang="en"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Register | CarryOn Academic Management</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script src="{{ asset('js/tailwind-config.js') }}"></script>
    <link href="{{ asset('css/registration.css') }}" rel="stylesheet">
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
<!-- Top Navigation Suppression: Transactional Screen -->
<main class="flex-grow flex flex-col items-center justify-center px-4 py-xl">
<div class="w-full max-w-[480px]">
<!-- Header Section -->
<div class="flex flex-col items-center mb-xl">
<img alt="CarryOn Logo" class="h-16 w-16 mb-md object-contain" src="https://lh3.googleusercontent.com/aida/AP1WRLucGBg9N8aMpW00YSYyHNzx-amGnR6QlTIRwF4F1pZ4HoaIpRqg00ZNtc3mzJ7eM3-MzUKtT1Sx61tJndtNKM6ImqO-uWv52or527CVhlEgUSAj1lpeBXc5WJwf2TpaXHN6nc9ZEt4Ii_h6lH68TwqQvwxIOv2ymTD-PNcVuUS3KurctUGJtRIMYj3jnQ2STh9Ym72seVDwTE0164ulig_vvjLsw9RDOBXCbhMepaE3oOZYWYwAnPyTjg">
<h1 class="font-headline-lg text-headline-lg text-primary tracking-tight">Join CarryOn</h1>
<p class="font-body-md text-on-surface-variant mt-xs">Empowering academic excellence.</p>
</div>
<!-- Registration Form Container -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-xl shadow-sm">
<!-- Multi-Step Indicator -->
<form class="space-y-lg relative" id="registration-form">
<!-- Step 1: Role & Identity -->
<div class="step-transition active-step" id="step-1"><div class="space-y-lg">
<!-- Role Selection -->

<!-- Full Name -->
<div>
<label class="font-label-caps text-label-caps text-on-surface-variant block mb-xs" for="full_name">FULL NAME</label>
<input class="w-full h-12 px-md border border-outline-variant rounded-md focus:ring-2 focus:ring-primary focus:border-primary bg-surface transition-all outline-none" id="full_name" name="full_name" placeholder="Enter your full name" required="" type="text">
</div>
<!-- Email Address -->
<div>
<label class="font-label-caps text-label-caps text-on-surface-variant block mb-xs" for="email">EMAIL ADDRESS</label>
<input class="w-full h-12 px-md border border-outline-variant rounded-md focus:ring-2 focus:ring-primary focus:border-primary bg-surface transition-all outline-none" id="email" name="email" placeholder="name@institution.edu" required="" type="email">
</div>
<!-- Academic Year & Department -->
<div class="grid grid-cols-2 gap-md">
<div>
<label class="font-label-caps text-label-caps text-on-surface-variant block mb-xs" for="academic_year">ACADEMIC YEAR</label>
<select class="w-full h-12 px-md border border-outline-variant rounded-md focus:ring-2 focus:ring-primary focus:border-primary bg-surface transition-all outline-none" id="academic_year" name="academic_year" required="">
<option value="">Select Year</option>
<option value="freshman">Freshman</option>
<option value="sophomore">Sophomore</option>
<option value="junior">Junior</option>
<option value="senior">Senior</option>
<option value="graduate">Graduate</option>
<option value="faculty">Faculty</option>
</select>
</div>
<div>
<label class="font-label-caps text-label-caps text-on-surface-variant block mb-xs" for="department">DEPARTMENT</label>
<input class="w-full h-12 px-md border border-outline-variant rounded-md focus:ring-2 focus:ring-primary focus:border-primary bg-surface transition-all outline-none" id="department" name="department" placeholder="e.g. Computer Science" required="" type="text">
</div>
</div>
<!-- Institution -->
<div>
<label class="font-label-caps text-label-caps text-on-surface-variant block mb-xs" for="institution">INSTITUTION</label>
<div class="relative">
<input class="w-full h-12 px-md border border-outline-variant rounded-md focus:ring-2 focus:ring-primary focus:border-primary bg-surface transition-all outline-none" id="institution" name="institution" placeholder="e.g. Stanford University" required="" type="text">
<span class="material-symbols-outlined absolute right-md top-3 text-outline">account_balance</span>
</div>
</div>
<!-- Password Fields -->
<div class="grid grid-cols-2 gap-md">
<div>
<label class="font-label-caps text-label-caps text-on-surface-variant block mb-xs" for="password">PASSWORD</label>
<input class="w-full h-12 px-md border border-outline-variant rounded-md focus:ring-2 focus:ring-primary focus:border-primary bg-surface transition-all outline-none" id="password" name="password" placeholder="Min. 8 chars" required="" type="password">
</div>
<div>
<label class="font-label-caps text-label-caps text-on-surface-variant block mb-xs" for="confirm_password">CONFIRM</label>
<input class="w-full h-12 px-md border border-outline-variant rounded-md focus:ring-2 focus:ring-primary focus:border-primary bg-surface transition-all outline-none" id="confirm_password" name="confirm_password" placeholder="Repeat password" required="" type="password">
</div>
</div>
<button class="w-full h-12 bg-primary text-on-primary font-title-md text-title-md rounded-md hover:opacity-90 active:scale-95 transition-all flex items-center justify-center gap-sm mt-lg" type="submit">
    Create Account
  </button>
<p class="text-center font-body-sm text-body-sm text-on-surface-variant px-md mt-md">
    By signing up, you agree to our <a class="text-primary font-semibold hover:underline" href="#">Terms of Service</a> and <a class="text-primary font-semibold hover:underline" href="#">Privacy Policy</a>.
  </p>
</div></div>
<!-- Step 2: Security & Account -->
</form>
</div>
<!-- Footer Login Link -->
<div class="mt-lg text-center">
<p class="font-body-md text-body-md text-on-surface-variant">
                    Already have an account? 
                    <a class="text-primary font-bold hover:underline transition-all"href="/login">Log in</a>
</p>
</div>
</div>
</main>
<!-- Page Footer -->
<footer class="py-lg text-center border-t border-outline-variant">
<p class="font-label-caps text-label-caps text-on-surface-variant">© 2024 ProjectNexus • Academic Rigor &amp; Productivity</p>
</footer>
<script>
        let currentStep = 1;

        function selectRole(role) {
            document.getElementById('selected-role-input').value = role;
            
            // UI Updates
            const studentBtn = document.getElementById('role-student');
            const instructorBtn = document.getElementById('role-instructor');
            
            if (role === 'student') {
                studentBtn.classList.add('border-primary', 'bg-secondary-container', 'active');
                studentBtn.classList.remove('border-outline-variant');
                instructorBtn.classList.remove('border-primary', 'bg-secondary-container', 'active');
                instructorBtn.classList.add('border-outline-variant');
            } else {
                instructorBtn.classList.add('border-primary', 'bg-secondary-container', 'active');
                instructorBtn.classList.remove('border-outline-variant');
                studentBtn.classList.remove('border-primary', 'bg-secondary-container', 'active');
                studentBtn.classList.add('border-outline-variant');
            }
        }

        function goToStep(step) {
            const step1 = document.getElementById('step-1');
            const step2 = document.getElementById('step-2');
            const dot1 = document.getElementById('dot-1');
            const dot2 = document.getElementById('dot-2');

            if (step === 2) {
                // Validation check for step 1
                const name = document.getElementById('full_name').value;
                const inst = document.getElementById('institution').value;
                const role = document.getElementById('selected-role-input').value;

                if (!name || !inst || !role) {
                    alert('Please complete all fields and select a role before continuing.');
                    return;
                }

                step1.classList.replace('active-step', 'hidden-step');
                step2.classList.replace('hidden-step', 'active-step');
                dot1.classList.replace('w-8', 'w-2');
                dot1.classList.replace('bg-primary', 'bg-outline-variant');
                dot2.classList.replace('w-2', 'w-8');
                dot2.classList.replace('bg-outline-variant', 'bg-primary');
            } else {
                step2.classList.replace('active-step', 'hidden-step');
                step1.classList.replace('hidden-step', 'active-step');
                dot2.classList.replace('w-8', 'w-2');
                dot2.classList.replace('bg-primary', 'bg-outline-variant');
                dot1.classList.replace('w-2', 'w-8');
                dot1.classList.replace('bg-outline-variant', 'bg-primary');
            }
            currentStep = step;
        }

        function togglePassword() {
            const pwd = document.getElementById('password');
            const confirm = document.getElementById('confirm_password');
            const icon = document.getElementById('password-toggle-icon');
            
            if (pwd.type === 'password') {
                pwd.type = 'text';
                confirm.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                pwd.type = 'password';
                confirm.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        document.getElementById('registration-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const pwd = document.getElementById('password').value;
            const confirm = document.getElementById('confirm_password').value;

            if (pwd !== confirm) {
                alert("Passwords do not match.");
                return;
            }

            alert("Registration initiated. Welcome to CarryOn!");
        });
    </script>


</body></html>