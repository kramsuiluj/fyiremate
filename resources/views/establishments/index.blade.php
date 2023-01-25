<x-layout>
    @include('_header')
    @include('_side-nav')

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">ESTABLISHMENTS</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div x-data="{ show: false }" class="w-11/12 mx-auto my-3 flex border-b border-gray-300 pb-2">
            <div class="font-montserrat flex">
                <a href="{{ route('establishments.create') }}"
                   class="text-blue-600 border-2 border-blue-600 bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z"/>
                    </svg>


                    <span>Add Establishment</span>
                </a>

                <a href="{{ route('establishments.import') }}"
                   class="text-blue-900 border-2 border-blue-900 bg-white focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>


                    <span class="">Import Establishments</span>
                </a>

                <button type="button"
                        @click="show = !show"
                        class="text-green-600 border-2 border-green-600 bg-white focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>

                    <span>Export Establishments</span>
                </button>

                <div x-show="show" style="display: none" class="relative z-10" aria-labelledby="modal-title"
                     role="dialog"
                     aria-modal="true">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                    <div class="fixed inset-0 z-10 overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg">
                                <div class="bg-white px-4 pt-5 pb-4">
                                    <div class="">
                                        <div class="text-center space-y-5">
                                            <div class="flex justify-between">


                                                <h3 class="font-montserrat font-semibold leading-6 text-gray-900 text-left"
                                                    id="modal-title">EXPORT ACTIONS LOG</h3>

                                                <span @click="show = false" class="cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
