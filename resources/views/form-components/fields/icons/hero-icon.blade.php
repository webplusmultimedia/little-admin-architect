@props(['name'])
@svg($name,$attributes->merge(['class'=>'w-5 h-5'])->get('class'),$attributes->except(['class','name'])->getAttributes())
