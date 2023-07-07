<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanSearchWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBelongToRelation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasOptions;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\Select\ContainMessageForComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\Select\hasDynamicDatas;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\SelectHasDefaultLabel;

class Select extends Field
{
    use CanSearchWithLivewire;
    use ContainMessageForComponent;
    use HasBelongToRelation;
    use hasDynamicDatas;
    use HasOptions;
    use SelectHasDefaultLabel;

    protected string $view = 'select';

    public function setUp(): void
    {
        $this->setViewDatas('field', $this);
        if ($this->hasRelationship()) {
            $this->options([]);
            if (BelongsTo::class === $this->getRelationType()) {
                $this->isMultiple = false;
            }
            if (BelongsToMany::class === $this->getRelationType()) {
                $this->isMultiple = true;
                $this->searchable = true;
            }

            if ( ! $this->isMultiple()) {
                $this->getOptionsUsing(static function (Select $component): Collection {
                    $query = $component->getBuilderRelationship();

                    if ($component->searchable) {
                        return $query
                            ->limit($component->loadLimit)
                            ->get()
                            ->pluck(value: $component->getLabelField(), key: 'id');
                    }

                    return $component->getBuilderRelationship()
                        ->get()
                        ->pluck(value: $component->getLabelField(), key: 'id');
                });

                $this->getSelectOptionLabelUsing(static function (Select $component, mixed $state): ?string {
                    $model = $component->getBuilderRelationship()->getModel();

                    return $model->find($state)?->{$component->getLabelField()};
                });

            } else {
                $this->dynamicOptions = true;
                $this->getSelectOptionLabelUsing(static function (Select $component, Collection|array $state): Collection {
                    $model = $component->getBuilderRelationship()->getModel();
                    if ($state instanceof Collection) {
                        return $state->pluck(value: $component->getLabelField(), key: 'id');
                    }

                    return $model->whereIn($model->getKeyName(), $state)->get()->pluck(value: $component->getLabelField(), key: 'id');
                });

                $this->afterStateHydrated(static function (Collection|array|null $state, Select $component): void {
                    $model = $component->getBuilderRelationship()->getModel();
                    if (blank($state)) {
                        $state = [];
                    }
                    if ($state instanceof Collection) {
                        $state = $state->map(function ($value) use ($model) {
                            if ($value instanceof Model) {
                                return $value->{$model->getKeyName()};
                            }

                            return $value;

                        })->all();
                        $component->state($state);
                    }
                });

                $this->afterStateUpdated(static function (Collection|array $state, Select $component): void {
                    $model = $component->getBuilderRelationship()->getModel();
                    if ($state instanceof Collection) {
                        $state = $state->map(function ($value) use ($model) {
                            if ($value instanceof Model) {
                                return $value->{$model->getKeyName()};
                            }

                            return $value;

                        })->all();

                        $component->state($state);
                    }
                });

                $this->afterStateDehydratedUsing(static function (Collection|array|null $state, Select $component): void {
                    $model = $component->getBuilderRelationship()->getModel();
                    if (blank($state)) {
                        $state = [];
                    }
                    if (is_array($state)) {
                        $state = collect($state)->map(function ($value) use ($model) {
                            if (is_array($value)) {
                                return $value[$model->getKeyName()];
                            }

                            return $value;

                        })->all();

                        $component->state($state);
                    }
                });

                $this->setBeforeUpdatedValidateValueUsing(static function (array $state, Select $component): bool {
                    return false;
                });
                $this->setBeforeCreatedValidateValueUsing(static function (array $state, Select $component): bool {
                    return false;
                });

            }
            $this->getSearchResultsUsing(static function (Select $component, string $search): Collection {
                return $component->getBuilderRelationship()
                    ->where($component->getLabelField(), 'like', '%' . $search . '%')
                    ->limit($component->loadLimit)
                    ->get()
                    ->pluck(value: $component->getLabelField(), key: 'id');
            });
        }

    }
}
