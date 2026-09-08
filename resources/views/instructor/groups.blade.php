```blade
@extends('layouts.instructor')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="flex items-center gap-4 mb-8">

        <a
            href="{{ route('instructor.class.configure', $class->id) }}"
            class="w-10 h-10 flex items-center justify-center
                   rounded-lg border border-gray-200 bg-white
                   text-gray-500 hover:text-blue-600
                   hover:border-blue-300 transition"
        >
            ←
        </a>

        <div>

            <h1 class="text-3xl font-bold text-gray-900">
                Student Groups
            </h1>

            <p class="text-gray-500 mt-1">
                {{ $class->course_code }} -
                {{ $class->course_name }}
            </p>

        </div>

    </div>


    {{-- =====================================================
        SUCCESS MESSAGE
    ====================================================== --}}

    @if(session('success'))

        <div
            class="mb-6 rounded-xl
                   border border-green-200
                   bg-green-50
                   px-5 py-4"
        >

            <div class="flex items-center gap-3">

                <span class="text-xl">
                    ✅
                </span>

                <p class="font-semibold text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- =====================================================
        ERROR MESSAGE
    ====================================================== --}}

    @if($errors->any())

        <div
            class="mb-6 rounded-xl
                   border border-red-200
                   bg-red-50
                   px-5 py-4"
        >

            <p class="font-semibold text-red-800">
                Please check the following:
            </p>

            <ul
                class="mt-2 text-sm
                       text-red-700
                       list-disc list-inside"
            >

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
        CLASS SUMMARY
    ====================================================== --}}

    <div
        class="bg-white rounded-2xl
               border border-gray-200
               p-6 mb-8"
    >

        <div
            class="flex flex-col md:flex-row
                   md:items-center
                   md:justify-between
                   gap-4"
        >

            <div>

                <span
                    class="inline-block
                           px-3 py-1.5
                           rounded-full
                           bg-blue-100
                           text-blue-700
                           text-xs font-bold"
                >
                    {{ $class->course_code }}
                </span>

                <h2 class="text-xl font-bold text-gray-900 mt-3">
                    {{ $class->course_name }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Section: {{ $class->section }}
                </p>

            </div>


            <div class="flex gap-3">

                <div
                    class="px-4 py-3
                           bg-blue-50
                           rounded-xl
                           text-center"
                >

                    <p class="text-2xl font-bold text-blue-700">
                        {{ $class->students->count() }}
                    </p>

                    <p class="text-xs text-blue-600">
                        Students
                    </p>

                </div>


                <div
                    class="px-4 py-3
                           bg-purple-50
                           rounded-xl
                           text-center"
                >

                    <p
                        id="groupCountDisplay"
                        class="text-2xl font-bold
                               text-purple-700"
                    >
                        {{ $class->groups->count() }}
                    </p>

                    <p class="text-xs text-purple-600">
                        Groups
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        GROUPING METHOD
    ====================================================== --}}

    <div
        class="bg-white rounded-2xl
               border border-gray-200
               p-6 mb-8"
    >

        <h2 class="text-xl font-bold text-gray-900">
            Grouping Method
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Choose how students should be assigned to groups.
        </p>


        <div
            class="grid grid-cols-1
                   md:grid-cols-2
                   gap-5 mt-6"
        >

            {{-- MANUAL --}}
            <button
                type="button"
                onclick="showManual()"
                id="manualButton"
                class="text-left
                       border-2 border-purple-500
                       bg-purple-50
                       rounded-xl
                       p-6
                       transition"
            >

                <div class="text-3xl mb-3">
                    ✋
                </div>

                <h3 class="font-bold text-lg text-gray-900">
                    Manual Grouping
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Drag and drop students into groups manually.
                </p>

            </button>


            {{-- AUTOMATIC --}}
            <button
                type="button"
                onclick="showAutomatic()"
                id="automaticButton"
                class="text-left
                       border-2 border-gray-200
                       bg-white
                       rounded-xl
                       p-6
                       transition"
            >

                <div class="text-3xl mb-3">
                    ⚡
                </div>

                <h3 class="font-bold text-lg text-gray-900">
                    Automatic Grouping
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Let the system distribute students automatically.
                </p>

            </button>

        </div>

    </div>


    {{-- =====================================================
        MANUAL GROUPING SECTION
    ====================================================== --}}

    <div id="manualSection">

        <form
            method="POST"
            action="{{ route(
                'instructor.class.groups.manual',
                $class->id
            ) }}"
            id="manualForm"
        >

            @csrf


            <div
                class="grid grid-cols-1
                       lg:grid-cols-4
                       gap-6"
            >

                {{-- AVAILABLE STUDENTS --}}
                <div
                    class="bg-white rounded-2xl
                           border border-gray-200
                           p-5"
                >

                    <div class="mb-4">

                        <h2 class="font-bold text-lg text-gray-900">
                            Available Students
                        </h2>

                        <p class="text-xs text-gray-500 mt-1">
                            Drag students into a group.
                        </p>

                    </div>


                    <div
                        id="availableStudents"
                        class="space-y-3
                               min-h-[300px]
                               rounded-xl
                               p-2"
                    >

                        @php
                            $assignedStudentIds = $class->groups
                                ->flatMap(function ($group) {
                                    return $group->students
                                        ->pluck('id');
                                })
                                ->toArray();
                        @endphp


                        @foreach($class->students as $student)

                            @if(!in_array(
                                $student->id,
                                $assignedStudentIds
                            ))

                                <div
                                    draggable="true"
                                    data-student-id="{{ $student->id }}"
                                    class="student-card
                                           bg-gray-50
                                           border
                                           border-gray-200
                                           rounded-xl
                                           p-4
                                           cursor-grab
                                           hover:border-purple-300
                                           hover:shadow
                                           transition"
                                >

                                    <p class="font-semibold text-gray-800">
                                        {{ $student->name }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $student->student_id ?? 'No ID' }}
                                    </p>

                                </div>

                            @endif

                        @endforeach


                        @if($class->students->count() === 0)

                            <div class="text-center py-10">

                                <div class="text-3xl mb-2">
                                    👨‍🎓
                                </div>

                                <p class="text-sm text-gray-500">
                                    No students enrolled.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- GROUPS --}}
                <div class="lg:col-span-3">

                    <div
                        class="flex items-center
                               justify-between mb-4"
                    >

                        <div>

                            <h2 class="text-xl font-bold text-gray-900">
                                Groups
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Drag students between groups.
                            </p>

                        </div>


                        <button
                            type="button"
                            onclick="addGroup()"
                            class="px-4 py-2
                                   bg-purple-600
                                   text-white
                                   rounded-lg
                                   font-semibold
                                   hover:bg-purple-700"
                        >
                            + Add Group
                        </button>

                    </div>


                    <div
                        id="groupsContainer"
                        class="grid grid-cols-1
                               md:grid-cols-2
                               gap-5"
                    >

                        @foreach($class->groups as $group)

                            <div
                                class="group-box
                                       bg-white
                                       border border-gray-200
                                       rounded-2xl
                                       p-5"
                                data-group-index="{{ $loop->index }}"
                            >

                                <div
                                    class="flex items-center
                                           justify-between
                                           mb-4"
                                >

                                    <input
                                        type="text"
                                        name="groups[{{ $loop->index }}][name]"
                                        value="{{ $group->name }}"
                                        class="group-name
                                               font-bold
                                               text-gray-900
                                               border-0
                                               border-b
                                               border-gray-200
                                               focus:ring-0
                                               focus:border-purple-500
                                               w-40"
                                    >


                                    <span
                                        class="member-count
                                               text-xs
                                               bg-purple-50
                                               text-purple-700
                                               px-2 py-1
                                               rounded-full"
                                    >
                                        {{ $group->students->count() }}
                                        members
                                    </span>

                                </div>


                                <div
                                    class="drop-zone
                                           min-h-[180px]
                                           bg-gray-50
                                           rounded-xl
                                           p-3
                                           space-y-3"
                                >

                                    @foreach($group->students as $student)

                                        <div
                                            draggable="true"
                                            data-student-id="{{ $student->id }}"
                                            class="student-card
                                                   bg-white
                                                   border
                                                   border-gray-200
                                                   rounded-xl
                                                   p-4
                                                   cursor-grab
                                                   shadow-sm"
                                        >

                                            <p class="font-semibold text-gray-800">
                                                {{ $student->name }}
                                            </p>

                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $student->student_id ?? 'No ID' }}
                                            </p>

                                        </div>

                                    @endforeach


                                    @if($group->students->count() === 0)

                                        <p
                                            class="empty-message
                                                   text-center
                                                   text-gray-400
                                                   text-sm
                                                   py-10"
                                        >
                                            Drop students here
                                        </p>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>


                    @if($class->groups->count() === 0)

                        <div
                            id="initialMessage"
                            class="bg-white
                                   border border-dashed
                                   border-gray-300
                                   rounded-2xl
                                   p-12
                                   text-center"
                        >

                            <div class="text-4xl mb-3">
                                👥
                            </div>

                            <h3 class="font-bold text-gray-800">
                                No Groups Yet
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Click "Add Group" to create your first group.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- SAVE --}}
            <div class="flex justify-end mt-6">

                <button
                    type="submit"
                    class="px-6 py-3
                           bg-purple-600
                           text-white
                           rounded-xl
                           font-semibold
                           hover:bg-purple-700
                           shadow-sm"
                >
                    Save Groups
                </button>

            </div>

        </form>

    </div>


    {{-- =====================================================
        AUTOMATIC GROUPING SECTION
    ====================================================== --}}

    <div
        id="automaticSection"
        class="hidden"
    >

        <div
            class="bg-white
                   rounded-2xl
                   border border-gray-200
                   p-6"
        >

            <h2 class="text-xl font-bold text-gray-900">
                Automatic Grouping
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                The system will randomly distribute students evenly.
            </p>


            <form
                method="POST"
                action="{{ route(
                    'instructor.class.groups.automatic',
                    $class->id
                ) }}"
                class="mt-6 max-w-md"
            >

                @csrf


                <label
                    class="block text-sm
                           font-semibold
                           text-gray-700
                           mb-2"
                >
                    Number of Groups
                </label>


                <input
                    type="number"
                    name="number_of_groups"
                    min="1"
                    max="{{ max(1, $class->students->count()) }}"
                    value="5"
                    required
                    class="w-full
                           border border-gray-300
                           rounded-xl
                           px-4 py-3
                           focus:ring-2
                           focus:ring-purple-500
                           focus:border-purple-500"
                >


                <p class="text-xs text-gray-500 mt-2">
                    {{ $class->students->count() }}
                    students are currently enrolled.
                </p>


                <button
                    type="submit"
                    class="mt-5
                           px-6 py-3
                           bg-purple-600
                           text-white
                           rounded-xl
                           font-semibold
                           hover:bg-purple-700"
                >
                    ⚡ Generate Groups
                </button>

            </form>

        </div>

    </div>

</div>


{{-- =====================================================
    JAVASCRIPT
====================================================== --}}

<script>

let groupCounter =
    {{ $class->groups->count() }};


/*
|--------------------------------------------------------------------------
| MANUAL / AUTOMATIC SWITCH
|--------------------------------------------------------------------------
*/

function showManual()
{
    document
        .getElementById('manualSection')
        .classList.remove('hidden');

    document
        .getElementById('automaticSection')
        .classList.add('hidden');


    document
        .getElementById('manualButton')
        .classList.add(
            'border-purple-500',
            'bg-purple-50'
        );

    document
        .getElementById('manualButton')
        .classList.remove(
            'border-gray-200',
            'bg-white'
        );


    document
        .getElementById('automaticButton')
        .classList.remove(
            'border-purple-500',
            'bg-purple-50'
        );

    document
        .getElementById('automaticButton')
        .classList.add(
            'border-gray-200',
            'bg-white'
        );
}


function showAutomatic()
{
    document
        .getElementById('manualSection')
        .classList.add('hidden');

    document
        .getElementById('automaticSection')
        .classList.remove('hidden');


    document
        .getElementById('automaticButton')
        .classList.add(
            'border-purple-500',
            'bg-purple-50'
        );

    document
        .getElementById('automaticButton')
        .classList.remove(
            'border-gray-200',
            'bg-white'
        );


    document
        .getElementById('manualButton')
        .classList.remove(
            'border-purple-500',
            'bg-purple-50'
        );

    document
        .getElementById('manualButton')
        .classList.add(
            'border-gray-200',
            'bg-white'
        );
}


/*
|--------------------------------------------------------------------------
| ADD GROUP
|--------------------------------------------------------------------------
*/

function addGroup()
{
    const container =
        document.getElementById('groupsContainer');

    const initialMessage =
        document.getElementById('initialMessage');

    if (initialMessage) {
        initialMessage.remove();
    }


    const index = groupCounter;


    const group =
        document.createElement('div');

    group.className =
        'group-box bg-white border border-gray-200 rounded-2xl p-5';

    group.dataset.groupIndex = index;


    group.innerHTML = `

        <div
            class="flex items-center
                   justify-between
                   mb-4"
        >

            <input
                type="text"
                name="groups[${index}][name]"
                value="Group ${index + 1}"
                class="group-name
                       font-bold
                       text-gray-900
                       border-0
                       border-b
                       border-gray-200
                       focus:ring-0
                       focus:border-purple-500
                       w-40"
            >

            <span
                class="member-count
                       text-xs
                       bg-purple-50
                       text-purple-700
                       px-2 py-1
                       rounded-full"
            >
                0 members
            </span>

        </div>


        <div
            class="drop-zone
                   min-h-[180px]
                   bg-gray-50
                   rounded-xl
                   p-3
                   space-y-3"
        >

            <p
                class="empty-message
                       text-center
                       text-gray-400
                       text-sm
                       py-10"
            >
                Drop students here
            </p>

        </div>
    `;


    container.appendChild(group);

    groupCounter++;

    initializeDragAndDrop();

    updateCounts();
}


/*
|--------------------------------------------------------------------------
| DRAG AND DROP
|--------------------------------------------------------------------------
*/

let draggedStudent = null;


function initializeDragAndDrop()
{
    const students =
        document.querySelectorAll(
            '.student-card'
        );


    students.forEach(student => {

        student.addEventListener(
            'dragstart',
            function() {

                draggedStudent = this;

                this.classList.add(
                    'opacity-50'
                );

            }
        );


        student.addEventListener(
            'dragend',
            function() {

                this.classList.remove(
                    'opacity-50'
                );

            }
        );

    });


    const zones =
        document.querySelectorAll(
            '.drop-zone, #availableStudents'
        );


    zones.forEach(zone => {

        zone.addEventListener(
            'dragover',
            function(event) {

                event.preventDefault();

                this.classList.add(
                    'ring-2',
                    'ring-purple-300'
                );

            }
        );


        zone.addEventListener(
            'dragleave',
            function() {

                this.classList.remove(
                    'ring-2',
                    'ring-purple-300'
                );

            }
        );


        zone.addEventListener(
            'drop',
            function(event) {

                event.preventDefault();

                this.classList.remove(
                    'ring-2',
                    'ring-purple-300'
                );


                if (!draggedStudent) {
                    return;
                }


                const emptyMessage =
                    this.querySelector(
                        '.empty-message'
                    );


                if (emptyMessage) {
                    emptyMessage.remove();
                }


                this.appendChild(
                    draggedStudent
                );


                updateCounts();

            }
        );

    });
}


/*
|--------------------------------------------------------------------------
| UPDATE MEMBER COUNTS
|--------------------------------------------------------------------------
*/

function updateCounts()
{
    const groups =
        document.querySelectorAll(
            '.group-box'
        );


    groups.forEach(group => {

        const zone =
            group.querySelector(
                '.drop-zone'
            );


        const count =
            zone.querySelectorAll(
                '.student-card'
            ).length;


        const counter =
            group.querySelector(
                '.member-count'
            );


        counter.textContent =
            count + (
                count === 1
                    ? ' member'
                    : ' members'
            );


        if (count === 0) {

            if (!zone.querySelector(
                '.empty-message'
            )) {

                const message =
                    document.createElement(
                        'p'
                    );

                message.className =
                    'empty-message text-center text-gray-400 text-sm py-10';

                message.textContent =
                    'Drop students here';

                zone.appendChild(message);
            }

        }

    });


    const totalGroups =
        document.querySelectorAll(
            '.group-box'
        ).length;


    document
        .getElementById(
            'groupCountDisplay'
        )
        .textContent = totalGroups;
}


/*
|--------------------------------------------------------------------------
| BEFORE SUBMIT
|--------------------------------------------------------------------------
*/

document
    .getElementById('manualForm')
    .addEventListener(
        'submit',
        function()
        {
            const groups =
                document.querySelectorAll(
                    '.group-box'
                );


            groups.forEach(
                function(group, groupIndex)
                {

                    const students =
                        group.querySelectorAll(
                            '.student-card'
                        );


                    students.forEach(
                        function(student)
                        {

                            const input =
                                document.createElement(
                                    'input'
                                );


                            input.type =
                                'hidden';

                            input.name =
                                `groups[${groupIndex}][students][]`;

                            input.value =
                                student.dataset.studentId;


                            document
                                .getElementById(
                                    'manualForm'
                                )
                                .appendChild(
                                    input
                                );

                        }
                    );

                }
            );
        }
    );


/*
|--------------------------------------------------------------------------
| INITIALIZE
|--------------------------------------------------------------------------
*/

initializeDragAndDrop();

updateCounts();

</script>

@endsection
```
