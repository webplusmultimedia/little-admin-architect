<button x-data="{ is_check : @entangle($attributes->wire('model')) }"
      id="{{ $attributes->get('id') }}"
      role="switch"
      class="w-12 h-7 rounded-full p-1 bg-gray-200 flex transition cursor-pointer"
      wire:ignore
      x-on:click="is_check = !is_check ?? false; console.log(is_check)"
      x-bind:class="{ 'bg-primary-500' : is_check}"
      x-bind:aria-checked="is_check?.toString()"
        type="button"
>
    <span class="w-5 h-5  rounded-full border bg-white transition"
          x-bind:class="{ 'translate-x-full' : is_check }"
    ></span>
</button>
