@extends('layouts.student')

@section('content')

<div class="max-w-4xl mx-auto">

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

        {{-- MARK ALL AS READ --}}
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
    <div class="space-y-4">

        @forelse($notifications as $notification)

            <div class="border rounded-xl p-5 transition-all {{ $notification->is_read ? 'bg-white border-gray-200 shadow-sm' : 'bg-blue-50/60 border-blue-200 shadow-sm' }}">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    
                    {{-- Notification Content --}}
                    <div class="space-y-1 flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h2 class="font-bold text-gray-900 text-sm">
                                {{ $notification->title }}
                            </h2>

                            @if(!$notification->is_read)
                                <span class="px-2 py-0.5 text-[10px] font-semibold bg-blue-600 text-white rounded-full uppercase tracking-wider">
                                    New
                                </span>
                            @endif
                        </div>

                        <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                            {{ $notification->message }}
                        </p>

                        <p class="text-[11px] text-gray-400 pt-1">
                            {{ $notification->created_at->format('M d, Y h:i A') }}
                        </p>
                    </div>

                    {{-- Action Buttons (View Task & Remove) --}}
                    <div class="flex items-center gap-2 flex-shrink-0 self-start sm:self-center">
                        
                        {{-- View Task Button --}}
                        @php
                            $classId = $notification->class_room_id ?? optional(optional(optional($notification->task)->project)->class_room) ? optional(optional($notification->task)->project)->class_room_id : 1;
                            $projectId = $notification->project_id ?? optional($notification->task)->project_id ?? 1;
                            $taskId = $notification->task_id ?? optional($notification->task)->id;
                        @endphp

                        @if($taskId)
                            <a
                                href="{{ route('student.tasks.show', ['classId' => $classId, 'projectId' => $projectId, 'taskId' => $taskId]) }}"
                                class="px-3.5 py-2 bg-gray-900 text-white rounded-lg text-xs font-semibold hover:bg-gray-800 transition shadow-sm whitespace-nowrap"
                            >
                                View Task
                            </a>
                        @endif

                        {{-- Remove / Delete Button --}}
                        <form action="{{ route('student.notifications.destroy', $notification->id) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="p-2 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition border border-gray-200 sm:border-0"
                                title="Remove notification"
                            >
                                <span class="material-symbols-outlined text-[18px] block">
                                    close
                                </span>
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        @empty

            {{-- No Notifications State --}}
            <div class="text-center py-16 bg-white border border-gray-200 rounded-xl">
                <div class="text-4xl mb-3">🔔</div>
                <h2 class="text-base font-bold text-gray-800">No notifications</h2>
                <p class="text-xs text-gray-500 mt-1">You're all caught up!</p>
            </div>

        @endforelse

    </div>

</div>

@endsection