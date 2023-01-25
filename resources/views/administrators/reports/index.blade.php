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


        @if($establishments)
            <div class="w-11/12 mx-auto my-3 font-montserrat">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 font-montserrat">
                                <thead class="bg-gray-50">
                                <tr class="bg-blue-900 w-full">
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Type of Occupancy
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        # of Establishments
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                        Date Range
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>Business</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ $business }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ \Carbon\Carbon::parse(request('from'))->isoFormat('MMMM D, YYYY') }}</span>
                                                    to
                                                    <span>{{ \Carbon\Carbon::parse(request('to'))->isoFormat('MMMM D, YYYY') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>Industrial</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ $industrial }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ \Carbon\Carbon::parse(request('from'))->isoFormat('MMMM D, YYYY') }}</span>
                                                    to
                                                    <span>{{ \Carbon\Carbon::parse(request('to'))->isoFormat('MMMM D, YYYY') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>Educational</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ $educational }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ \Carbon\Carbon::parse(request('from'))->isoFormat('MMMM D, YYYY') }}</span>
                                                    to
                                                    <span>{{ \Carbon\Carbon::parse(request('to'))->isoFormat('MMMM D, YYYY') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>Health Care</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ $healthcare }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ \Carbon\Carbon::parse(request('from'))->isoFormat('MMMM D, YYYY') }}</span>
                                                    to
                                                    <span>{{ \Carbon\Carbon::parse(request('to'))->isoFormat('MMMM D, YYYY') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>Mercantile</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ $mercantile }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ \Carbon\Carbon::parse(request('from'))->isoFormat('MMMM D, YYYY') }}</span>
                                                    to
                                                    <span>{{ \Carbon\Carbon::parse(request('to'))->isoFormat('MMMM D, YYYY') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>Residential</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ $residential }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ \Carbon\Carbon::parse(request('from'))->isoFormat('MMMM D, YYYY') }}</span>
                                                    to
                                                    <span>{{ \Carbon\Carbon::parse(request('to'))->isoFormat('MMMM D, YYYY') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>Storage</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ $storage }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs text-slate-600">
                                                    <span>{{ \Carbon\Carbon::parse(request('from'))->isoFormat('MMMM D, YYYY') }}</span>
                                                    to
                                                    <span>{{ \Carbon\Carbon::parse(request('to'))->isoFormat('MMMM D, YYYY') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="py-2 px-2 rounded">
                <p class="font-montserrat text-sm text-slate-500 flex space-x-1 items-center justify-center underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                    </svg>

                    <span>Set the range of date to generate reports.</span>
                </p>
            </div>
        @endif

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
