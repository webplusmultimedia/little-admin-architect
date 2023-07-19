<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Form\Concerns;

use Illuminate\Database\Eloquent\Model;
use Webplusmultimedia\LittleAdminArchitect\Form\Components\Form;

trait CanAuthorizeAccess
{
    public function authorizeAccess(): void
    {
        abort_unless($this->getResourcePage()::canViewAny(), 403);

        if (Form::UPDATED === $this->statusForm) {
            if ($this->model instanceof Model) {
                abort_unless($this->getResourcePage()::canEdit($this->model), 403);
            } else {
                abort(403);
            }
        } else {
            abort_unless($this->getResourcePage()::canCreate(), 403);
        }
    }
}
