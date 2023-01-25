<x-layout>
    @include('_header')
    @include('_side-nav')

    <section id="loading">
        <div id="loading-content"></div>
    </section>

    <x-sub-header>
        <div class="px-5">
            <span class="font-daysone text-blue-900">CHANGE PASSWORD</span>
        </div>
    </x-sub-header>

    <x-containers.main>
        <div class="flex mt-4">
            <div class="m-auto">
                <div class="border shadow p-5 rounded bg-white" style="width: 25rem">
                    <form action="{{ route('account.update') }}" method="POST" class="font-montserrat space-y-6">
                        @csrf

                        <section class="space-y-8">
                            <div class="flex flex-col space-y-1 relative">
                                <label for="old_password" class="text-sm">Current Password</label>
                                <input type="password" name="old_password" class="rounded bg-gray-50" placeholder="●●●●●●●●" required>
                                @error('old_password')
                                <p class="text-xs text-red-500 absolute -bottom-4">{{ $message }}</p>
                                @enderror
                            </div>
                        </section>

                        <hr>

                        <section class="space-y-8">
                            <div class="flex flex-col space-y-1 relative">
                                <label for="new_password" class="text-sm">New Password</label>
                                <input type="password" name="new_password" class="rounded bg-gray-50" placeholder="●●●●●●●●" required>
                                @error('new_password')
                                <p class="text-xs text-red-500 absolute -bottom-4">{{ $message }}</p>
                                @enderror
                            </div>
                        </section>

                        <section class="space-y-8">
                            <div class="flex flex-col space-y-1 relative">
                                <label for="new_password_confirmation" class="text-sm">Confirm Password</label>
                                <input type="password" name="new_password_confirmation" class="rounded bg-gray-50" placeholder="●●●●●●●●" required>
                            </div>
                        </section>

                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 w-full"
                        >
                            Change Password
                        </button>
                    </form>
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
