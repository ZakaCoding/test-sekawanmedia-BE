<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Vehicle Detail') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Once request status is APPROVED by Supervisor, you need to update this data for monitoring") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('vehicle.update.rent', ['id' => $rent->id]) }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="initial_miles" :value="__('Initial Miles')" />
            <x-text-input id="initial_miles" name="initial_miles" type="number" class="mt-1 block w-full" :value="$latest->final_miles ?? '0'" />
        </div>

        <div>
            <x-input-label for="final_miles" :value="__('Finish Miles')" />
            <x-text-input id="final_miles" name="final_miles" type="number" class="mt-1 block w-full" :value="$rent->final_miles ?? 0" />
        </div>

        <div>
            <x-input-label for="fuel" :value="__('Fuels')" />
            <x-text-input id="fuel" name="fuel" type="number" class="mt-1 block w-full" :value="$rent->fuel ?? 0" />
            <small class="text-gray-400">add total fuel consumption in liters</small>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (Session::has('success-vehicle'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
