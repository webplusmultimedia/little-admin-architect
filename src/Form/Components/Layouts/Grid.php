<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Contracts\AbstractLayout;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Layouts\Grid\GridColumn;

final class Grid extends AbstractLayout
{
    protected string $view = 'layouts.grid';

    protected string $name = '...';

    /** @var GridColumn[] */
    protected array $gridColumns = [];

    protected string $colSpan = 'lg:col-span-full';

    public function __construct(
        public readonly int $maxColums = 2
    ) {
        parent::__construct(columns: 12);
    }

    public static function make(): Grid
    {
        return new self();
    }

    /**
     * @param  GridColumn[]  $gridColumns
     */
    public function gridColumns(array $gridColumns): Grid
    {
        $this->gridColumns = $gridColumns;

        return $this;
    }

    public function getGridColumns(): array
    {
        return $this->gridColumns;
    }

    public function initDatasFormOnMount(null|array|Model $model, BaseForm $livewire): void
    {
        /** @var GridColumn $column */
        foreach ($this->gridColumns as $column) {
            foreach ($column->getFields() as $field) {

                if ($field instanceof Field) {
                    $field->record($model);
                    $field->livewire($livewire);
                    $field->statusForm($this->form->getStatusForm());
                    Form::addFormField($field);

                    continue;
                }
                $field->setStatusForm($this->statusForm);
                $field->initDatasFormOnMount($model, $livewire);
            }
        }
    }
}
