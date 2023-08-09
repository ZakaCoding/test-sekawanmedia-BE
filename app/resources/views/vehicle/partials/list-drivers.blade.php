<div class="block">
    @foreach ($statistics as $data)
        <div class="rounded-xl p-4 bg-white mb-3 block">
            <div class="flex items-center justify-between mb-2">
                <div class="block">
                    <p class="text-slate-400">Driver</p>
                    <strong class="text-2xl">{{ $data->name }}</strong>
                </div>
                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">DONE</span>
            </div>
            <div class="p-3 px-4 mb-3 rounded-xl bg-slate-100 flex items-center justify-between">
                <div class="block">
                    <strong>Initial Miles</strong>
                    <p class="font-bold">{{ $data->initial_miles }} KM</p>
                </div>
                <div class="flex items-center justify-center">
                    <span class="p-1 rounded-lg w-[100px] mx-3 bg-violet-800"></span>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-truck-flatbed w-6 h-6 text-violet-800" viewBox="0 0 16 16">
                        <path d="M11.5 4a.5.5 0 0 1 .5.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-4 0 1 1 0 0 1-1-1v-1h11V4.5a.5.5 0 0 1 .5-.5zM3 11a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm1.732 0h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4a2 2 0 0 1 1.732 1z"/>
                    </svg>

                    <span class="p-1 rounded-lg w-[100px] mx-3 bg-violet-800"></span>
                </div>
                <div class="block">
                    <strong>Final Miles</strong>
                    <p class="font-bold">{{ $data->final_miles }} KM</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span>Total fuel consumption</span>
                <strong>{{ $data->fuel }} Liters</strong>
            </div>
        </div>
    @endforeach
</div>