@props(['name'])
@svg($name,$attributes->class(['w-5 h-5'])->get('class'),$attributes->except(['class','name'])->getAttributes())
