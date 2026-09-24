<header
    class="
        fixed
        top-0
        left-[260px]
        right-0
        z-30
        h-20
        bg-white
        border-b
        border-gray-200/80
        px-8
        flex
        items-center
        justify-between
        select-none
    "
>

    <!-- =====================================================
         LEFT HEADER INFO
    ====================================================== -->

    <div>

        <h2 class="text-base font-bold text-gray-900">
            Student Portal
        </h2>

        <p class="text-xs text-gray-500">
            Manage your classes, tasks, and group collaboration
        </p>

    </div>


    <!-- =====================================================
         RIGHT SIDE
    ====================================================== -->

    <div class="flex items-center gap-5 select-none">


        <!-- =================================================
             NOTIFICATION BELL
        ================================================== -->

        @php
            $unreadNotifications = \App\Models\Student\Notification::where(
                'user_id',
                Auth::id()
            )
            ->where('is_read', false)
            ->count();
        @endphp


        <a
            href="{{ route('student.notifications.index') }}"
            class="
                relative
                w-10
                h-10
                flex
                items-center
                justify-center
                rounded-xl
                text-gray-500
                hover:bg-gray-100
                hover:text-gray-900
                transition
            "
            title="Notifications"
        >

            <span class="material-symbols-outlined text-[24px]">
                notifications
            </span>


            <!-- UNREAD COUNT -->

            @if($unreadNotifications > 0)

                <span
                    class="
                        absolute
                        -top-1
                        -right-1
                        min-w-[19px]
                        h-[19px]
                        px-1
                        flex
                        items-center
                        justify-center
                        bg-red-500
                        text-white
                        text-[10px]
                        font-bold
                        rounded-full
                        border-2
                        border-white
                    "
                >
                    {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                </span>

            @endif

        </a>


        <!-- =================================================
             DIVIDER
        ================================================== -->

        <div class="h-8 w-px bg-gray-200"></div>


        <!-- =================================================
             PROFILE
        ================================================== -->

        <div class="flex items-center gap-3">

            <div class="text-right hidden sm:block">

                <p class="text-sm font-bold text-gray-900 leading-tight">
                    {{ Auth::user()->name ?? 'Student' }}
                </p>

                <p class="text-xs text-gray-500 font-medium">
                    {{ Auth::user()->role ?? 'Student' }}
                </p>

            </div>


            <!-- PROFILE INITIAL -->

            <div
                class="
                    w-10
                    h-10
                    rounded-full
                    bg-blue-100
                    text-blue-700
                    font-bold
                    text-sm
                    flex
                    items-center
                    justify-center
                    border
                    border-blue-200
                    shadow-sm
                "
            >

                {{ strtoupper(
                    substr(
                        Auth::user()->name ?? 'S',
                        0,
                        1
                    )
                ) }}

            </div>

        </div>

    </div>

</header>