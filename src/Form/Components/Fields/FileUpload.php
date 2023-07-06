<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Bkwld\Croppa\Facades\Croppa;
use Exception;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Str;
use League\Flysystem\UnableToCheckFileExistence;
use Livewire\TemporaryUploadedFile;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasFileDirectory;

class FileUpload extends Field
{
    use HasFileDirectory;

    protected string $view = 'file-upload';

    public function setUp(): void
    {
        $this->setViewDatas('field', $this);
        $this->afterStateHydrated(static function (string|array|null $state, FileUpload $component): void {
            if (blank($state)) {
                $component->state([]);

                return;
            }

            if (is_array($state)) {
                $files = collect($state);
                $files = $files
                    ->filter(
                        static function (string|array $file) use ($component): bool {
                            try {
                                if (is_array($file) and isset($file['file']) and isset($file['delete']) and isset($file['id'])) {
                                    return true;
                                }

                                if (is_array($file)) {
                                    return str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists();
                                }

                                return blank($file) || $component->getDisk()->exists($component->getPathFile($file));
                            } catch (UnableToCheckFileExistence $exception) {
                                return false;
                            }
                        }
                    )
                    ->map(static function (string|array $file) {
                        if (is_string($file)) {
                            return ['file' => $file, 'delete' => false, 'id' => Str::uuid()->toString()];
                        }

                        return $file;
                    })
                    ->values()
                    ->all();

                $component->state($files);
            }
        });

        $this->afterStateUpdated(static function (array|null $state, FileUpload $component): void {
            if (blank($state)) {
                $component->state([]);
            }

            $files = collect($state);
            $files = $files->filter(function (array $file, $key): bool {
                if (is_array($file) and isset($file['file']) and isset($file['delete']) and isset($file['id'])) {
                    return true;
                }

                return (bool) (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists());
            })->values()->all();

            $component->state($files);
        });

        $this->afterStateDehydratedUsing(static function (array|null $state, FileUpload $component): void {
            if (blank($state)) {
                $component->state([]);

                return;
            }
            $files = collect($state);
            $files = $files
                ->filter(static function (string|array $file): bool {
                    try {
                        if (is_array($file) and isset($file['file']) and isset($file['delete']) and isset($file['id'])) {
                            return true;
                        }

                        if (is_string($file)) {
                            return true;
                        }

                        return (bool) (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists());
                    } catch (UnableToCheckFileExistence $exception) {
                        return false;
                    }
                })
                ->map(function (string|array $file) {
                    if (is_string($file)) {
                        return ['file' => $file, 'delete' => false, 'id' => Str::uuid()->toString()];
                    }

                    return $file;
                })
                ->values()->all();

            $component->state($files);
        });

        $this->setBeforeUpdatedValidateValueUsing(static function (FileUpload $component, null|array $state): bool {
            if (blank($state)) {
                $component->state(null);

                return true;
            }

            $files = collect($state)
                ->map(function (array $file) use ($component): ?string {
                    if (is_array($file) and isset($file['file']) and isset($file['delete']) and ! $file['delete']) {
                        return $file['file'];
                    }

                    if (is_array($file) and isset($file['file']) and isset($file['delete']) and $file['delete']) {
                        $_file = $component->getPathFile($file['file']);
                        if ($component->getDisk()->exists($_file)) {
                            Croppa::reset(str($_file)->prepend('storage/')->toString());
                            $component->getDisk()->delete($_file);
                        }

                        return null;
                    }

                    if (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists()) {
                        return $component->saveAttachement($file);
                    }

                    return null;
                })
                ->filter(fn (?string $name) => ! blank($name))
                ->values()->all();
            if (blank($files)) {
                $component->state(null);

                return true;
            }
            $component->state($files);

            return true;
        });

    }

    protected function beforeValidateValueUsing(): bool
    {
        return $this->evaluate($this->beforeUpdatedValidateValueUsing);
    }

    public function saveAttachement(array $filePath): ?string
    {
        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($filePath[key($filePath)]);
        $newName = $this->isPreserveFilenames() ?
            Str::slug(str($file->getClientOriginalName())->beforeLast('.'), '_') . '.' . $file->getClientOriginalExtension() :
            key($filePath) . '.' . $file->getClientOriginalExtension();

        $methodStore = 'public' === $this->evaluate($this->visibility) ? 'storePubliclyAs' : 'storeAs';
        try {
            $countTmp = 1;

            $tmpName = str($newName)->beforeLast('.') . "-{$countTmp}." . str($newName)->afterLast('.');
            if ($this->getDisk()->exists($this->getPathFile($newName)) and $this->isPreserveFilenames()) {
                while ($this->getDisk()->exists($this->getPathFile($tmpName))) {
                    $tmpName = str($newName)->beforeLast('.') . "_{$countTmp}." . str($newName)->afterLast('.');
                    $countTmp++;
                }
                $newName = $tmpName;

            }
        } catch (UnableToCheckFileExistence $exception) {
            return null;
        }

        $path = $file->storePubliclyAs($this->getBaseDirectory(), $newName, $this->getDiskName());
        if ($path) {
            $file->delete();

            return $newName;
        }

        return null;
    }

