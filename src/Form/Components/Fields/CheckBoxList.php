<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBelongToRelation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasGridColumns;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasOptions;

class CheckBoxList extends Field
{
    use HasBelongToRelation;
    use HasGridColumns;
    use HasOptions;

    protected string $view = 'little-views::form-components.fields.check-box-list';

    protected mixed $defaultValue = [];

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
        $this->setViewDatas('field', $this);
        if ($this->hasRelationship() and BelongsToMany::class === $this->getRelationType()) {
            $this->options(static function (CheckBoxList $component): array {
                $model = $component->getBuilderRelationship()->getModel();

                return $component->getBuilderRelationship()
                    ->get()
                    ->pluck(value: $component->getLabelField(), key: $model->getKeyName())->toArray();

            });
            $this->afterStateDehydratedUsing(static function (array $state): array {
                return $state;
            });

            $this->setBeforeUpdatedValidateValueUsing(static function (Collection|array $state, Select $component): bool {
                return false;
            });
            $this->setBeforeCreatedValidateValueUsing(static function (Collection|array $state, Select $component): bool {
                return false;
            });

            $this->afterStateHydrated(static function (?array $state, CheckBoxList $component): void {
                if (null === $state) {
                    $component->state([]);
                }
                $component->state($state);
                $values = $component->getState();
                $model = $component->getBuilderRelationship()->getModel();
                $component->addRules('array');
                $partialRules = str($model->getTable())->append(',', $model->getKeyName())->value();
                $component->addRules('exists:' . $partialRules);
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

        } else {

            $this->addRules('array');
            $this->addRules('in:' . implode(',', array_keys($this->evaluate($this->options))));

            $this->afterStateHydrated(static function (?array $state, CheckBoxList $component): void {
                if (null === $state) {
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
}
