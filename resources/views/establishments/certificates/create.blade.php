<x-layout>
    @include('_header')
    @include('_side-nav')

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">FIRE SAFETY INSPECTION CERTIFICATES</span>
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

                <a href="{{ route('establishments.certificates.create', $establishment->id) }}" class="text-blue-600 border-2 border-blue-600 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                    </svg>


                    <span>Create Certificate</span>
                </a>
            </div>
        </div>

        <x-containers.content class="mb-5">
            <div>
                <h2 class="font-montserrat px-5 py-5 border-b text-center">
                    <span class="font-semibold text-blue-900">CREATE FIRE SAFETY INSPECTION CERTIFICATE</span>
                </h2>
            </div>

            <div class="font-montserrat mt-5 px-5 flex gap-5">
                <div class="w-1/2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Name of Establishment</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                </svg>
                            </div>
                            <input name="name" type="text" id="input-group-1" class="bg-gray-200 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Establishment" value="{{ $establishment->name }}" form="create-establishment" disabled>
                            @error('name')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Name of Owner / Representative</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <input name="owner" type="text" id="input-group-1" class="bg-gray-200 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Owner / Representative" value="{{ $establishment->owner }}" form="create-establishment" disabled>
                            @error('owner')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Address</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <input name="address" type="text" id="input-group-1" class="bg-gray-200 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address" value="{{ $establishment->address }}" form="create-establishment" disabled>
                            @error('address')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2">
                        <h2 class="text-center text-sm font-bold">PAYMENT DETAILS</h2>
                    </div>

                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Amount Paid</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                </svg>
                            </div>
                            <input name="amount_paid" type="text" id="input-group-1" class="bg-gray-200 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Amount Paid" value="{{ $establishment->payments->last()->amount_paid ?? null }}" form="create-establishment" disabled>
                            @error('amount_paid')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Date Paid</label>
                        <div class="relative mb-6">
                            <input name="date_paid" type="date" id="input-group-1" class="bg-gray-200 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{ $establishment->payments->last()->date_paid ?? null }}" form="create-establishment" disabled>
                            @error('date_paid')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">OR #</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                            </div>
                            <input name="or_number" type="text" id="input-group-1" class="bg-gray-200 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="OR #" value="{{ $establishment->payments->last()->or_number ?? null }}" form="create-establishment" disabled>
                            @error('or_number')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="w-1/2">
                    <div>
                        <label for="input-group-1" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">
                            <span>FSIC #</span>
                            <span class="text-xs">(ex. RO5-0104-22-01)</span>
                        </label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                            </div>
                            <input name="fsic" type="text" id="input-group-1" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-12 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="FSIC #" value="{{ old('fsic') ?? $id_prefix . '-' . $nextId }}" form="create-io">
                            @error('fsic')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="filled_date" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Date</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="filled_date" type="date" id="filled_date" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{ old('filled_date') }}" form="create-io" required>
                            @error('filled_date')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="valid_until" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Valid Until</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="valid_until" type="date" id="valid_until" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" value="{{ old('valid_until') }}" form="create-io" required>
                            @error('valid_until')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">Description</label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <textarea name="description" id="description" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description" form="create-io" value="" required style="resize: none; height: 7rem"
                            ></textarea>
                            @error('description')
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
                    <label for="chief" class="text-blue-900 text-sm" style="font-weight: 500">RECOMMEND APPROVAL</label>
                    <input type="text" class="border border-gray-300 rounded-md bg-gray-200 text-sm" value="{{ $chief->fullname() }}" disabled>
                    <p class="text-sm">CHIEF, Fire Safety Enforcement Section</p>

                    @error('chief')
                    <p class="absolute mt-5 text-xs font-varela text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-1/2 space-y-3 flex flex-col">
                    <label for="chief" class="text-blue-900 text-sm" style="font-weight: 500">APPROVED</label>
                    <input type="text" class="border border-gray-300 rounded-md bg-gray-200 text-sm" value="{{ $marshal->fullname() }}" disabled>
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

<form style="display: none" action="{{ route('establishments.certificates.store', $establishment->id) }}" method="POST" id="create-io">
    @csrf

    <input type="hidden" name="owner" value="{{ $establishment->owner }}">
    <input type="hidden" name="establishment" value="{{ $establishment->name }}">
    <input type="hidden" name="address" value="{{ $establishment->address }}">
    <input type="hidden" name="amount_paid" value="{{ $establishment->payments->last()->amount_paid }}">
    <input type="hidden" name="date_paid" value="{{ $establishment->payments->last()->date_paid }}">
    <input type="hidden" name="or_number" value="{{ $establishment->payments->last()->or_number }}">
    <input type="hidden" name="chief" value="{{ $chief->fullname() }}">
    <input type="hidden" name="marshal" value="{{ $marshal->fullname() }}">
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
    // }
</script>
