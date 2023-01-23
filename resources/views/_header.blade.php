<header class="bg-white border-b z-30 fixed w-full top-0 h-16">
    <div class="flex items-center justify-between px-5 py-3">
        <section class="flex items-center space-x-5">
            <div id="toggle" class="p-1 rounded-full hover:bg-gray-100 cursor-pointer">
                <svg id="close" style="display: none" class="w-6 h-6 text-blue-900 hover:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>

                <svg id="open" class="w-6 h-6 text-blue-900 hover:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </div>

            <a href="{{ route('administrators.index') }}" class="font-daysone text-lg tracking-wider" style="font-weight: bold">
                <span class="text-orange-500">FYIRE</span><span class="text-blue-900">MATE</span>
            </a>
        </section>

        <section id="dropdown-container" class="relative font-montserrat text-slate-700">
            <button id="options" class="flex items-center space-x-1">
                <span class="text-sm">{{ \Illuminate\Support\Facades\Auth::user()->firstname }}</span>

                <svg class="w-4 h-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            <div id="option-items"
                 class="absolute text-sm bg-white border right-0 mr-1.5 mt-1 rounded shadow"
                 style="display: none"
            >
                <ul class="w-20 text-right">
                    <li id="logout" class="pr-4 py-1 hover:bg-gray-100 cursor-pointer">
                        <span>Log out</span>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</header>
