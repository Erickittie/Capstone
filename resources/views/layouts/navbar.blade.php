<header class="bg-white shadow px-8 py-4 flex justify-between items-center">

    <div>

        <h2 class="text-2xl font-bold">

            CarryOn Admin Portal

        </h2>

    </div>

    <div class="flex items-center gap-4">

        <span>

            {{ Auth::user()->name ?? 'Administrator' }}

        </span>

        <img
            src="https://ui-avatars.com/api/?name=Admin"
            class="w-10 h-10 rounded-full">

    </div>

</header>