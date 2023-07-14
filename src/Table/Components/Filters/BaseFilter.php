<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Table\Components\Filters;

use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\CanEvaluateParameters;
use Webplusmultimedia\LittleAdminArchitect\Support\Concerns\HasRelationship;
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

    final public function __construct(protected string $name)
    {
        $this->setUp();
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    protected function setUp(): void
    {

    }

    protected function getDefaultParameters(): array
    {
        return [

        ];
    }
}
