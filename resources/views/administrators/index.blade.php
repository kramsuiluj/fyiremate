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
                    <h5 class="mb-2 text-3xl font-bold tracking-tight">{{ $monthlyEstablishments }}</h5>
                    <p class="font-semibold hover:underline">Total # of Establishment Records for {{ \Carbon\Carbon::now()->monthName }}</p>
                </a>

                <a href="javascript:void(0)" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <h5 class="mb-2 text-3xl font-bold tracking-tight">{{ $quarterlyEstablishments }}</h5>
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
                    <h5 class="mb-2 text-3xl font-bold tracking-tight dark:text-white">{{ $yearlyEstablishments }}</h5>
                    <p class="font-semibold hover:underline">Total # of Establishment Records for {{ \Carbon\Carbon::now()->year }}</p>
                </a>
            </div>
        </x-containers.content>

        <x-containers.content class="">
            <h2 class="font-montserrat px-5 pt-2 font-semibold text-slate-600"># of Establishments based on Status for {{ \Carbon\Carbon::now()->monthName }}</h2>

            <div class="font-montserrat p-5 flex gap-5">
                <a href="#" class="text-white bg-gradient-to-br from-green-300 to-green-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $monthlyCompleted }}</h5>
                    <p class="font-semibold hover:underline">COMPLETED</p>
                </a>

                <a href="#" class="text-white bg-gradient-to-br from-gray-300 to-gray-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $monthlyFI }}</h5>
                    <p class="font-semibold hover:underline">FOR INSPECTION</p>
                </a>

                <a href="#" class="text-white bg-gradient-to-br from-yellow-300 to-yellow-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $monthlyFC }}</h5>
                    <p class="font-semibold hover:underline">FOR COMPLIANCE</p>
                </a>

                <a href="#" class="text-white bg-gradient-to-br from-red-300 to-red-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $monthlyFRI }}</h5>
                    <p class="font-semibold hover:underline">FOR RE-INSPECTION</p>
                </a>
            </div>
        </x-containers.content>

        <x-containers.content class="">
            <div class="flex p-2">
                <div class="w-1/2">
                    <canvas id="statusChart"></canvas>
                </div>

                <div class="w-1/2">
                    <canvas id="validityChart"></canvas>
                </div>
            </div>
        </x-containers.content>
    </x-containers.main>
</x-layout>

<div style="display: none" id="statuses"
     data-completed="{{ $monthlyCompleted }}"
     data-forInspection="{{ $monthlyFI }}"
     data-forCompliance="{{ $monthlyFC }}"
     data-forReInspection="{{ $monthlyFRI }}"
></div>

<div style="display: none" id="validity"
     data-valid="{{ $valid }}"
     data-invalid="{{ $invalid }}"
></div>

<div style="display: none" id="dates"
     data-month="{{ \Carbon\Carbon::now()->monthName }}"
>
</div>

<script>
    window.onload = function () {
        const statusChart = document.getElementById('statusChart');
        const validityChart = document.getElementById('validityChart');
        const statuses = document.getElementById('statuses').dataset;
        const validity = document.getElementById('validity').dataset;
        const dates = document.getElementById('dates').dataset;

        new Chart(statusChart, {
            type: 'line',
            data: {
                labels: ['Completed', 'For Inspection', 'For Compliance', 'For Re-Inspection'],
                datasets: [{
                    label: '# of Votes',
                    data: Object.values(Object.assign({}, statuses)),
                    borderWidth: 1,
                    backgroundColor: [
                        '#22C55E',
                        '#6B7280',
                        '#EAB308',
                        '#EF4444'
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: 'Establishment Statuses (' + dates.month + ')'
                    }
                }
            }
        });

        //

        new Chart(validityChart, {
            type: 'bar',
            data: {
                labels: ['Valid', 'Invalid'],
                datasets: [{
                    label: '# of Votes',
                    data: Object.values(Object.assign({}, validity)),
                    borderWidth: 1,
                    backgroundColor: [
                        '#22C55E',
                        '#EF4444',
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: 'FSIC Validity (' + dates.month + ')'
                    }
                }
            }
        });

    }
</script>
