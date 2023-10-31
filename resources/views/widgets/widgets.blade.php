@props([
	'widgets' => []
])
<div>
    @php
        use Webplusmultimedia\LittleAdminArchitect\Admin\Widgets\WidgetConfiguration;

		$normalizeWidgetClass = function (string | WidgetConfiguration $widget): string {
            if ($widget instanceof WidgetConfiguration) {
                return $widget->widget;
            }

            return $widget;
        };
    @endphp

    @foreach($widgets as $key=>$widget)
        <div class="py-4">
            @livewire(
	            $normalizeWidgetClass($widget),
                [...($widget instanceof WidgetConfiguration ? [...$normalizeWidgetClass($widget)::getDefaultProperties(),...$widget->properties ]: $widget::getDefaultProperties())]
            )
        </div>
    @endforeach
</div>
