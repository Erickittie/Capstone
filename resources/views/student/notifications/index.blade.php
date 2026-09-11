@extends('layouts.student')

@section('content')

<div class="max-w-4xl mx-auto">

```
{{-- =========================================================
     BACK BUTTON
========================================================== --}}

<div class="mb-5">

    <a
        href="{{ route('student.dashboard') }}"
        class="inline-flex items-center gap-2
               px-4 py-2
               bg-white
               border border-gray-200
               text-gray-700
               rounded-lg
               hover:bg-gray-50
               hover:text-blue-600
               transition
               shadow-sm"
    >

        <span class="text-lg">
            ←
        </span>

        <span class="font-medium">
            Back
        </span>

    </a>

</div>


{{-- =========================================================
     HEADER
========================================================== --}}

<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-2xl font-bold text-gray-800">
            Notifications
        </h1>

        <p class="text-gray-500 mt-1">
            Stay updated with your task submissions and group activities.
        </p>

    </div>


    {{-- =====================================================
         MARK ALL AS READ
    ====================================================== --}}

    @if($notifications->where('is_read', false)->count() > 0)

        <form
            method="POST"
            action="{{ route('student.notifications.readAll') }}"
        >

            @csrf

            <button
                type="submit"
                class="px-4 py-2
                       bg-blue-600
                       text-white
                       rounded-lg
                       hover:bg-blue-700
                       transition
                       shadow-sm"
            >
                Mark All as Read
            </button>

        </form>

    @endif

</div>


{{-- =========================================================
     SUCCESS MESSAGE
========================================================== --}}

@if(session('success'))

    <div
        class="mb-5
               p-4
               bg-green-100
               border border-green-200
               text-green-700
               rounded-lg"
    >
        {{ session('success') }}
    </div>

@endif


{{-- =========================================================
     NOTIFICATIONS LIST
========================================================== --}}

<div class="space-y-3">

    @forelse($notifications as $notification)

        <div
            class="border
                   rounded-xl
                   p-5
                   {{ $notification->is_read
                       ? 'bg-white border-gray-200'
                       : 'bg-blue-50 border-blue-200' }}"
        >

            <div class="flex items-start justify-between gap-4">

                {{-- =================================================
                     NOTIFICATION CONTENT
                ================================================== --}}

                <div class="flex-1">

                    <div class="flex items-center gap-2">

                        <h2 class="font-semibold text-gray-800">
                            {{ $notification->title }}
                        </h2>


                        @if(!$notification->is_read)

                            <span
                                class="px-2 py-1
                                       text-xs
                                       bg-blue-600
                                       text-white
                                       rounded-full"
                            >
                                New
                            </span>

                        @endif

                    </div>


                    <p class="text-gray-600 mt-2">
                        {{ $notification->message }}
                    </p>


                    <p class="text-xs text-gray-400 mt-3">

                        {{ $notification->created_at
                            ->format('M d, Y h:i A') }}

                    </p>

                </div>


                {{-- =================================================
                     ACTION BUTTON
                ================================================== --}}

                @if($notification->task_id)

                    <form
                        method="POST"
                        action="{{ route(
                            'student.notifications.read',
                            $notification->id
                        ) }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="px-4 py-2
                                   text-sm
                                   bg-gray-800
                                   text-white
                                   rounded-lg
                                   hover:bg-gray-900
                                   transition
                                   whitespace-nowrap"
                        >
                            View Task
                        </button>

                    </form>


                @elseif(!$notification->is_read)

                    <form
                        method="POST"
                        action="{{ route(
                            'student.notifications.read',
                            $notification->id
                        ) }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="px-4 py-2
                                   text-sm
                                   bg-gray-800
                                   text-white
                                   rounded-lg
                                   hover:bg-gray-900
                                   transition
                                   whitespace-nowrap"
                        >
                            Mark as Read
                        </button>

                    </form>

                @endif

            </div>

        </div>

    @empty

        {{-- =====================================================
             NO NOTIFICATIONS
        ====================================================== --}}

        <div
            class="text-center
                   py-16
                   bg-white
                   border
                   rounded-xl"
        >

            <div class="text-5xl mb-4">
                🔔
            </div>


            <h2 class="text-lg font-semibold text-gray-700">
                No notifications
            </h2>


            <p class="text-gray-500 mt-1">
                You're all caught up!
            </p>

        </div>

    @endforelse

</div>
```

</div>

@endsection
