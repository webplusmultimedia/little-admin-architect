<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

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
                    ->all();
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
                })->all();
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
                    ->all();
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
                $files = collect($state)->map(function (string|array $file) use ($component) {
                    if (is_string($file)) {
                        return $file;
                    }
                    if (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists()) {
                        return $component->saveAttachement($file);
                    }

                    return null;
                })->all();
                /* if (blank($state)) {
                     $component->state(NULL);

                     return true;
                 }*/
                $component->state($files);
            }

            return true;
        });

    }

    public function saveAttachement(array $filePath): ?string
    {
        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($filePath[key($filePath)]);
        $newName = $this->isPreserveFilenames() ? Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension() : key($filePath) . '.' . $file->getClientOriginalExtension();

        $methodStore = 'public' === $this->evaluate($this->visibility) ? 'storePubliclyAs' : 'storeAs';
        $path = $file->storePubliclyAs($this->getBaseDirectory(), $newName, $this->getDiskName()); //$this->getDisk()->move($file->path(),$this->getPathFile($newName));
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

        if ($value instanceof TemporaryUploadedFile and $value->exists()) {
            dump('temp');

        }
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

            //dump($files,$this->getState());

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

        /** @var FilesystemAdapter $storage */
        $storage = $this->getDisk();
        try {
            if ( ! $storage->exists($file)) {
                return null;
            }
        } catch (UnableToCheckFileExistence $exception) {
            return null;
        }

        return [
            'url' => $storage->url($file),
            'size' => round($storage->size($file) / 1000, 2) . 'kb',
            'name' => basename($storage->path($file)),
        ];
    }
}
