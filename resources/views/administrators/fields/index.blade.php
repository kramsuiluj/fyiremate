<x-layout>
    @include('_header')
    @include('_side-nav')

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">FIXED FIELDS</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div class="w-11/12 mx-auto my-3 font-montserrat">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 font-montserrat">
                            <thead class="bg-gray-50">
                            <tr class="bg-blue-900 w-full">
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                    Field Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">
                                    Field Value
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-white tracking-wider">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-medium text-slate-600">
                                                    <span>FSIC # - Prefix</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>{{ $id_prefix->value }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td x-data="{ show: false }" class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-end">
                                            <div class="ml-4">
                                                <div class="text-xs font-medium text-slate-600">
                                                    <button type="submit"
                                                            @click="show = true"
                                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-full"
                                                    >
                                                        Set Default Value
                                                    </button>

                                                    <div x-show="show" style="display: none;" class="relative z-10"
                                                         aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                                                        <div class="fixed inset-0 z-10 overflow-y-auto">
                                                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                                    {{--                                                                Modal Content Container --}}
                                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                        <div class="sm:flex sm:items-start">
                                                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Set ID Prefix</h3>
                                                                                <div class="mt-2">
                                                                                    @if ($id_prefix?->value)
                                                                                        <form id="id_prefix_form" action="{{ route('administrators.fields.updateIdPrefix', $id_prefix->id) }}" method="POST">
                                                                                            @csrf
                                                                                            @method('PATCH')

                                                                                            <input type="text" name="id_prefix" class="input-field" value="{{ $id_prefix->value }}">
                                                                                        </form>
                                                                                    @else
                                                                                        <form id="id_prefix_form" action="{{ route('administrators.fields.setIdPrefix') }}" method="POST">
                                                                                            @csrf

                                                                                            <input type="text" name="id_prefix" class="input-field">
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                                        <button type="button" @click.prevent="document.getElementById('id_prefix_form').submit()" class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
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

                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-medium text-slate-600">
                                                    <span>Inspection Order # - Prefix</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center">
                                            <div class="ml-4">
                                                <div class="text-xs font-semibold text-slate-600">
                                                    <span>{{ $io_prefix->value }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td x-data="{ show: false }" class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-end">
                                            <div class="ml-4">
                                                <div class="text-xs font-medium text-slate-600">
                                                    <button type="submit"
                                                            @click="show = true"
                                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-full"
                                                    >
                                                        Set Default Value
                                                    </button>

                                                    <div x-show="show" style="display: none;" class="relative z-10"
                                                         aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                                                        <div class="fixed inset-0 z-10 overflow-y-auto">
                                                            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                                    {{--                                                                Modal Content Container --}}
                                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                        <div class="sm:flex sm:items-start">
                                                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Set ID Prefix</h3>
                                                                                <div class="mt-2">
                                                                                    @if ($io_prefix?->value)
                                                                                        <form id="io_prefix" action="{{ route('administrators.fields.updateIoPrefix', $io_prefix->id) }}" method="POST">
                                                                                            @csrf
                                                                                            @method('PATCH')

                                                                                            <input type="text" name="io_prefix" class="input-field" value="{{ $io_prefix->value }}">
                                                                                        </form>
                                                                                    @else
                                                                                        <form id="io_prefix" action="{{ route('administrators.fields.setIoPrefix') }}" method="POST">
                                                                                            @csrf

                                                                                            <input type="text" name="io_prefix" class="input-field">
                                                                                        </form>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                                                        <button type="button" @click.prevent="document.getElementById('io_prefix').submit()" class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
