<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Plate Numbers
                </th>
                <th scope="col" class="px-6 py-3">
                    Driver
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Details</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 0;
            @endphp
            @foreach ($rent as $data)
                @if ($data->status !== 'done')
                    
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ ++$no }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $data->plate_number }}
                        </th>
                        <td class="px-6 py-4 flex items-center justify-start">
                            <div class="rounded-full bg-slate-400 text-white w-8 h-8 p-2 flex items-center justify-center mr-2">
                                <strong>{{ substr($data->name,0,2) }}</strong>
                            </div>
                            {{ $data->name }}
                        </td>
                        <td class="px-6 py-4">
                            @switch($data->status)
                                @case('approved')
                                    <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Approved</span>
                                    @break
                                @case('reject')
                                    <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Reject</span>
                                    @break
                                @default
                                <span class="bg-orange-100 text-orange-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Pending</span>
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            {{ date('M n, Y', strtotime($data->created_at)) }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button data-modal-toggle="review-vehicle-modal-{{ $data->id }}" data-modal-target="review-vehicle-modal-{{ $data->id }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Review</button>
                        </td>
                    </tr>

                    {{-- modal --}}
                    @include('components.modals.review-vehicle-modal')
                    
                @endif
            @endforeach
        </tbody>
    </table>
</div>
