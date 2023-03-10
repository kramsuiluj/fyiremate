@php use Illuminate\Support\Facades\Auth; @endphp

<aside id="side-nav"
       style="transition: 0.5s; overflow-x: hidden;"
       class="font-montserrat bg-white fixed h-screen text-slate-600 left-0 top-0 z-20 mt-16 shadow w-48"
>
    <ul class="mt-1 grid justify-center text-sm mt-2">
        <li class="{{ !request()->routeIs('dashboards.index') ? 'border-b' : '' }}">
            <a href="{{ route('dashboards.index') }}"
{{--               {{ Auth::user()->is_admin ? route('administrators.index') : route('users.index') }}--}}
               class="flex items-center space-x-3 px-3 py-3 rounded
               cursor-pointer {{ request()->routeIs('dashboards.index') ? 'bg-orange-500 text-white' :
               'hover:bg-gray-200 hover:rounded' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                </svg>

                <span>Dashboard</span>
            </a>
        </li>

        <li class="{{ !request()->routeIs('establishments.*') ? 'border-b' : '' }}">
            <a href="{{ route('establishments.index') }}"
               class="flex items-center space-x-3 px-3 py-3 rounded
               cursor-pointer {{ request()->routeIs('establishments.*') ? 'bg-orange-500 text-white' :
               'hover:bg-gray-200 hover:rounded' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>

                <span>Establishments</span>
            </a>
        </li>

        @can('admin')
            <li class="border-b">
                <div id="personnel" class="flex items-center px-3 py-3 hover:bg-gray-200 hover:rounded cursor-pointer">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>

                        <span>Personnel</span>
                    </div>

                    <div class="ml-auto">
                        <svg class="w-3.5 h-3.5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>

                <ul id="personnel-categories"
                    style="font-weight: 300; display: {{ request()->routeIs('administrators.marshals.*') || request()
                ->routeIs('administrators.chiefs.*') || request()->routeIs('administrators.inspectors.*') ?
                'block' : 'none'
                 }}"
                    class="flex flex-col mt-1 pb-1 space-y-1"
                >
                    <li>
                        <a href="{{ route('administrators.marshals.index') }}"
                           class="py-1 w-full flex items-center pl-3 space-x-3 rounded cursor-pointer {{ request()
                       ->routeIs('administrators.marshals.*') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200'
                       }}">
                            <svg class="w-4 h-4" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>

                            <span>City Fire Marshal</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('administrators.chiefs.index') }}"
                           class="py-1 w-full flex items-center pl-3 space-x-3 rounded cursor-pointer {{ request()
                       ->routeIs('administrators.chiefs.*') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200'
                       }}">

                            <svg class="w-4 h-4" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>

                            <span>Chief, FSES</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('administrators.inspectors.index') }}"
                           class="py-1 w-full flex items-center pl-3 space-x-3 rounded cursor-pointer {{ request()
                       ->routeIs('administrators.inspectors.*') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200'
                       }}">
                            <svg class="w-4 h-4" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>

                            <span>Inspectors</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ !request()->routeIs('administrators.users.*') ? 'border-b' : '' }}">
                <a href="{{ route('administrators.users.index') }}"
                   class="flex items-center space-x-3 px-3 py-3 rounded
               cursor-pointer {{ request()->routeIs('administrators.users.*') ? 'bg-orange-500 text-white' :
               'hover:bg-gray-200 hover:rounded' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>

                    <span>Users</span>
                </a>
            </li>

            <li class="{{ !request()->routeIs('administrators.fields.*') ? 'border-b' : '' }}">


                <a href="{{ route('administrators.fields.index') }}"
                   class="flex items-center space-x-3 px-3 py-3 rounded cursor-pointer {{ request()->routeIs('administrators.fields.*') ? 'bg-orange-500 text-white' : 'hover:bg-gray-200 hover:rounded' }}"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>

                    <span>Fixed Fields</span>
                </a>
            </li>

            <li class="{{ !request()->routeIs('administrators.actions.*') ? 'border-b' : '' }}">
                <a href="{{ route('administrators.actions.index') }}"
                   class="flex items-center space-x-3 px-3 py-3 rounded
               cursor-pointer {{ request()->routeIs('administrators.actions.*') ? 'bg-orange-500 text-white' :
               'hover:bg-gray-200 hover:rounded' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>

                    <span>Action Logs</span>
                </a>
            </li>
        @endcan

        <li class="{{ !request()->routeIs('reports.*') ? 'border-b' : '' }}">

            <a href="{{ route('reports.index') }}"
               class="flex items-center space-x-3 px-3 py-3 rounded
               cursor-pointer {{ request()->routeIs('reports.*') ? 'bg-orange-500 text-white' :
               'hover:bg-gray-200 hover:rounded' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>

                <span>Reports</span>
            </a>
        </li>

        <li class="">
            {{--                {{ !request()->routeIs('administrators.actions.*') ? 'border-b' : '' }}--}}
            <a href="/updates/validity"
               {{--                   {{ route('administrators.actions.index') }}--}}
               class="flex items-center space-x-3 px-3 py-3 rounded
               cursor-pointer ">
                {{--                    {{ request()->routeIs('administrators.actions.*') ? 'bg-orange-500 text-white' :--}}
                {{--               'hover:bg-gray-200 hover:rounded' }}--}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>

                <span>Update Validity</span>
            </a>
        </li>

{{--        <li>--}}
{{--            <div id="reports" class="flex items-center px-3 py-3 hover:bg-gray-200 hover:rounded cursor-pointer">--}}
{{--                <div class="flex items-center space-x-3">--}}
{{--                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"--}}
{{--                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"--}}
{{--                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>--}}
{{--                    </svg>--}}

{{--                    <span>Reports</span>--}}
{{--                </div>--}}

{{--                <div class="ml-auto">--}}
{{--                    <svg class="w-3.5 h-3.5 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"--}}
{{--                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <ul id="report-categories"--}}
{{--                style="font-weight: 300; display: none;"--}}
{{--                class="flex flex-col mt-1 pb-1 space-y-1"--}}
{{--            >--}}
{{--                <li>--}}
{{--                    <a href="javascript:void(0)"--}}
{{--                       class="py-1 w-full flex items-center pl-3 space-x-3 rounded hover:bg-gray-200 cursor-pointer">--}}
{{--                        <svg class="w-4 h-4" fill="#64748B" stroke="#64748B" viewBox="0 0 24 24"--}}
{{--                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"--}}
{{--                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
{{--                        </svg>--}}

{{--                        <span>Monthly Reports</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript:void(0)"--}}
{{--                       class="py-1 w-full flex items-center pl-3 space-x-3 rounded hover:bg-gray-200 cursor-pointer">--}}
{{--                        <svg class="w-4 h-4" fill="#64748B" stroke="#64748B" viewBox="0 0 24 24"--}}
{{--                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"--}}
{{--                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
{{--                        </svg>--}}

{{--                        <span>Quarterly Reports</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="javascript:void(0)"--}}
{{--                       class="py-1 w-full flex items-center pl-3 space-x-3 rounded hover:bg-gray-200 cursor-pointer">--}}
{{--                        <svg class="w-4 h-4" fill="#64748B" stroke="#64748B" viewBox="0 0 24 24"--}}
{{--                             xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"--}}
{{--                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>--}}
{{--                        </svg>--}}

{{--                        <span>Annual Reports</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
    </ul>
</aside>
