@props([])
<div  {{ $attributes->merge(['class'=>"px-6 py-4 bg-white rounded-lg border border-slate-200"]) }} {{ $attributes }}>
    {{ $slot }}
</div>
