<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Request Status') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once you update request as done, it means Drivers already returns the vehicles') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-rent-update')"
    >{{ __('Mark as Done') }}</x-danger-button>

    <x-modal name="confirm-rent-update" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('rent.done', ['id' => $rent->id, 'status' => 'done']) }}" class="p-6" method="POST">
            @csrf

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to update request status?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once you update request as done, it means Drivers already returns the vehicles. you cannot update again and make sure all vehicle details (initial miles, final miles, and fuels already filled because it will impact with monitor data') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Mark as Done') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
