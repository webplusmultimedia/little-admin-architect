<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasName
{
    protected string $name;

    protected ?string $prefixPath = 'data';

    protected string $prefixRelationPath = 'record';

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWireName(): string
    {
        return $this->getPrefixPath() . $this->name;
    }

    public function getStatePath(): string
    {
        if ($this->checkRelation()) {
            return $this->getPrefixRelationPath() . $this->name;
        }

        return $this->getPrefixPath() . $this->name;
    }

    protected function getPrefixPath(): string
    {
        /* if ($this->record instanceof Model) {*/
        return $this->prefixPath . '.';
        // }

        // return '';
    }

    public function setPrefixPath(string $prefixPath): void
    {
        $this->prefixPath = $prefixPath;
    }

    public function getPrefixRelationPath(): string
    {
        return $this->prefixRelationPath . '.';
    }

    public function setPrefixRelationPath(string $prefixRelationPath): void
    {
        $this->prefixRelationPath = $prefixRelationPath;
    }
}
