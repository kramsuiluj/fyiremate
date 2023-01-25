<x-layout>
    @include('_header')
    @include('_side-nav')

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">ACTIONS LOG</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div class="w-11/12 mx-auto my-3 flex border-b border-gray-300 pb-2">
            <div class="flex items-center justify-between">
                <div x-data="{ show: false }" class="font-montserrat flex">
                    {{--                {{ route('administrators.actions.export') }}--}}
                    <a @click="show = !show" href="javascript:void(0)" class="text-green-600 border-2 border-green-600 bg-white focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>

                        <span>Export Action Logs</span>
                    </a>

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
                                                <form action="{{ route('administrators.actions.export') }}" method="POST" class="font-montserrat text-slate-600 space-y-5">
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
        </div>

        <div class="w-11/12 mx-auto my-3 flex border-b border-gray-300 pb-2">
            <div class="flex items-center justify-between">
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

                        <button class="text-white bg-gray-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-sm px-5 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Filter</button>

                        @if(request()->has(['from', 'to']))
                            <a href="{{ route('administrators.actions.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        @if (count($actions) == 0)
            <div class="py-2 px-2 rounded">
                <p class="font-montserrat text-sm text-slate-500 flex space-x-1 items-center justify-center underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>

                    <span>The actions log is empty.</span>
                </p>
            </div>
        @else
            <div class="w-11/12 mx-auto my-3 font-montserrat">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 font-montserrat">
                                <thead class="bg-gray-50">
                                <tr class="bg-blue-900 w-full">
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Action Taken
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        By
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($actions as $action)
                                    @php
                                        $description = wordwrap($action->description, 50, "<br />\n");

                                    @endphp
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs text-slate-600">
                                                        <span>{{ $action->created_at->isoFormat('MMMM D, YYYY | h:mm:ss a') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-semibold text-slate-600">
                                                        <span>{{ $action->log_name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-xs text-slate-600">
                                                        <span>{!! $description !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center justify-center">
                                                <div class="ml-4">
                                                    <div class="text-xs text-slate-600">
                                                        <span>{{ $action->getExtraProperty('by') }}</span>
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
            </div>
        @endif

        <div class="w-11/12 mx-auto mb-5 font-montserrat pb-5">
            {{ $actions->links() }}
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
