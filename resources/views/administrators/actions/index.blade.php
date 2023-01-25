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
            <div class="font-montserrat flex">
                <a href="{{ route('administrators.actions.export') }}" class="text-green-600 border-2 border-green-600 bg-white focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-xs px-4 py-1.5 text-center mr-2 mb-2 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>

                    <span>Export Action Logs</span>
                </a>
            </div>
        </div>

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
                                            <div class="flex items-center justify-center">
                                                <div class="ml-4">
                                                    <div class="text-xs font-medium text-slate-600">
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
