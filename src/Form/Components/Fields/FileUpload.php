<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use League\Flysystem\UnableToCheckFileExistence;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns\HasFileDirectory;

class FileUpload extends Field
{
    use HasFileDirectory;

    protected string $view = 'file-upload-field';

    protected function setUp(): void
    {
        $this->afterStateHydrated(static function (string|array|null $state, FileUpload $component): void {
            if (blank($state)) {
                $component->state([]);

                return;
            }
            $files = collect(Arr::wrap($state));
            if ( ! is_int(key($files->first()))) {
                $files = $files->filter(static function (string $file) use ($component): bool {
                    try {
                        return blank($file) || $component->getDisk()->exists($file);
                    } catch (UnableToCheckFileExistence $exception) {
                        return false;
                    }
                })
                    ->mapWithKeys(static fn (string $file, mixed $key): array => [((string) Str::uuid()) => $file])
                    ->all();

                $component->state($files);
            }
        });
        $this->beforeUpdatedValidateValueUsing = static function (FileUpload $component, $state): bool {
            if (blank($state)) {
                $component->state(null);

                return true;
            }
            if (is_array($state)) {
                //@todo : Save file if one is temporaryFileSystem
                //$storeState
            }

            return true;
        };
        $this->beforeCreatedValidateValueUsing = static function (FileUpload $component, $state): bool {
            /* if (blank($state)){
                 //$component->state(null);
                 return true;
             }
             if (is_array($state)){
                 //$storeState
             }*/
            return false;
        };
        $this->afterUpdatedValidateValueUsing = static function (FileUpload $component, $state): bool {
            if (blank($state)) {
                $component->state([]);

                return true;
            }
            if (is_array($state)) {
                //$storeState
            }

            return true;
        };
        $this->afterCreatedValidateValueUsing = static function (FileUpload $component, $state): bool {
            if (blank($state)) {
                $component->state([]);

                return true;
            }
            if (is_array($state)) {
                //$storeState
            }

            return true;
        };
    }
}
