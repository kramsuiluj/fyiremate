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
                    <span class="font-semibold text-blue-900">EDIT INSPECTION ORDER RECORD</span>
                </h2>
            </div>

            <div class="font-montserrat mt-5 px-5 flex gap-5">
                <div class="w-1/2">
                    <div>
                        <label for="processed_at" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Date</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="processed_at" type="date" id="processed_at" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{ old('processed_at') ?? $inspection->processed_at }}" form="create-io" required>
                            @error('processed_at')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <div>
                        <label for="io_number" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Inspection Order #</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                            </div>
                            <input name="io_number" type="text" id="io_number" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Inspection Order #" value="{{ old('io_number') ?? $inspection->io_number }}" form="create-io">
                            @error('io_number')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="font-montserrat px-5 flex flex-col gap-1">
                <label for="to" class="block text-sm font-medium text-slate-600 dark:text-white">TO</label>

                <div x-data="{ show: false }" class="flex gap-2">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center flex justify-between items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button"
                        @click="show = !show"
                        style="width: 20rem"
                    >
                        <span id="selected-inspector">Select Inspectors</span>

                        <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div
                        class="z-10 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 absolute mt-12"
                        style="display: none; width: 20rem"
                        x-show="show"
                    >
                        <ul class="text-sm text-gray-700 dark:text-gray-200">
                            @foreach ($inspectors as $inspector)
                                <li class="cursor-pointer">
                                        <span id="inspector-{{$inspector->id}}"
                                              @click="show = false"
                                              onclick="setInspector(document.getElementById('inspector-{{ $inspector->id }}'))"
                                              class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"

                                        >
                                            {{ $inspector->fullname() . ' BFP' }}
                                        </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <input name="to" type="text" class="bg-gray-50 border border-gray-300 rounded-md flex-1 text-sm" form="create-io" value="{{ old('to') ?? $inspection->to }}">

                    <button id="add-inspector" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
                </div>
            </div>

            <div class="font-montserrat mt-5 px-5 flex gap-5">
                <div class="w-1/2">
                    <div>
                        <label for="proceed" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Proceed</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <textarea name="proceed" type="date" id="proceed" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" form="create-io" required style="resize: none; height: 7rem">{{ old('proceed') ?? $inspection->proceed }}</textarea>
                            @error('proceed')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="duration" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Duration</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <textarea name="duration" id="duration" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" form="create-io" required style="resize: none; height: 7rem">{{ old('duration') ?? $inspection->duration }}</textarea>
                            @error('duration')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <div>
                        <label for="purpose" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Purpose</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <textarea name="purpose" id="purpose" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" form="create-io" value="" required style="resize: none; height: 7rem"
                            >{{ old('purpose') ?? $inspection->purpose }}</textarea>
                            @error('purpose')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="remarks" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Remarks or Additional Instruction/s</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <textarea name="remarks" id="remarks" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" form="create-io" required style="resize: none; height: 7rem">{{ old('remarks') ?? $inspection->remarks }}</textarea>
                            @error('remarks')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </x-containers.content>

        <x-containers.content>
            <section class="flex p-5 space-x-4 font-montserrat text-slate-700">
                <div class="w-1/2 space-y-3 flex flex-col">
                    <label for="chief" class="text-blue-900" style="font-weight: 500">RECOMMEND APPROVAL</label>
                    <input type="text" class="border border-gray-300 rounded-md bg-gray-100 text-sm" value="{{ $chief->fullname() }}" disabled>
                    <input type="hidden" name="chief" value="{{ $chief->fullname() }}" form="create-io">
                    <p class="text-sm">CHIEF, Fire Safety Enforcement Section</p>

                    @error('chief')
                    <p class="absolute mt-5 text-xs font-varela text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-1/2 space-y-3 flex flex-col">
                    <label for="chief" class="text-blue-900" style="font-weight: 500">APPROVED</label>
                    <input type="text" class="border border-gray-300 rounded-md bg-gray-100 text-sm" value="{{ $marshal->fullname() }}" disabled>
                    <input type="hidden" name="marshal" value="{{ $marshal->fullname() }}" form="create-io">
                    <p class="text-sm">CITY/MUNICIPAL FIRE MARSHAL</p>
                    @error('marshal')
                    <p class="absolute mt-5 text-xs font-varela text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <div class="px-5 border-t pt-2">
                <button type="submit"
                        form="create-io"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-full font-montserrat"
                >
                    SUBMIT
                </button>
            </div>
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

<form style="display: none" action="{{ route('establishments.inspections.update', [$establishment->id, $inspection->id]) }}" method="POST" id="create-io">
    @csrf
    @method('PATCH')
    <input type="hidden" name="establishment_id" value="{{ $establishment->id }}">
</form>

<script>
    // window.onload = function () {
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

        console.log(to.value.split(',').length >= 3);
        console.log(to.value.split(',').toString())
    });
</script>
