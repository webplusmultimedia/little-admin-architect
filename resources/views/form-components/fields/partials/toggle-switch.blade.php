<button x-data="{ is_check : @entangle($attributes->wire('model')) }"
      id="{{ $attributes->get('id') }}"
      role="switch"
      class="w-10 h-5 rounded-full p-1 flex transition cursor-pointer"
      wire:ignore
      x-on:click="is_check = !is_check ?? false"
      x-bind:class="{ 'bg-primary-500' : is_check ,'bg-gray-300' : !is_check}"
      x-bind:aria-checked="is_check?.toString()"
        type="button"
>
    <span class="w-3 h-3  rounded-full border bg-white transition"
          x-bind:class="{ 'translate-x-5' : is_check }"
    ></span>
</button>
