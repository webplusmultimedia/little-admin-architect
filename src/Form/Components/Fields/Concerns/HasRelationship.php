<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Relation;

trait HasRelationship
{
    protected ?string $relationship = null;

    protected mixed $valueForRelation = null;

    protected mixed $statePathForRelation = null;

    protected ?string $labelField = null;

    protected ?Closure $queryBuilderRelation = null;

    protected Relation|null $instanceRelationCache = null;

    public function relationship(string $relationship, string $labelField, null|Closure $query = null): static
    {
        $this->relationship = $relationship;
        $this->labelField = $labelField;
        $this->queryBuilderRelation = $query;

        return $this;
    }

    public function hasRelationship(): bool
    {
        return (bool) $this->relationship;
    }

    public function getRelationType(): string|false
    {
        try {
            return get_class($this->record->{$this->relationship}());
        } catch (Exception) {
            return false;
        }
    }

    protected function getInstanceRelationship(): BelongsTo|BelongsToMany|null
    {
        try {
            if ( ! $this->instanceRelationCache) {
                $this->instanceRelationCache = $this->record->{$this->relationship}();
            }

            return $this->instanceRelationCache;
        } catch (Exception) {
            return null;
        }
    }

    protected function getLabelField(): string
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
