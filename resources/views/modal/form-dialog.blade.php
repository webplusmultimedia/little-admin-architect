<div class="flex flex-col space-y-2">
    <div class="flex flex-col   p-5 space-y-2 border-b">
       <div class="text-lg uppercase font-bold">{{ $title }}</div>
    </div>
    <div @class(["grid gap-5", 'lg:grid-cols-1','max-h-[calc(100vh_-_15em)] md:max-h-[calc(100vh_-_20em)] overflow-y-auto p-5'=> true]) >
        @foreach($fields as $field)
            {{ $field }}
        @endforeach
    </div>
    <div class="inline-flex justify-center items-center space-x-5 py-4 border-t border-gray-200">
        <x-little-anonyme::form-components.fields.button.button class="" x-on:click="close">
            {{ trans('little-admin-architect::form.button.cancel') }}
        </x-little-anonyme::form-components.fields.button.button>
        <x-little-anonyme::form-components.fields.button.submit class="{{ $btnClass }}">
            {{ $actionLabel }}
        </x-little-anonyme::form-components.fields.button.submit>
    </div>
</div>
