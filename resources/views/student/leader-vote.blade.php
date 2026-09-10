@extends('layouts.student')

@section('title', 'Group Leader Voting')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Group Leader Voting
        </h1>

        <p class="text-gray-500 mt-1">
            Choose one member of your group to become the group leader.
        </p>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200
                    text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200
                    text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif


    {{-- Leader Already Selected --}}
    @if($leader)

        <div class="bg-green-50 border border-green-200
                    rounded-xl p-6">

            <h2 class="text-xl font-bold text-green-800">
                Group Leader Selected
            </h2>

            <p class="mt-2 text-green-700">
                Your group leader is:
            </p>

            <div class="mt-4 bg-white rounded-lg p-4 border">

                <p class="font-bold text-gray-800">
                    {{ $leader->name }}
                </p>

                <p class="text-sm text-gray-500">
                    {{ $leader->student_id }}
                </p>

            </div>

        </div>

    @else

        {{-- Voting Form --}}
        <div class="bg-white rounded-xl border shadow-sm">

            <div class="p-6 border-b">

                <h2 class="text-xl font-bold text-gray-800">
                    {{ $group->name }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Select your preferred group leader.
                </p>

            </div>


            <form method="POST"
                  action="{{ route(
                      'student.vote.store',
                      request()->route('classId')
                  ) }}"
                  class="p-6">

                @csrf


                <div class="space-y-3">

                    @foreach($group->students as $member)

                        <label
                            class="flex items-center gap-4
                                   border rounded-xl p-4
                                   cursor-pointer
                                   hover:bg-blue-50">

                            <input
                                type="radio"
                                name="candidate_id"
                                value="{{ $member->id }}"
                                class="w-5 h-5"

                                {{ $existingVote?->candidate_id == $member->id
                                    ? 'checked'
                                    : '' }}
                            >

                            <div>

                                <p class="font-semibold text-gray-800">
                                    {{ $member->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $member->student_id }}
                                </p>

                            </div>

                        </label>

                    @endforeach

                </div>


                <button
                    type="submit"
                    class="mt-6 w-full bg-blue-600 text-white
                           py-3 rounded-lg font-semibold
                           hover:bg-blue-700">

                    {{ $existingVote
                        ? 'Update My Vote'
                        : 'Submit Vote' }}

                </button>

            </form>

        </div>

    @endif

</div>

@endsection