<x-layout>
    @include('_header')
    @include('_side-nav')

    <section id="loading">
        <div id="loading-content"></div>
    </section>

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">UPDATE VALIDITY</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div class="w-11/12 mx-auto my-3 font-montserrat">
            <div class="flex">
                <form action="{{ route('updates.validity') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button>UPDATE VALIDITY</button>
                </form>
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

<script>
    // window.onload = function () {

    function showLoading() {
        document.querySelector('#loading').classList.add('loading');
        document.querySelector('#loading-content').classList.add('loading-content');
    }

    function hideLoading() {
        document.querySelector('#loading').classList.remove('loading');
        document.querySelector('#loading-content').classList.remove('loading-content');
    }
    // }
</script>
