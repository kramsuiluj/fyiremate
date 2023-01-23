<x-layout>
    @include('_header')
    @include('_side-nav')

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">CITY FIRE MARSHALS</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div class="w-11/12 mx-auto my-3 flex border-b border-gray-300 pb-2">
            <div class="font-montserrat flex">
                <a href="{{ route('administrators.marshals.create') }}" class="text-blue-600 border-2 border-blue-600 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>

                    <span>Create City Fire Marshal</span>
                </a>
            </div>
        </div>

        <x-containers.content>
            <div>
                <h2 class="font-montserrat px-5 py-5 border-b text-center">
                    <span class="font-semibold text-blue-900">EDIT CITY FIRE MARSHAL PROFILE</span>
                </h2>
            </div>

            <div class="font-montserrat mt-5 px-5 pb-5 flex gap-5">
                <div class="w-1/2 mx-auto">
                    <div>
                        <label for="rank" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">
                            <span>Personnel Rank</span>
                            <span class="text-xs">(Optional)</span>
                        </label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="rank" type="text" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rank" value="{{ old('rank') ?? $marshal->rank }}" form="create-establishment">
                            @error('rank')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="firstname" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">
                            <span>First Name</span>
                        </label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="firstname" type="text" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="First Name" value="{{ old('firstname') ?? $marshal->firstname }}" form="create-establishment" required>
                            @error('firstname')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="middlename" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">
                            <span>Middle Name</span>
                        </label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="middlename" type="text" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Middle Name" value="{{ old('middlename') ?? $marshal->middlename }}" form="create-establishment" required>
                            @error('middlename')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="lastname" class="block mb-2 text-sm font-medium text-slate-600 dark:text-white">
                            <span>Last Name</span>
                        </label>
                        <div class="relative mb-6">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <input name="lastname" type="text" class="bg-gray-50 border border-gray-300 text-slate-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-5 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Last Name" value="{{ old('lastname') ?? $marshal->lastname }}" form="create-establishment" required>
                            @error('lastname')
                            <p class="text-xs absolute text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-5 border-t pt-2">
                <button type="submit"
                        form="create-establishment"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-full font-montserrat"
                >
                    SUBMIT
                </button>
            </div>
        </x-containers.content>
    </x-containers.main>

    <form action="{{ route('administrators.marshals.update', $marshal->id) }}" method="POST" id="create-establishment">
        @csrf
        @method('PATCH')
    </form>

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
