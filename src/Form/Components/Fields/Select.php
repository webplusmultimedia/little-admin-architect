<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Support\Collection;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Concerns\CanSearchWithLivewire;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBelongToRelation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasOptions;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\Select\ContainMessageForComponent;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\SelectHasDefaultLabel;

class Select extends Field
{
    use CanSearchWithLivewire;
    use ContainMessageForComponent;
    use HasBelongToRelation;
    use HasOptions;
    use SelectHasDefaultLabel;

    protected string $view = 'select';

    public function setUp(): void
    {
        if ($this->hasRelationship()) {
            $this->options([]);

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
                $this->getSelectOptionLabelUsing(static function (Select $component, array $state): Collection {
                    $model = $component->getBuilderRelationship()->getModel();

                    return $model->whereIn($model->getKeyName(), $state)->get()->pluck(value: $component->getLabelField(), key: 'id');
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
