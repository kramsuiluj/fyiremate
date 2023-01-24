<x-layout>
    @include('_header')
    @include('_side-nav')

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">DASHBOARD</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <x-containers.content class="">
            <div class="font-montserrat p-5 flex gap-5">
                <a href="#" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $monthlyEstablishments }}</h5>
                    <p class="font-semibold hover:underline">Total # of Establishment Records for {{ \Carbon\Carbon::now()->monthName }}</p>
                </a>

                <a href="javascript:void(0)" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $quarterlyEstablishments }}</h5>
                    @if(\Carbon\Carbon::now()->isCurrentQuarter() == 1)
                        <p class="font-semibold hover:underline">Total # of Establishment Records for {{ \Carbon\Carbon::now()->isCurrentQuarter() }}st Quarter</p>
                    @elseif(\Carbon\Carbon::now()->isCurrentQuarter() == 2)
                        <p class="font-semibold hover:underline">Total # of Establishment Records for {{ \Carbon\Carbon::now()->isCurrentQuarter() }}nd Quarter</p>
                    @elseif(\Carbon\Carbon::now()->isCurrentQuarter() == 3)
                        <p class="font-semibold hover:underline">Total # of Establishment Records for {{ \Carbon\Carbon::now()->isCurrentQuarter() }}rd Quarter</p>
                    @else
                        <p class="font-semibold hover:underline">Total # of Establishment Records for {{ \Carbon\Carbon::now()->isCurrentQuarter() }}th Quarter</p>
                    @endif
                </a>

                <a href="javascript:void(0)" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight dark:text-white">{{ $yearlyEstablishments }}</h5>
                    <p class="font-semibold hover:underline">Total # of Establishment Records for {{ \Carbon\Carbon::now()->monthName }}</p>
                </a>
            </div>
        </x-containers.content>
    </x-containers.main>
</x-layout>
