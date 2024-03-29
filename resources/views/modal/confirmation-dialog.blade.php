<div class="flex flex-col space-y-2">
    <div class="flex flex-col justify-center items-center py-10 space-y-2">
       <div class="text-lg uppercase font-bold text-center">{{ $title }}</div>
       <div class="text-lg text-center">{{ $subtitle }}</div>
    </div>
    <div class="inline-flex justify-center items-center space-x-5 py-4 border-t border-gray-300 dark:border-gray-400/40">
        <x-little-anonyme::form-components.fields.button.button class="" x-on:click="close">
            {{ trans('little-admin-architect::form.button.cancel') }}
        </x-little-anonyme::form-components.fields.button.button>
        <x-little-anonyme::form-components.fields.button.submit class="{{ $btnClass }}">
            {{ $actionLabel }}
        </x-little-anonyme::form-components.fields.button.submit>
    </div>
</div>
