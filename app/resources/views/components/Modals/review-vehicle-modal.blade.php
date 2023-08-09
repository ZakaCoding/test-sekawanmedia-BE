<!-- Main modal -->
<div id="review-vehicle-modal-{{ $data->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="review-vehicle-modal-{{ $data->id }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-2 text-xl font-medium text-gray-900 dark:text-white">Review Vehicle Request</h3>
                <p class="mb-5 text-gray-500 font-thin leading-tight">
                    Admin neeed you to review this requst vehicle.
                </p>
                <form class="space-y-6">
                    @csrf
                    <div class="mb-2">
                        <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">Car Name</label>
                        <input type="text" name="name" id="name" value="{{ $data->vehicle }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Add car name" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="plate-number" class="block text-sm font-medium text-gray-900 dark:text-white">Plate Number</label>
                        <input oninput="this.value = this.value.toUpperCase()" type="text" name="plate_number" value="{{ $data->plate_number }}" id="plate-number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="N 98** GE" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="type" class="block text-sm font-medium text-gray-900 dark:text-white">Vehicle Type</label>
                        <input type="text" name="type" value="{{ $data->type }}" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly>
                    </div>
                    <div class="mb-2">
                        <label for="category" class="block text-sm font-medium text-gray-900 dark:text-white">Vehicle Category</label>
                        <input type="text" name="category" value="{{ $data->category }}" id="category"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly>
                    </div>
                    <div class="flex items-center justify-center">
                        <a href="{{ route('vehicle.approve', ['id' => $data->id, 'status' => 'approved']) }}" class="w-1/2 mr-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Approve</a>
                        <a href="{{ route('vehicle.reject', ['id' => $data->id, 'status' => 'reject']) }}" class="w-1/2 ml-1 text-red-700 border border-red-700 hover:bg-red-800 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Reject</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>