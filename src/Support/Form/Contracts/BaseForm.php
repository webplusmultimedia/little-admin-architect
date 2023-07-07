<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Form\Contracts;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Button;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanGetRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanInitDatasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanListOptionsForSelect;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanSearchResultsUsingForSelect;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanUpdatedDatas;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanValidatedValues;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasDefaultValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasSelectOptionLabelUsing;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasState;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasTitle;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\InteractsWithUploadFiles;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasSchema;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;

abstract class BaseForm
{
    use CanGetRules;
    use CanInitDatasForm;
    use CanListOptionsForSelect;
    use CanSearchResultsUsingForSelect;
    use CanUpdatedDatas;
    use CanValidatedValues;
    use HasDefaultValue;
    use HasFields;
    use HasGridColumns;
    use HasSchema;
    use HasSelectOptionLabelUsing;
    use HasState;
    use HasTitle;
    use InteractsWithUploadFiles;
    use InteractWithPage;

    protected ?string $statusForm = null;

    protected string $action = 'save';

    protected string $type = 'submit';

    protected string $caption = 'Enregistrer';

    protected Button $buttonSave;

    protected Button $buttonCancel;

    protected ?string $livewireId = null;

    /**
     * @var Model|array<string,string>|null
     */
    protected null|Model|array $model = null;

    public function getStatusForm(): ?string
    {
        return $this->statusForm;
    }

    public function __construct(
        public string $title = ''
    ) {
        $this->buttonSave = Button::make(trans('little-admin-architect::form.button.save'), $this->type, $this->action)->icon('heroicon-s-check');

    }
}
