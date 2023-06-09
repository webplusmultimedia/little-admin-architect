<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

trait HasFileDirectory
{
    protected ?string $disk = null;

    protected string $baseDirectory = 'attachements';

    protected ?string $directory = null;

    protected string|Closure $visibility = 'public';

    protected bool $preserveFilenames = false;

    protected ?int $minSize = 2048;

    protected ?int $maxSize = null;

    protected int $maxFiles = 1;

    protected array $acceptedFileTypes = ['image/jpeg', 'image/png', 'image/svg+xml', 'image/webp'];

    protected bool $isMultiple = false;

    public function disk(string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    public function directory(string $directory): static
    {
        $this->directory = $directory;

        return $this;
    }

    public function preserveFilenames(bool $preserveFilenames = true): static
    {
        $this->preserveFilenames = $preserveFilenames;

        return $this;
    }

    public function getDisk(): Filesystem
    {
        return Storage::disk($this->getDiskName());
    }

    public function getDiskName(): string
    {
        return $this->disk ?? config('little-admin-architect.forms.default_filesystem_disk');
    }

    protected function getBaseDirectory(): string
    {
        return implode('/', [$this->baseDirectory, $this->directory]);
    }

    protected function getDirectory(): ?string
    {
        return $this->directory;
    }

    public function getPathFile(string $file): string
    {
        return trim($this->getBaseDirectory(), '/') . '/' . $file;
    }

    public function isPreserveFilenames(): bool
    {
        return $this->preserveFilenames;
    }

    public function acceptedFileTypes(array $acceptedFileTypes): static
    {
        $this->acceptedFileTypes = $acceptedFileTypes;

        return $this;
    }

    public function getAcceptedFileTypes(): array
    {
        return $this->acceptedFileTypes;
    }

    public function getAcceptFileTypes(): string
    {
        return implode(',', $this->acceptedFileTypes);
    }

    public function getMaxSize(): ?int
    {
        return $this->maxSize;
    }

    public function getMaxFiles(): int
    {
        return $this->maxFiles;
    }

    public function getMinSize(): ?int
    {
        return $this->minSize;
    }

    public function setMinSize(int $minSize): static
    {
        $this->minSize = $minSize;

        return $this;
    }

    public function setMaxSize(int $maxSize): static
    {
        $this->maxSize = $maxSize;

        return $this;
    }

    public function setMaxFiles(int $maxFiles): static
    {
        $this->maxFiles = $maxFiles;

        return $this;
    }

    public function setIsMultiple(bool $isMultiple): static
    {
        $this->isMultiple = $isMultiple;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->isMultiple;
    }

    public function visibility(string|Closure $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }

    protected function getVisibility(): string|Closure
    {
        return $this->visibility;
    }

    protected function getDehydrateRules(): array
    {
        $this->rules = [];
        $this->addRules('nullable');
        $this->addRules('array');
        if ($this->isMultiple and $this->maxFiles) {
            $this->addRules('max:' . $this->maxFiles);
        }

        return $this->rules;
    }

    protected function getBeforeSaveRules(): array
    {
        $this->rules = [];
        $this->addRules('nullable');
        $this->addRules('array');

        return $this->rules;
    }

    protected function getHydrateRules(): array
    {
        $this->rules = [];
        $this->addRules('array');
        if ($this->minSize) {
            $this->addRules('min:' . $this->minSize);
        }
        if ($this->maxSize) {
            $this->addRules('max:' . $this->maxSize);
        }
        $this->addRules('mimetypes:' . implode(',', $this->acceptedFileTypes));

        return $this->rules;
    }
}
