<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasBelongToRelation
{
    protected ?string $relationship = null;

    protected ?Builder $relationshipBuilder = null;

    protected ?string $labelField = null;

    protected ?Closure $queryBuilderRelation = null;

    public function relationship(string $relationship, string $labelField, null|Closure $query = null): static
    {

        $this->relationship = $relationship;
        $this->labelField = $labelField;
        $this->queryBuilderRelation = $query;

        return $this;
    }

    protected function getBuilderRelationship(): Builder
    {
        try {
            if (null === $this->relationshipBuilder) {

                if ( $this->getRecord()->{$this->relationship}() instanceof BelongsTo or $this->getRecord()->{$this->relationship}() instanceof HasMany) {
                    if ($this->getRecord()->{$this->relationship}() instanceof BelongsTo and ! $this->isMultiple()) {
                        $this->relationshipBuilder = $this->getRecord()->{$this->relationship}()->getModel()->query();
                    }
                }
                else{
                    throw new Exception('Need only BelongsTo/HasMany  relationship on Select field [' . $this->name . ']');
                }

                /*if ($this->getRecord()->{$relationship}() instanceof HasMany and $this->isMultiple()){
                    $this->relationship = $this->getRecord()->{$relationship}()->getModel()->query();
                }*/
            }

        } catch (Exception $e) {
            throw new Exception('Call to a non existing relationship [' . $this->relationship . '] on Select field [' . $this->name . ']');
        }

        if (is_callable($this->queryBuilderRelation)) {
            return app()->call($this->queryBuilderRelation, ['builder' => $this->relationshipBuilder]);
        }

        return $this->relationshipBuilder;
    }

    public function hasRelationship(): bool
    {
        return ! ( ! $this->relationship);
    }

    protected function getLabelField(): string
    {
        return $this->labelField;
    }
}