</svg>

                                                </span>
                                            </div>
                                            <form action="{{ route('establishments.export') }}" method="POST" class="font-montserrat text-slate-600 space-y-5">
                                                @csrf

                                                <div class="flex space-x-2 items-center items-center justify-center">
                                                    <div>
                                                        <label for="from" class="text-sm font-semibold">FROM</label>
                                                        <input name="from" type="date" class="text-sm bg-gray-50 border border-gray-300 rounded-md" value="{{ request('from') }}" required>
                                                    </div>

                                                    <div class="">
                                                        <label for="to" class="text-sm font-semibold">TO</label>
                                                        <input name="to" type="date" class="text-sm bg-gray-50 border border-gray-300 rounded-md" value="{{ request('to') }}" required>
                                                    </div>
                                                </div>

                                                <button @click="show = false" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-full">EXPORT</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 font-montserrat">--}}
                                {{--                                    <button @click="show = false" id="add-element" type="button" class="inline-flex--}}
                                {{--                                    w-full--}}
                                {{--                                    justify-center--}}
                                {{--                                    rounded-md border--}}
                                {{--                                    border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white--}}
                                {{--                                    shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-red-500--}}
                                {{--                                    focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Add</button>--}}
                                {{--                                    <button @click="show = false" type="button" class="mt-3 inline-flex w-full--}}
                                {{--                                    justify-center--}}
                                {{--                                    rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-11/12 mx-auto my-3">
            <div class="flex justify-between">
                <div class="flex items-center border rounded-md bg-gray-50">
                    <form action="" method="GET" class="flex">
                        <div class="relative">
                            <input name="search" type="text" id="search"
                                   class="border-none rounded-l text-sm font-montserrat focus:ring-0"
                                   placeholder="Search Establishments" style="width: 25rem"
                                   value="{{ request('search') }}">

                            @if(request()->has('search'))
                                <a href="{{ route('establishments.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 absolute right-0 top-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="px-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-11/12 mx-auto my-3 pb-5">
            <div class="flex flex-col">
                @if(count($establishments) == 0)
                    <div class="py-2 px-2 rounded">
                        <p class="font-montserrat text-sm text-slate-500 flex space-x-1 items-center justify-center underline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                            </svg>

                            <span>There are no establishment records in the system.</span>
                        </p>
                    </div>
                @else
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200 font-montserrat">
                                    <thead class="bg-gray-50">
                                    <tr class="bg-blue-900 w-full">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                            Establishment
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">

                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($establishments as $establishment)
                                        <tr class="hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium text-slate-600">
                                                            {{ $establishment->fsic }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-semibold text-slate-600">
                                                            {{ $establishment->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium text-slate-600">
                                                            @if($establishment->status == 'For Inspection')
                                                                <div class="bg-gray-500 text-white px-2 py-1 rounded">
                                                                    {{ $establishment->status }}
                                                                </div>
                                                            @elseif($establishment->status == 'For Compliance')
                                                                <div class="bg-yellow-300 text-white px-2 py-1 rounded">
                                                                    {{ $establishment->status }}
                                                                </div>
                                                            @elseif($establishment->status == 'For Re-Inspection')
                                                                <div class="bg-red-500 text-white px-2 py-1 rounded">
                                                                    {{ $establishment->status }}
                                                                </div>
                                                            @elseif($establishment->status == 'Completed')
                                                                <div class="bg-green-500 text-white px-2 py-1 rounded">
                                                                    {{ $establishment->status }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td x-data="{ show: false }"
                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <div class="text-xs font-medium text-slate-600">
                                                            <div class="flex space-x-3">
                                                                <a href="{{ route('establishments.certificates.index', $establishment->id) }}"
                                                                   title="Fire Safety Inspection Certificate" class="bg-orange-500 text-white leading-5 px-2 rounded-md">
                                                                    FSIC
                                                                </a>

                                                                <a href="{{ route('establishments.inspections.index', $establishment->id) }}"
                                                                   title="Inspection Order" class="bg-blue-900 text-white leading-5 px-2 rounded-md">
                                                                    IO
                                                                </a>

                                                                <a href="{{ route('establishments.show', $establishment->id) }}"
                                                                   title="View Establishment Details" class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2.5"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-eye w-5 h-5 text-green-500">
                                                                        <path
                                                                            d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                                        <circle cx="12" cy="12" r="3"></circle>
                                                                    </svg>
                                                                </a>

                                                                <a href="{{ route('establishments.edit', $establishment->id) }}"
                                                                   title="Edit Establishment Details" class="">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         class="w-5 h-5 feather feather-edit text-blue-500"
                                                                         viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2.5"
                                                                         stroke-linecap="round" stroke-linejoin="round">
                                                                        <path
                                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                        <path
                                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                    </svg>
                                                                </a>

                                                                <a @click="show = !show" id="delete-button"
                                                                   href="javascript:void(0)" class="text-red-700"
                                                                   title="Delete Certificate"
                                                                >
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2.5"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-trash-2 w-5 h-5">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                                    </svg>

                                                                    <form id="delete-{{ $establishment->id }}"
                                                                          action="{{ route('establishments.destroy', $establishment->id) }}"
                                                                          method="POST" style="display: none">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    </form>
                                                                </a>

                                                                <div x-show="show" class="relative z-10"
                                                                     aria-labelledby="modal-title" role="dialog"
                                                                     aria-modal="true" style="display: none">
                                                                    <div
                                                                        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                                                                    <div class="fixed inset-0 z-10 overflow-y-auto">
                                                                        <div
                                                                            class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                                            <div
                                                                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                                                <div
                                                                                    class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                                    <div class="sm:flex sm:items-start">
                                                                                        <div
                                                                                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                                            <svg
                                                                                                class="h-6 w-6 text-red-600"
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                aria-hidden="true">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M12 10.5v3.75m-9.303 3.376C1.83 19.126 2.914 21 4.645 21h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 4.88c-.866-1.501-3.032-1.501-3.898 0L2.697 17.626zM12 17.25h.007v.008H12v-.008z"/>
                                                                                            </svg>
                                                                                        </div>
                                                                                        <div
                                                                                            class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                                            <h3 class="text-lg font-medium leading-6 text-gray-900"
                                                                                                id="modal-title">Delete
                                                                                                Establishment
                                                                                                Record</h3>
                                                                                            <div class="mt-2">
                                                                                                <p class="text-sm text-gray-500">
                                                                                                    Are you sure you
                                                                                                    want to delete this
                                                                                                    Establishment
                                                                                                    Record?</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                                                    <button type="button"
                                                                                            @click.prevent="document.getElementById('delete-{{ $establishment->id }}').submit()"
                                                                                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                                                                                        Delete
                                                                                    </button>
                                                                                    <button type="button"
                                                                                            @click="show = false"
                                                                                            class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                                                        Cancel
                                                                                    </button>
                                                                                </div>
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
        </div>

        <div class="w-11/12 mx-auto mb-5 font-montserrat pb-5">
            {{ $establishments->links() }}
        </div>
    </x-containers.main>

    @if(session()->has('success'))
        <div class="mx-auto absolute bottom-0 right-0 mb-5 mr-5 font-montserrat font-semibold">
            <p
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                class="bg-blue-500 text-white py-2 px-4 rounded-xl text-sm flex justify-center text-center
                items-center space-x-2"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>

                <span>{{ session('success') }}</span>
            </p>
        </div>
    @endif
</x-layout>

<script>
    // function searchQuery(e) {
    //     let keyword = e.value;
    //
    //     window.location.href = 'http://localhost:8000/establishments?filter[name]=' + keyword + '&filter[owner]=' + keyword;
    // }
</script>


