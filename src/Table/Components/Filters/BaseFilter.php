<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters;

use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseTable;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\CanEvaluateParameters;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns\HasFormField;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns\HasLabel;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns\HasName;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns\HasQuery;
use Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters\Concerns\HasStatePath;

class BaseFilter
{
    //use CanBeHidden;
    use CanEvaluateParameters;
    use HasFormField;
    use HasLabel;
    use HasName;
    use HasQuery;

    //use HasRelationship;
    use HasStatePath;

    protected BaseTable $livewire;

    final public function __construct(protected string $name)
    {

    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    protected function setUp(): array
    {
        return [];
    }

    public function componentLivewire(BaseTable $livewire): void
    {
        if ( ! isset($this->livewire)) {
            $this->livewire = $livewire;
        }
    }

    protected function getDefaultParameters(): array
    {
        return [

        ];
    }
}
