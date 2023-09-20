@php use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form; @endphp
<div {{ $attributes->class(['inline-flex space-x-1 bg-primary-600/30 p-1 rounded-xl']) }}>
    @foreach(Form::getNotSelectedLanguages() as $langage)
        <span wire:click="changeLanguage(@js($langage))" role="button"
              class="text-xs font-bold uppercase text-primary-600/90 bg-white px-2 rounded-xl"
        >
              {{ $langage }}
        </span>
    @endforeach
</div>
