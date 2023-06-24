<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Exception;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Str;
use League\Flysystem\UnableToCheckFileExistence;
use Livewire\TemporaryUploadedFile;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasFileDirectory;

class FileUpload extends Field
{
    use HasFileDirectory;

    protected string $view = 'file-upload-field';

    protected string $prefixName = 'data';

    protected function setUp(): void
    {
        $this->afterStateHydrated(static function (string|array|null $state, FileUpload $component): void {

            if (blank($state)) {
                $component->state([]);

                return;
            }
            //dump('afterHydrate');
            if (is_array($state)) {
                $files = collect($state);
                $files = $files->filter(
                    static function (string|array $file) use ($component): bool {
                        try {
                            if (is_array($file)) {
                                return str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists();
                            }

                            // dump($component->getDisk()->exists($component->getPathFile($file)),$component->getDisk()->directories());
                            return blank($file) || $component->getDisk()->exists($component->getPathFile($file));
                        } catch (UnableToCheckFileExistence $exception) {
                            return false;
                        }
                    }
                )
                    ->values()->all();
                // dump($files);
                $component->state($files);
            }

        });

        $this->afterStateUpdated(static function (string|array|null $state, FileUpload $component): void {
            if (blank($state)) {
                $component->state([]);
            }

            // dump('updated', $state);
            if (is_array($state)) {
                $files = collect($state);
                $files = $files->filter(function (string|array $file, $key): bool {
                    if (is_string($file)) {
                        return true;
                    }

                    return (bool) (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists());
                })->values()->all();
                //dump($files);
                $component->state($files);
            }
        });
        $this->afterStateDehydratedUsing(static function (string|array|null $state, FileUpload $component): void {
            if (blank($state)) {
                $component->state([]);

                return;
            }

            if (is_array($state)) {
                $files = collect($state);
                // dump('dehydrated', $state);
                $files = $files->filter(static function (string|array $file) use ($component): bool {
                    try {
                        if (is_string($file)) {
                            return blank($file) || $component->getDisk()->exists($component->getPathFile($file));
                        }

                        return (bool) (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists());
                    } catch (UnableToCheckFileExistence $exception) {
                        return false;
                    }
                })
                    ->values()->all();
                //dump($files);
                $component->state($files);
            }

        });
        $this->setBeforeUpdatedValidateValueUsing(static function (FileUpload $component, $state): bool {
            if (blank($state)) {
                $component->state(null);

                return true;
            }
            if (is_array($state)) {
                $files = collect($state)
                    ->map(function (string|array $file) use ($component): ?string {
                        if (is_string($file)) {
                            return $file;
                        }
                        if (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists()) {
                            return $component->saveAttachement($file);
                        }

                        return null;
                    })
                    ->filter(fn (?string $name) => ! blank($name))
                    ->values()->all();

                $component->state($files);
            }

            return true;
        });

    }

    public function saveAttachement(array $filePath): ?string
    {
        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($filePath[key($filePath)]);
        $newName = $this->isPreserveFilenames() ?
            Str::slug(str($file->getClientOriginalName())->beforeLast('.')) . '.' . $file->getClientOriginalExtension() :
            key($filePath) . '.' . $file->getClientOriginalExtension();

        $methodStore = 'public' === $this->evaluate($this->visibility) ? 'storePubliclyAs' : 'storeAs';
        try {
            $countTmp = 1;

            $tmpName = str($newName)->beforeLast('.') . "-{$countTmp}." . str($newName)->afterLast('.');
            if ($this->getDisk()->exists($this->getPathFile($newName)) and $this->isPreserveFilenames()) {
                while ($this->getDisk()->exists($this->getPathFile($tmpName))) {
                    $tmpName = str($newName)->beforeLast('.') . "-{$countTmp}." . str($newName)->afterLast('.');
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
        $rules['data.' . $this->name] = $this->getDehydrateRules();

        return $rules;
    }

    public function hydrateRules(array $rules): array
    {
        $rules['data.' . $this->name] = $this->getHydrateRules();

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
            $files = collect($value)->filter(function (string|TemporaryUploadedFile|array $file) {
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
            $this->state($files);

            return;
        }

    }

    public function getUploadFileUrlsUsing(): array
    {
        $files = [];
        foreach ($this->getState() as $file) {
            if (is_array($file)) {
                continue;
            }
            if ($details = $this->getUrlForLa($file)) {
                $files[] = $details;
            }
        }

        return $files;
    }

    protected function getUrlForLa(string $_file): ?array
    {
        $file = $this->getPathFile($_file);

        if ($storage = $this->getStorageForFile($file)) {
            return [
                'url' => $storage->url($file),
                'size' => round($storage->size($file) / 1000, 2) . 'Kb',
                'name' => basename($storage->path($file)),
            ];
        }

        return null;
    }

    public function deleteUploadFileUsing(int $key): bool
    {
        /** @var array $files */
        $files = $this->getState();
        $newFiles = collect($files)->filter(fn (string|array $file, int $index) => $index !== $key)->values()->all();
        if (is_array($files) and count($files)) {
            if ($file = collect($files)->filter(fn (string|array $file, int $index) => $index === $key)->first()) {
                if (is_string($file)) {
                    $_file = $this->getPathFile($file);
                    try {
                        $is_delete = $this->getDisk()->delete($_file);
                        if ($is_delete) {
                            $this->state($newFiles);
                        }

                        return $is_delete;
                    } catch (UnableToCheckFileExistence $exception) {
                        return false;
                    }
                }

                try {
                    $_tmpFile = TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)]);
                    $is_delete = $_tmpFile->delete();
                    if ($is_delete) {
                        $this->state($newFiles);
                    }

                    return $is_delete;
                } catch (Exception $exception) {
                    return false;
                }
            }
        }

        return true;
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
}
