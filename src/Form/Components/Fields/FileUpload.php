<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Exception;
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
                $files = $files->filter(static function (string|array $file) use ($component): bool {
                    try {

                        if (is_array($file)) {
                            return str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists();
                        }

                        // dump($component->getDisk()->exists($component->getPathFile($file)),$component->getDisk()->directories());
                        return blank($file) || $component->getDisk()->exists($component->getPathFile($file));
                    } catch (UnableToCheckFileExistence $exception) {
                        return false;
                    }
                })
                    ->map(static function (string|array $file, mixed $key): array {
                        if (is_array($file)) {
                            if (str($file[key($file)])->startsWith('livewire-file:')) {
                                return [key($file) => $file[key($file)]];
                            }
                            //return $file;
                        }

                        return $file;
                    })
                    ->all();
                //dump($files);
                $component->state($files);
            }

        });

        $this->afterStateUpdated(static function (string|array|null $state, FileUpload $component): void {
            if (blank($state)) {
                $component->state([]);
            }

            // dump('updated', $state);
            $files = collect($state);
            $files = $files->map(function (string|array|TemporaryUploadedFile $file, $key) {

                if ($file instanceof TemporaryUploadedFile) {
                    return [(string) Str::uuid() => $file->serializeForLivewireResponse()];
                }

                if (is_array($file)) {
                    if ($file[key($file)] instanceof TemporaryUploadedFile) {
                        dump($file);

                        return [(string) Str::uuid() => $file[key($file)]->serializeForLivewireResponse()];
                    }
                    if (str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists()) {
                        return $file;
                    }
                    // return str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::createFromLivewire($file[key($file)])->exists();
                }

                return [$key => $file];
            })->all();
            //dump($files);
            $component->state($files);
        });
        $this->afterStateDehydratedUsing(static function (string|array|null $state, FileUpload $component): void {
            if (blank($state)) {
                $component->state([]);

                return;
            }
            $files = collect($state);
            //dump('dehydrated', $state);
            $files = $files->filter(static function (mixed $file) use ($component): bool {
                try {
                    if (is_array($file)) {
                        if ($file[key($file)] instanceof TemporaryUploadedFile) {
                            return $file[key($file)]->exists();
                        }
                        // dump($file[key($file) ]);
                        try {
                            return str($file[key($file)])->startsWith('livewire-file:');
                        } catch (Exception $e) {
                            //dd($file[key($file)], $file, $e->getMessage());
                            return false;
                        }
                    }

                    return blank($file) || $component->getDisk()->exists($file);
                } catch (UnableToCheckFileExistence $exception) {
                    return false;
                }
            })
                ->map(static function (string|array $file, mixed $key): array {
                    if (is_array($file)) {
                        if (str($file[key($file)])->startsWith('livewire-file:')) {
                            return [key($file) => $file[key($file)]];
                        }
                        //return $file;
                    }

                    return [/*(is_int($key) ? (string) Str::uuid() : $key) =>*/ $file];
                })
                ->all();
            //dump($files);
            $component->state($files);

        });
        $this->setBeforeUpdatedValidateValueUsing(static function (FileUpload $component, $state): bool {
            if (blank($state)) {
                $component->state(null);

                return true;
            }
            $files = collect($state)->map(function (string|array $file) use ($component) {
                if (is_string($file)) {
                    return $file;
                }
                if (is_array($file) and str($file[key($file)])->startsWith('livewire-file:') and TemporaryUploadedFile::unserializeFromLivewireRequest($file[key($file)])->exists()) {
                    return $component->saveAttachement($file);
                }

                return null;
            })->filter(fn (?string $file) => is_string($file))->all();
            if (blank($state)) {
                $component->state(null);

                return true;
            }
            $component->state($files);

            return true;
        });

    }

    public function saveAttachement(array $filePath): string
    {
        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($filePath[key($filePath)]);
        $name = $this->isPreserveFilenames() ? Str::slug($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension() : key($filePath) . '.' . $file->getClientOriginalExtension();

        $methodStore = 'public' === $this->evaluate($this->visibility) ? 'storePubliclyAs' : 'storeAs';
        $path = $file->storeAs($this->getBaseDirectory(), $name);
        $file->delete();

        return $name;
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

            return;
        }

    }
}
