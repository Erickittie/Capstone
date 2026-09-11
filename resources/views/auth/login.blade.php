<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

```
<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>CarryOn | Sign In</title>

{{-- Tailwind CSS --}}
<script src="https://cdn.tailwindcss.com"></script>

{{-- Material Symbols --}}
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,300..700,0..1,0&display=swap"
    rel="stylesheet"
>
```

</head>

<body class="min-h-screen bg-gray-100">

<div class="min-h-screen flex">

```
{{-- =========================================================
     LEFT BRANDING PANEL
========================================================== --}}

<div
    class="hidden lg:flex
           lg:w-1/2
           relative
           overflow-hidden
           bg-[#0A4D8C]"
>

    {{-- Decorative circles --}}

    <div
        class="absolute
               -top-32
               -left-32
               w-96
               h-96
               rounded-full
               bg-white/10"
    ></div>

    <div
        class="absolute
               -bottom-40
               -right-20
               w-[500px]
               h-[500px]
               rounded-full
               bg-white/10"
    ></div>

    <div
        class="absolute
               top-1/3
               right-20
               w-32
               h-32
               rounded-full
               bg-blue-300/10"
    ></div>


    {{-- Main branding --}}

    <div
        class="relative
               z-10
               flex
               flex-col
               justify-center
               px-16
               xl:px-24
               text-white
               w-full"
    >

        {{-- Logo --}}

        <div class="flex items-center gap-4 mb-10">

            <div
                class="w-14
                       h-14
                       rounded-2xl
                       bg-white
                       flex
                       items-center
                       justify-center
                       shadow-xl"
            >

                <span
                    class="material-symbols-outlined
                           text-[#0A4D8C]
                           text-[32px]"
                >
                    work_history
                </span>

            </div>


            <div>

                <h1 class="text-3xl font-bold tracking-tight">
                    CarryOn
                </h1>

                <p class="text-blue-100 text-sm">
                    Academic Project Management
                </p>

            </div>

        </div>


        {{-- Main heading --}}

        <h2
            class="text-5xl
                   xl:text-6xl
                   font-bold
                   leading-tight
                   max-w-xl"
        >
            Manage projects.
            <br>

            <span class="text-blue-200">
                Track progress.
            </span>
        </h2>


        <p
            class="mt-6
                   text-blue-100
                   text-lg
                   leading-relaxed
                   max-w-lg"
        >
            CarryOn helps students and instructors organize
            academic projects, manage tasks, monitor contributions,
            and work together more effectively.
        </p>


        {{-- Feature cards --}}

        <div class="grid grid-cols-2 gap-4 mt-10 max-w-lg">

            <div
                class="flex items-center gap-3
                       p-4
                       rounded-xl
                       bg-white/10
                       border border-white/10
                       backdrop-blur-sm"
            >

                <span
                    class="material-symbols-outlined
                           text-blue-200"
                >
                    task_alt
                </span>

                <div>

                    <p class="font-semibold text-sm">
                        Task Management
                    </p>

                    <p class="text-xs text-blue-200 mt-0.5">
                        Stay organized
                    </p>

                </div>

            </div>


            <div
                class="flex items-center gap-3
                       p-4
                       rounded-xl
                       bg-white/10
                       border border-white/10
                       backdrop-blur-sm"
            >

                <span
                    class="material-symbols-outlined
                           text-blue-200"
                >
                    analytics
                </span>

                <div>

                    <p class="font-semibold text-sm">
                        Progress Tracking
                    </p>

                    <p class="text-xs text-blue-200 mt-0.5">
                        See your contribution
                    </p>

                </div>

            </div>

        </div>


        {{-- Bottom text --}}

        <div class="mt-12 flex items-center gap-2 text-blue-200">

            <span
                class="material-symbols-outlined text-[18px]"
            >
                verified_user
            </span>

            <span class="text-sm">
                Secure academic workspace
            </span>

        </div>

    </div>

</div>



{{-- =========================================================
     RIGHT LOGIN PANEL
========================================================== --}}

<div
    class="w-full
           lg:w-1/2
           flex
           items-center
           justify-center
           px-6
           py-10
           bg-gray-50"
>

    <div class="w-full max-w-md">


        {{-- Mobile logo --}}

        <div class="lg:hidden text-center mb-8">

            <div
                class="inline-flex
                       items-center
                       justify-center
                       w-14
                       h-14
                       rounded-2xl
                       bg-[#0A4D8C]
                       text-white
                       shadow-lg"
            >

                <span class="material-symbols-outlined text-[30px]">
                    work_history
                </span>

            </div>

            <h1
                class="text-3xl
                       font-bold
                       text-[#0A4D8C]
                       mt-3"
            >
                CarryOn
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Academic Project Management
            </p>

        </div>


        {{-- Login Card --}}

        <div
            class="bg-white
                   rounded-3xl
                   border border-gray-200
                   shadow-xl
                   shadow-gray-200/60
                   p-8
                   sm:p-10"
        >


            {{-- Header --}}

            <div class="mb-8">

                <div
                    class="inline-flex
                           items-center
                           justify-center
                           w-11
                           h-11
                           rounded-xl
                           bg-blue-50
                           text-[#0A4D8C]
                           mb-5"
                >

                    <span class="material-symbols-outlined text-[24px]">
                        lock_open
                    </span>

                </div>


                <h2
                    class="text-3xl
                           font-bold
                           text-gray-900"
                >
                    Welcome back
                </h2>


                <p class="text-gray-500 mt-2">
                    Sign in to continue to your CarryOn workspace.
                </p>

            </div>


            {{-- =================================================
                 LOGIN FORM
            ================================================== --}}

            <form
                action="{{ route('authenticate') }}"
                method="POST"
                class="space-y-6"
            >

                @csrf


                {{-- SUCCESS --}}

                @if(session('success'))

                    <div
                        class="flex items-start gap-3
                               bg-green-50
                               border border-green-200
                               text-green-700
                               rounded-xl
                               px-4 py-3"
                    >

                        <span
                            class="material-symbols-outlined
                                   text-[20px]"
                        >
                            check_circle
                        </span>

                        <div>

                            <p class="text-sm font-semibold">
                                Success
                            </p>

                            <p class="text-sm mt-0.5">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- ERRORS --}}

                @if($errors->any())

                    <div
                        class="flex items-start gap-3
                               bg-red-50
                               border border-red-200
                               text-red-700
                               rounded-xl
                               px-4 py-3"
                    >

                        <span
                            class="material-symbols-outlined
                                   text-[20px]"
                        >
                            error
                        </span>

                        <div>

                            <p class="text-sm font-semibold">
                                Sign in failed
                            </p>

                            <p class="text-sm mt-0.5">
                                {{ $errors->first() }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- EMAIL --}}

                <div>

                    <label
                        for="email"
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2"
                    >
                        Academic Email
                    </label>


                    <div class="relative group">

                        <span
                            class="material-symbols-outlined
                                   absolute
                                   left-4
                                   top-1/2
                                   -translate-y-1/2
                                   text-gray-400
                                   group-focus-within:text-[#0A4D8C]
                                   transition"
                        >
                            mail
                        </span>


                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="name@usjr.edu.ph"
                            autocomplete="email"
                            class="w-full
                                   h-14
                                   pl-12
                                   pr-4
                                   rounded-xl
                                   border border-gray-200
                                   bg-gray-50
                                   text-gray-800
                                   placeholder-gray-400
                                   outline-none
                                   transition-all
                                   focus:bg-white
                                   focus:border-[#0A4D8C]
                                   focus:ring-4
                                   focus:ring-blue-100"
                            required
                        >

                    </div>

                </div>


                {{-- PASSWORD --}}

                <div>

                    <div class="flex items-center justify-between mb-2">

                        <label
                            for="password"
                            class="text-sm
                                   font-semibold
                                   text-gray-700"
                        >
                            Password
                        </label>


                        <a
                            href="#"
                            class="text-sm
                                   font-medium
                                   text-[#0A4D8C]
                                   hover:text-[#083A69]
                                   hover:underline"
                        >
                            Forgot Password?
                        </a>

                    </div>


                    <div class="relative group">

                        <span
                            class="material-symbols-outlined
                                   absolute
                                   left-4
                                   top-1/2
                                   -translate-y-1/2
                                   text-gray-400
                                   group-focus-within:text-[#0A4D8C]
                                   transition"
                        >
                            lock
                        </span>


                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            class="w-full
                                   h-14
                                   pl-12
                                   pr-12
                                   rounded-xl
                                   border border-gray-200
                                   bg-gray-50
                                   text-gray-800
                                   placeholder-gray-400
                                   outline-none
                                   transition-all
                                   focus:bg-white
                                   focus:border-[#0A4D8C]
                                   focus:ring-4
                                   focus:ring-blue-100"
                            required
                        >


                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute
                                   right-4
                                   top-1/2
                                   -translate-y-1/2
                                   text-gray-400
                                   hover:text-[#0A4D8C]
                                   transition"
                            aria-label="Show password"
                        >

                            <span
                                id="passwordIcon"
                                class="material-symbols-outlined"
                            >
                                visibility
                            </span>

                        </button>

                    </div>

                </div>


                {{-- REMEMBER ME --}}

                <div>

                    <label
                        class="flex
                               items-center
                               gap-3
                               cursor-pointer
                               select-none"
                    >

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="w-4
                                   h-4
                                   rounded
                                   border-gray-300
                                   text-[#0A4D8C]
                                   focus:ring-[#0A4D8C]"
                        >

                        <span class="text-sm text-gray-600">
                            Remember me
                        </span>

                    </label>

                </div>


                {{-- SIGN IN --}}

                <button
                    type="submit"
                    class="group
                           w-full
                           h-14
                           rounded-xl
                           bg-[#0A4D8C]
                           hover:bg-[#083A69]
                           active:scale-[0.99]
                           text-white
                           font-semibold
                           shadow-lg
                           shadow-blue-900/20
                           hover:shadow-xl
                           transition-all
                           duration-200"
                >

                    <span
                        class="flex
                               items-center
                               justify-center
                               gap-2"
                    >

                        <span
                            class="material-symbols-outlined
                                   text-[21px]
                                   group-hover:translate-x-1
                                   transition-transform"
                        >
                            login
                        </span>

                        Sign In

                    </span>

                </button>

            </form>


            {{-- Divider --}}

            <div class="flex items-center gap-4 my-7">

                <div class="flex-1 h-px bg-gray-200"></div>

                <span class="text-xs text-gray-400">
                    CARRYON
                </span>

                <div class="flex-1 h-px bg-gray-200"></div>

            </div>


            {{-- Security --}}

            <div
                class="flex
                       items-center
                       justify-center
                       gap-2
                       text-gray-400"
            >

                <span
                    class="material-symbols-outlined text-[17px]"
                >
                    verified_user
                </span>

                <p class="text-xs">
                    Secure academic account access
                </p>

            </div>

        </div>


        {{-- Footer --}}

        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} CarryOn Academic Project Management System
        </p>

    </div>

</div>
```

</div>

{{-- =============================================================
PASSWORD TOGGLE
============================================================= --}}

<script>

function togglePassword() {

    const passwordInput = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');

    if (passwordInput.type === 'password') {

        passwordInput.type = 'text';

        passwordIcon.textContent = 'visibility_off';

    } else {

        passwordInput.type = 'password';

        passwordIcon.textContent = 'visibility';

    }

}

</script>

</body>
</html>