    public function dehydrateRules(array $rules): array
    {
        $rules['data.' . $this->getName()] = $this->getDehydrateRules();

        return $rules;
    }

    public function hydrateRules(array $rules): array
    {
        $rules['data.' . $this->getName()] = $this->getHydrateRules();

        return $rules;
    }

    public function beforeSaveRulesUsing(array $rules): array
    {
        $rules['data.' . $this->getName()] = $this->getBeforeSaveRules();

        return $rules;
    }

    public function setState(mixed $value): void
    {
        if (is_array($value)) {
            $newFiles = collect($value)->filter(function (string|TemporaryUploadedFile|array $file) {
                if ($file instanceof TemporaryUploadedFile) {
                    return $file->exists();
                }

                return true;
            })->map(function (string|array|TemporaryUploadedFile $file) {
                if ($file instanceof TemporaryUploadedFile) {
                    return [(string) Str::uuid() => $file->serializeForLivewireResponse()];
                }

                return $file;
            })->all();

            $this->state($newFiles);
        }
    }

    public function getUploadFileUrlsUsing(): array
    {
        $files = [];
        /** @var string[]|string $file */
        foreach ($this->getState() as $file) {
            //is temp File
            if (is_array($file) and ! isset($file['file']) and ! isset($file['delete'])) {
                continue;
            }
            // a file without delete
            if (is_array($file) and isset($file['file']) and isset($file['delete']) and ! $file['delete']) {
                if ($details = $this->getUrlForLa($file['file'])) {
                    $details['id'] = $file['id'];
                    $files[] = $details;
                }
            }

        }

        return $files;
    }

    protected function getUrlForLa(string $_file): ?array
    {
        $file = $this->getPathFile($_file);

        if ($storage = $this->getStorageForFile($file)) {
            return [
                'url' => Croppa::url(str($file)->prepend('storage/')->toString(), 320, 200),
                'size' => round($storage->size($file) / 1000, 2) . 'Kb',
                'name' => basename($storage->path($file)),
            ];
        }

        return null;
    }

    private function getStorageForFile(string $file): ?FilesystemAdapter
    {
        /** @var FilesystemAdapter $storage */
        $storage = $this->getDisk();
        try {
            if ( ! $storage->exists($file)) {
                return null;
            }
        } catch (UnableToCheckFileExistence $exception) {
            return null;
        }

        return $storage;
    }

    public function deleteUploadFileUsing(string $key): bool
    {
        /** @var array $files */
        $files = $this->getState();
        $filesWithoutTmpFileToDelete = collect($files)
            ->filter(function (array $file, int $index) use ($key) {
                if (isset($file['file']) and isset($file['delete'])) {
                    return true;
                }
                if (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists()) {
                    return key($file) !== $key;
                }

                return false;
            })
            ->values()
            ->all();

        $fileToDelete = collect($files)
            ->filter(function (array $file, int $index) use ($key) {
                if (isset($file['file']) and isset($file['delete']) and ! $file['delete']) {
                    return $file['id'] === $key;
                }
                if ( ! isset($file['file']) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists()) {
                    return key($file) === $key;
                }

                return false;
            })
            ->first();

        if ($fileToDelete) {
            if (isset($fileToDelete['file']) and
                isset($fileToDelete['delete']) and ! $fileToDelete['delete']
            ) {
                $state = collect($files)
                    ->map(function (array $file) use ($key) {
                        if (isset($file['file']) and isset($file['delete']) and ! $file['delete'] and $file['id'] === $key) {
                            $file['delete'] = true;
                        }

                        return $file;
                    })->all();
                $this->state($state);

                return true;
            }

            try {
                $_tmpFile = TemporaryUploadedFile::unserializeFromLivewireRequest($fileToDelete[key($fileToDelete)]);
                $is_delete = $_tmpFile->delete();
                if ($is_delete) {
                    $this->state($filesWithoutTmpFileToDelete);
                }

                return $is_delete;
            } catch (Exception $exception) {
                return false;
            }
        }

        return false;
    }

    public function reorder(array $newOrder): array
    {
        $values = [];
        $state = $this->getState();
        foreach ($newOrder as $order) {
            if (isset($state[(int) $order])) {
                $values[] = $state[(int) $order];
            }
        }
        if (blank($values)) {
            return [];
        }
        $this->state($values);

        return $this->getUploadFileUrlsUsing();
    }
}
