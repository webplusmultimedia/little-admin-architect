<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasOptions;

class CheckBoxList extends Field
{
    use HasGridColumns;
    use HasOptions;

    protected string $view = 'check-box-list';

    public function getValue(): mixed
    {
        if ($this->getRecord()->{$this->getName()}) {
            return $this->getRecord()->{$this->getName()};
        }

        return [];
    }

    protected function beforeValidateValueUsing(): bool
    {
        return $this->evaluate($this->beforeUpdatedValidateValueUsing);
    }

    public function setUp(): void
    {
        $this->afterStateHydrated(static function (?array $state, CheckBoxList $component): void {
            if (blank($state)) {
                $component->state([]);
            }
        });

        $this->setBeforeUpdatedValidateValueUsing(static function (?array $state, CheckBoxList $component): bool {
            if (blank($state)) {
                if ($component->isNullable()) {
                    $component->state(null);

                    return true;
                }

                $component->state([]);
            }

            return true;
        });
    }
}
