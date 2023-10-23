<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Admin\Livewire\Components\BaseForm;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanSearchWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBelongToRelation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasFormAction;
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
    use HasFormAction;
    use HasOptions;
    use SelectHasDefaultLabel;

    protected string $view = 'little-views::form-components.fields.select';

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

            if ($this->hasFormAction()) {
                $model = new ($this->getInstanceRelationship()->getModel())();

                $this->formAction
                    ->record($model)
                    ->setUp($this->getStatePath());
            }

            if ( ! $this->isMultiple()) {
                $this->getOptionsUsing(static function (Select $component): Collection {
                    $query = $component->getBuilderRelationship();
                    $model = $query->getModel();

                    if ($component->searchable) {
                        return $query
                            ->limit($component->loadLimit)
                            ->get()
                            ->pluck(value: $component->getLabelField(), key: $model->getKeyName());
                    }

                    return $component->getBuilderRelationship()
                        ->get()
                        ->pluck(value: $component->getLabelField(), key: $model->getKeyName());
                });

                $this->getSelectOptionLabelUsing(static function (Select $component, mixed $state): ?string {
                    $model = $component->getBuilderRelationship()->getModel();

                    return $model->find($state)?->{$component->getLabelField()};
                });

            } else {
                $this->dynamicOptions = true;
                $this->getSelectOptionLabelUsing(static function (Select $component, array $state): Collection {
                    $model = $component->getBuilderRelationship()->getModel();

                    return $model->whereIn($model->getKeyName(), $state)->get()->pluck(value: $component->getLabelField(), key: $model->getKeyName());
                });

                $this->afterStateHydrated(static function (array $state, Select $component): void {
                    // $component->livewire->record[$component->getName()] = $state;
                    $component->state($state);
                });

                $this->afterStateUpdated(static function (?array $state, Select $component): void {
                    if (blank($state)) {
                        $state = [];
                    }
                    //$component->livewire->record[$component->getName()] = $state;
                    $component->state($state);
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

            }
            $this->getSearchResultsUsing(static function (Select $component, string $search): Collection {
                $model = $component->getBuilderRelationship()->getModel();

                return $component->getBuilderRelationship()
                    ->where($component->getLabelField(), 'like', '%' . $search . '%')
                    ->limit($component->loadLimit)
                    ->get()
                    ->pluck(value: $component->getLabelField(), key: $model->getKeyName());
            });
        } else {
            $this->formAction = null;
        }

        if ($this->selectOptionLabelUsing() and ! $this->isMultiple()) {
            $this->setDefaultLabelForSelect();
        }

    }

    public function getClearEventName(): ?string
    {
        return $this->getStatePath() . '.' . $this->clearEventName;
    }

    public function eventToGetLabel(): string
    {
        return $this->getStatePath() . '.getLabel_event';
    }

    public function createOption(): void
    {
        if ($this->livewire instanceof BaseForm) {
            $this->livewire->mountFormAction = 'createOption';
            $this->showFormActionComponent();
        }
    }

    public function getSearchResultUsing(string $term): array
    {
        $options = [];
        $results = $this->evaluate(closure: $this->searchResultsUsing, include: ['search' => $term]);
        if ($results instanceof Collection) {
            $res = $results->map(fn ($value, $key) => ['value' => $key, 'label' => $value])->values()->toArray();

            return $res;
        }

        return $options;
    }

    public function getOptionUsing(string $name): array
    {

        /** @var Collection|array<null> $results */
        $results = $this->evaluate($this->optionsUsing);
        $options = [];
        if ($results instanceof Collection) {
            return $results->map(fn ($value, $key) => ['value' => $key, 'label' => $value])->values()->toArray();
        }

        return $options;
    }
}
