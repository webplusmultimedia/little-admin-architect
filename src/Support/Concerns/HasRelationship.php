<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Concerns;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasBelongToRelation;

trait HasRelationship
{
    protected ?string $relationship = null;

    protected mixed $valueForRelation = null;

    protected mixed $relationClass = null;

    protected ?string $labelField = null;

    protected ?Closure $queryBuilderRelation = null;

    protected ?Relation $instanceRelationCache = null;

    public function relationship(string $relationship, string $labelField, Closure $query = null): static
    {
        $this->relationship = $relationship;
        $this->labelField = $labelField;
        $this->queryBuilderRelation = $query;

        return $this;
    }

    public function hasRelationship(): bool
    {
        return null !== $this->relationship;
    }

    public function getRelationType(): string|false
    {
        try {
            if ( ! $this->relationClass) {
                $this->relationClass = get_class($this->record->{$this->relationship}());
            }

            return $this->relationClass;
        } catch (Exception) {
            return false;
        }
    }

    protected function checkRelation(): bool // check if relation in livewire record
    {
        return $this->hasRelationship() and in_array(HasBelongToRelation::class, class_uses_recursive($this), true) and BelongsToMany::class === $this->getRelationType();
    }

    protected function getInstanceRelationship(): BelongsTo|BelongsToMany
    {
        try {
            if ( ! $this->instanceRelationCache) {
                $this->instanceRelationCache = $this->record->{$this->relationship}();
            }

            return $this->instanceRelationCache;
        } catch (Exception) {
            throw new Exception('Call to a non existing relationship [' . $this->relationship . '] on Select field [' . $this->name . ']');
        }
    }

    public function getLabelField(): string
    {
        return $this->labelField;
    }

    public function getValueForRelation(): mixed
    {
        if ($this->valueForRelation) {
            return $this->valueForRelation;
        }

        return $this->record->{$this->getName()};
    }

    public function getStatePathForRelation(): string
    {
        if (BelongsToMany::class === $this->getRelationType()) {
            return $this->prefixPath . '.' . $this->name . '_relation';
        }

        return $this->getPrefixPath() . $this->name;
    }
}
