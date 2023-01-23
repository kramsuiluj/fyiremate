<x-layout>
    <main class="mt-24 mx-auto w-1/2">
        <div class="w-5/6 mx-auto bg-white p-5 rounded">
            <h2 class="font-semibold font-montserrat border-b pb-5">ADD FORM TEMPLATES</h2>


            <div class="w-1/2 mx-auto mt-5">
                <form action="{{ route('administrators.checklists.store') }}" method="POST" class="space-y-5" enctype="multipart/form-data">
                    @csrf

                    <input type="text" name="type" id="type" class="border">





                    <section>
                        <label
                            for="file"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >
                            Upload Form Template
                        </label>
                        <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                         cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600
                         dark:placeholder-gray-400" id="file_input" type="file" name="file">

                        @error('file')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror

                    </section>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex mx-auto
                 ">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </main>
</x-layout>
