<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Form\View\Components;

use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Field;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\FileUpload;
use Webplusmultimedia\LittleAdminArchitect\Form\View\Components\Concerns\HasValidation;

class FileUploadField extends Abstracts\AbstractComponent
{
    use Concerns\HasName;
    use HasValidation;

    public function __construct(
        FileUpload $field,
        public ?string $name = null,
    ) {
        parent::__construct();
        $this->setUp($field);
    }

    protected function setViewPath(): string
    {
        return 'fields.file-upload';
    }

    protected function setUp(Field $field): void
    {
        $this->field = $field;
        $this->name = $field->getName();
    }
}
