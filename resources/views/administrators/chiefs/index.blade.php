<x-layout>
    @include('_header')
    @include('_side-nav')

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">CHIEF, FIRE SAFETY ENFORCEMENT SECTION</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div class="w-11/12 mx-auto my-3 border-b border-gray-300 pb-2">
            <div class="font-montserrat flex justify-between items-center">
                <a href="{{ route('administrators.chiefs.create') }}" class="text-blue-600 border-2 border-blue-600 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>

                    <span>Create Chief, FSES</span>
                </a>

                <a href="{{ route('administrators.chiefs.history') }}" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 text-xs rounded-lg text-sm px-4 py-1.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>

                    <span>Deleted History</span>
                </a>
            </div>
        </div>

        <div class="w-11/12 mx-auto my-3 font-montserrat">
            @if(count($chiefs) == 0)
                <div class="py-2 px-2 rounded pb-5">
                    <p class="font-montserrat text-sm text-slate-500 flex space-x-1 items-center justify-center underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>

                        <span>Currently, there are no City Fire Marshal in the system.</span>
                    </p>
                </div>
            @else
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 font-montserrat">
                                <thead class="bg-gray-50">
                                <tr class="bg-blue-900 w-full">
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Rank
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Full Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Date Created
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Default
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($chiefs as $chief)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-medium text-slate-600">
                                                        {{ $loop->iteration }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs text-slate-600">
                                                        {{ $chief->rank ?? 'none' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <div class="ml-4">
                                                    <div class="text-xs text-slate-600 font-semibold">
                                                        {{ $chief->fullname() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <div class="ml-4">
                                                    <div class="text-xs text-slate-600">
                                                        {{ date('F j, Y, g:i a', strtotime($chief->created_at)) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td x-data="{}" class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <div class="ml-4">
                                                    <div class="text-xs text-slate-600">
                                                        @if ($chief->default())
                                                            <button class="text-white
                                                            focus:ring-4 focus:ring-gray-300 font-medium rounded-lg
                                                            text-xs px-5 py-2 focus:outline-none bg-gray-500">Set
                                                                Default</button>
                                                        @else
                                                            <button @click.prevent="document.getElementById
                                                    ('default-{{
                                                    $chief->id
                                                    }}').submit()"
                                                                    class="text-white
                                                            focus:ring-4 focus:ring-blue-300 font-medium rounded-lg
                                                            text-xs px-5 py-2 focus:outline-none bg-blue-700 hover:bg-blue-800">
                                                                Set Default
                                                            </button>
                                                        @endif

                                                        <form id="default-{{ $chief->id }}"
                                                              action="{{ route('administrators.chiefs.default', $chief->id) }}"
                                                              method="POST" style="display: none;">
                                                            @csrf
                                                            @method('PATCH')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td x-data="{ show: false }" class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <div class="ml-4">
                                                    <div class="text-xs text-slate-600 flex space-x-3 items-center">
                                                        <div>
                                                            <a id="edit-button" href="{{ route('administrators.chiefs.edit',
                                                    $chief->id)
                                                    }}" class="text-cyan-700">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 feather feather-edit text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                            </a>
                                                        </div>

                                                        @if ($chief->default())
                                                            <div>
                                                                <button @click="show = true" type="button"
                                                                        class="text-gray-500">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-5 h-5 mt-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                </button>

                                                                <div x-show="show" style="display: none;" class="relative
                                                            z-10"
                                                                     aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                                                                    <div class="fixed inset-0 z-10 overflow-y-auto">
                                                                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                                            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                                    <div class="sm:flex sm:items-start">
                                                                                        <div class="mx-auto flex h-12
                                                                                    w-12 flex-shrink-0 items-center
                                                                                    justify-center rounded-full
                                                                                    bg-gray-100
                                                                                    sm:mx-0 sm:h-10 sm:w-10">
                                                                                            <svg class="h-6 w-6
                                                                                        text-gray-600"
                                                                                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v3.75m-9.303 3.376C1.83 19.126 2.914 21 4.645 21h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 4.88c-.866-1.501-3.032-1.501-3.898 0L2.697 17.626zM12 17.25h.007v.008H12v-.008z" />
                                                                                            </svg>
                                                                                        </div>
                                                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                                            <div @click="show = false"
                                                                                                 class="absolute
                                                                                        top-0
                                                                                        right-0 mr-2 mt-2
                                                                                        cursor-pointer
                                                                                        hover:bg-gray-200
                                                                                        hover:rounded-full">
                                                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                                                            </div>

                                                                                            <h3 class="text-lg
                                                                                        font-medium leading-6
                                                                                        text-gray-900"
                                                                                                id="modal-title">
                                                                                                Default City Fire Marshal
                                                                                            </h3>
                                                                                            <div class="mt-2">
                                                                                                <p class="text-sm
                                                                                            text-gray-500 whitespace-normal">
                                                                                                    This Marshal is
                                                                                                    currently set to
                                                                                                    default, please set a
                                                                                                    different Marshal to
                                                                                                    default to delete
                                                                                                    this one.
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <a id="delete-button" href="#" @click.prevent="show = !show" class="text-red-700">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-5 h-5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                            </a>
                                                        @endif

                                                        <form id="delete-{{ $chief->id }}" action="{{ route
                                                        ('administrators.chiefs.destroy', $chief->id) }}"
                                                              method="POST"
                                                              style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <div x-show="show" style="display: none;" class="relative z-10"
                                                             aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                                                            <div class="fixed inset-0 z-10 overflow-y-auto">
                                                                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                            <div class="sm:flex sm:items-start">
                                                                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v3.75m-9.303 3.376C1.83 19.126 2.914 21 4.645 21h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 4.88c-.866-1.501-3.032-1.501-3.898 0L2.697 17.626zM12 17.25h.007v.008H12v-.008z" />
                                                                                    </svg>
                                                                                </div>
                                                                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Delete account</h3>
                                                                                    <div class="mt-2">
                                                                                        <p class="text-sm text-gray-500">Are you sure you want to delete this Marshal?</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                                            <button type="button" @click.prevent="document.getElementById
                                                                                ('delete-{{ $chief->id }}').submit()"
                                                                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Delete</button>
                                                                            <button type="button" @click="show = false" class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="w-11/12 mx-auto mb-5 font-montserrat pb-5">
            {{ $chiefs->links() }}
        </div>
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
