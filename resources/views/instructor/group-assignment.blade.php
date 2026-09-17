@extends('layouts.instructor')

@section('title', 'Student Group Assignment')

@section('content')

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Student Group Assignment</h1>
            <p class="text-gray-500 text-sm mt-0.5">Organize student teams manually via drag-and-drop or automatically using random allocation.</p>
        </div>

        <!-- Random Allocate Controls -->
        <div class="flex flex-wrap items-center gap-3.5 bg-white border border-gray-200 p-3 rounded-2xl shadow-xs">
            <div class="flex items-center gap-2">
                <label for="groups-count" class="text-[12px] font-bold text-gray-500 uppercase tracking-wider">Groups:</label>
                <input type="number" id="groups-count" value="3" min="2" max="6" class="w-14 border border-gray-200 rounded-lg text-sm py-1 px-2 focus:outline-none focus:ring-1 focus:ring-gray-900 focus:border-gray-900">
            </div>
            <button id="randomize-btn" class="px-4 py-1.5 bg-gray-900 hover:bg-gray-800 text-white rounded-lg text-sm font-semibold transition flex items-center gap-1.5 shadow-xs">
                <span class="material-symbols-outlined text-[16px]">shuffle</span>
                <span>Auto Allocate</span>
            </button>
            <button id="reset-btn" class="px-4 py-1.5 border border-gray-200 hover:bg-gray-50 text-gray-700 rounded-lg text-sm font-semibold transition">
                Reset Board
            </button>
        </div>
    </div>

    <!-- Drag-and-Drop Board Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 min-h-[500px]">

        <!-- Left Column: Unassigned Students Pool -->
        <div class="lg:col-span-1 bg-white border border-gray-200 rounded-2xl shadow-xs flex flex-col h-[580px] lg:h-auto overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between flex-shrink-0">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Unassigned Pool</h3>
                <span id="unassigned-count" class="px-2.5 py-0.5 text-xs font-bold bg-gray-100 text-gray-700 rounded-full">5</span>
            </div>
            <div id="unassigned-container" class="p-4 space-y-3 overflow-y-auto flex-1 border-dashed border-2 border-transparent transition" dropzone="true">
                <div id="student-1" draggable="true" class="bg-white border border-gray-200 rounded-xl p-3 shadow-xs hover:border-gray-900 cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-400 text-[20px] flex-shrink-0">drag_indicator</span>
                    <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-xs flex-shrink-0">LC</div>
                    <div class="overflow-hidden">
                        <span class="font-semibold text-gray-900 block leading-tight text-sm truncate">Liam Chen</span>
                        <span class="text-xs text-gray-400 block truncate">l.chen@institution.edu</span>
                    </div>
                </div>
                <div id="student-2" draggable="true" class="bg-white border border-gray-200 rounded-xl p-3 shadow-xs hover:border-gray-900 cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-400 text-[20px] flex-shrink-0">drag_indicator</span>
                    <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs flex-shrink-0">SM</div>
                    <div class="overflow-hidden">
                        <span class="font-semibold text-gray-900 block leading-tight text-sm truncate">Sarah Miller</span>
                        <span class="text-xs text-gray-400 block truncate">s.miller@institution.edu</span>
                    </div>
                </div>
                <div id="student-3" draggable="true" class="bg-white border border-gray-200 rounded-xl p-3 shadow-xs hover:border-gray-900 cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-400 text-[20px] flex-shrink-0">drag_indicator</span>
                    <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-700 flex items-center justify-center font-bold text-xs flex-shrink-0">EW</div>
                    <div class="overflow-hidden">
                        <span class="font-semibold text-gray-900 block leading-tight text-sm truncate">Emma Wilson</span>
                        <span class="text-xs text-gray-400 block truncate">e.wilson@institution.edu</span>
                    </div>
                </div>
                <div id="student-4" draggable="true" class="bg-white border border-gray-200 rounded-xl p-3 shadow-xs hover:border-gray-900 cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-400 text-[20px] flex-shrink-0">drag_indicator</span>
                    <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-700 flex items-center justify-center font-bold text-xs flex-shrink-0">MA</div>
                    <div class="overflow-hidden">
                        <span class="font-semibold text-gray-900 block leading-tight text-sm truncate">Marcus Aurelius</span>
                        <span class="text-xs text-gray-400 block truncate">m.aurelius@institution.edu</span>
                    </div>
                </div>
                <div id="student-5" draggable="true" class="bg-white border border-gray-200 rounded-xl p-3 shadow-xs hover:border-gray-900 cursor-grab active:cursor-grabbing transition-all select-none flex items-center gap-3">
                    <span class="material-symbols-outlined text-gray-400 text-[20px] flex-shrink-0">drag_indicator</span>
                    <div class="w-8 h-8 rounded-full bg-pink-50 text-pink-700 flex items-center justify-center font-bold text-xs flex-shrink-0">SR</div>
                    <div class="overflow-hidden">
                        <span class="font-semibold text-gray-900 block leading-tight text-sm truncate">Sophia Reynolds</span>
                        <span class="text-xs text-gray-400 block truncate">s.reynolds@institution.edu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Group Bins -->
        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
            <!-- Group 1 -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-xs flex flex-col min-h-[350px] overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between flex-shrink-0 bg-gray-50/50">
                    <span class="font-semibold text-gray-900 text-sm">Group Alpha</span>
                    <span class="group-count text-xs font-bold text-gray-500">0 students</span>
                </div>
                <div class="group-bin p-4 space-y-3 flex-1 border-2 border-dashed border-transparent transition bg-gray-50/20" dropzone="true" id="group-1"></div>
            </div>
            <!-- Group 2 -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-xs flex flex-col min-h-[350px] overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between flex-shrink-0 bg-gray-50/50">
                    <span class="font-semibold text-gray-900 text-sm">Group Beta</span>
                    <span class="group-count text-xs font-bold text-gray-500">0 students</span>
                </div>
                <div class="group-bin p-4 space-y-3 flex-1 border-2 border-dashed border-transparent transition bg-gray-50/20" dropzone="true" id="group-2"></div>
            </div>
            <!-- Group 3 -->
            <div class="bg-white border border-gray-200 rounded-2xl shadow-xs flex flex-col min-h-[350px] overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between flex-shrink-0 bg-gray-50/50">
                    <span class="font-semibold text-gray-900 text-sm">Group Gamma</span>
                    <span class="group-count text-xs font-bold text-gray-500">0 students</span>
                </div>
                <div class="group-bin p-4 space-y-3 flex-1 border-2 border-dashed border-transparent transition bg-gray-50/20" dropzone="true" id="group-3"></div>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    // HTML5 Drag and Drop
    const draggableCards = document.querySelectorAll('[draggable="true"]');
    const dropBins = document.querySelectorAll('[dropzone="true"]');
    const unassignedContainer = document.getElementById('unassigned-container');
    let draggedCard = null;

    draggableCards.forEach(card => {
        card.addEventListener('dragstart', (e) => {
            draggedCard = card;
            card.style.opacity = '0.5';
            e.dataTransfer.setData('text/plain', card.id);
        });
        card.addEventListener('dragend', () => {
            card.style.opacity = '1';
            draggedCard = null;
            updateCounters();
        });
    });

    dropBins.forEach(bin => {
        bin.addEventListener('dragover', (e) => { e.preventDefault(); bin.classList.add('border-blue-300', 'bg-blue-50/30'); });
        bin.addEventListener('dragleave', () => { bin.classList.remove('border-blue-300', 'bg-blue-50/30'); });
        bin.addEventListener('drop', (e) => {
            e.preventDefault();
            bin.classList.remove('border-blue-300', 'bg-blue-50/30');
            if (draggedCard) { bin.appendChild(draggedCard); updateCounters(); }
        });
    });

    function updateCounters() {
        document.getElementById('unassigned-count').innerText = unassignedContainer.querySelectorAll('[draggable="true"]').length;
        ['group-1', 'group-2', 'group-3'].forEach(gId => {
            const bin = document.getElementById(gId);
            const count = bin.querySelectorAll('[draggable="true"]').length;
            bin.parentElement.querySelector('.group-count').innerText = `${count} student${count === 1 ? '' : 's'}`;
        });
    }

    document.getElementById('randomize-btn').addEventListener('click', () => {
        const allCards = Array.from(document.querySelectorAll('[draggable="true"]'));
        const bins = ['group-1', 'group-2', 'group-3'].map(id => document.getElementById(id));
        allCards.forEach((card, i) => bins[i % bins.length].appendChild(card));
        updateCounters();
    });

    document.getElementById('reset-btn').addEventListener('click', () => {
        document.querySelectorAll('[draggable="true"]').forEach(card => unassignedContainer.appendChild(card));
        updateCounters();
    });

    updateCounters();
</script>
@endsection
