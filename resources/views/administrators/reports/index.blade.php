<x-layout>
    @include('_header')
    @include('_side-nav')

    <section id="loading">
        <div id="loading-content"></div>
    </section>

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">REPORTS</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div class="w-11/12 mx-auto my-3 flex border-b border-gray-300 pb-2">
            <div class="">
                <form action="" method="GET" class="font-montserrat flex space-x-2 items-center text-slate-600">
                    <div>
                        <label for="from" class="text-sm font-semibold">FROM</label>
                        <input name="from" type="date" class="text-sm bg-gray-50 border border-gray-300 rounded-md" value="{{ request('from') }}" required>
                    </div>

                    <div class="">
                        <label for="to" class="text-sm font-semibold">TO</label>
                        <input name="to" type="date" class="text-sm bg-gray-50 border border-gray-300 rounded-md" value="{{ request('to') }}" required>
                    </div>

                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generate Reports</button>
                </form>
            </div>
        </div>

        <x-containers.content>
            @if($establishments)
                @if(count($establishments) != 0)
                    {{ count($establishments) }}
                @endif
            @else
                <div class="p-2">
                    <p class="font-montserrat text-slate-600 text-sm">Set the range of date to generate reports.</p>
                </div>
            @endif
        </x-containers.content>
    </x-containers.main>

    @if(session()->has('success'))
        <div class="mx-auto absolute bottom-0 right-0 mb-5 mr-5 font-opensans">
            <p
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                class="bg-blue-500 text-white py-2 px-4 rounded-xl text-sm flex justify-center text-center
                items-center space-x-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

                <span>{{ session('success') }}</span>
            </p>
        </div>
    @endif
</x-layout>
