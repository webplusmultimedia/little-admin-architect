<div class="flex flex-col space-y-2">
    <div class="flex flex-col justify-center items-center py-10 space-y-2">
       <span class="text-lg uppercase font-bold">{{ $title }}</span>
       <span class="text-lg">{{ $subtitle }}</span>
    </div>
    <div class="inline-flex justify-center items-center space-x-5 py-4 border-t border-gray-300">
        <x-little-anonyme::form-components.fields.button.button class="" x-on:click="close">
            {{ trans('little-admin-architect::form.button.cancel') }}
        </x-little-anonyme::form-components.fields.button.button>
        <x-little-anonyme::form-components.fields.button.submit class="btn-danger">
            {{ $actionLabel }}
        </x-little-anonyme::form-components.fields.button.submit>
    </div>
</div>
