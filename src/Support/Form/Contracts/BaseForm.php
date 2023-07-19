<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Form\Contracts;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Actions\Button;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanGetRules;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanInitDatasForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanListOptionsForSelect;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanSearchResultsUsingForSelect;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanUpdatedDatas;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanValidatedValues;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasDefaultValue;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasFields;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasState;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\HasTitle;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\InteractsWithUploadFiles;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasSchema;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\InteractWithPage;
use Webplusmultimedia\LittleAdminArchitect\Support\Form\Concerns\CanAuthorizeAccess;

abstract class BaseForm
{
    use CanAuthorizeAccess;
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
    use HasState;
    use HasTitle;
    use InteractsWithUploadFiles;
    use InteractWithPage;

    protected string $view = '';

    protected ?string $statusForm = null;

    protected string $action = 'save';

    protected string $type = 'submit';

    protected string $caption = 'Enregistrer';

    protected Button $buttonSave;

    protected Button $buttonCancel;

    protected \Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm|Component $livewire;

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
