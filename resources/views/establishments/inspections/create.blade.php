<x-layout>
    @include('_header')
    @include('_side-nav')

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">INSPECTION ORDERS</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div class="w-11/12 mx-auto my-3 border-b border-gray-300 pb-2">
            <div class="font-montserrat flex justify-between">
                <div>
                    <h2 class="font-montserrat px-5 text-center flex justify-center space-x-2 items-center">
                        <span class="text-sm text-slate-600">[{{ $establishment->fsic }}]</span>
                        <span class="font-semibold text-blue-900">{{ $establishment->name }}</span>
                    </h2>
                </div>

                <a href="{{ route('establishments.inspections.create', $establishment->id) }}" class="text-blue-600 border-2 border-blue-600 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                    </svg>


                    <span>Create Inspection Order</span>
                </a>
            </div>
        </div>

        <x-containers.content class="mb-5">
            <div>
                <h2 class="font-montserrat px-5 py-5 border-b text-center">
                    <span class="font-semibold text-blue-900">CREATE INSPECTION ORDER</span>
                </h2>
            </div>

            <div class="font-montserrat mt-5 px-5 pb-5 flex flex-wrap gap-5">
                <div class="w-1/2">
                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Date</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="date" type="date" id="input-group-1" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{ old('date') }}" form="create-establishment" required>
                            @error('date')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Inspection Order #</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                            </div>
                            <input name="io_number" type="text" id="input-group-1" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Inspection Order #" value="{{ old('io_number') ?? $io_prefix->value . '-' }}" form="create-establishment">
                            @error('io_number')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex-none">
                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Date</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="date" type="date" id="input-group-1" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{ old('date') }}" form="create-establishment" required>
                            @error('date')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="font-montserrat px-5 pb-5 flex gap-5">--}}
{{--                <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">TO</label>--}}
{{--            </div>--}}
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

<script>
    window.onload = function () {
        const selectedInspector = document.getElementById('selected-inspector');
        const addInspector = document.getElementById('add-inspector');
        const to = document.querySelector('[name="to"]')

        addInspector.disabled = true;

        function setInspector(e) {
            selectedInspector.innerText = e.innerText;
            addInspector.disabled = false;
        }

        addInspector.addEventListener('click', () => {

            let finalValue;

            if (to.value === '') {
                to.value = selectedInspector.innerText;
            } else {
                to.value += ', ' + selectedInspector.innerText;
            }
    }
</script>
