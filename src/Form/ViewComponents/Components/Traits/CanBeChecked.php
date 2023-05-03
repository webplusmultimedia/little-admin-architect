<?php

namespace Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\Components\Traits;

use Webplusmultimedia\LittleAdminArchitect\Form\ViewComponents\FormBinder;

trait CanBeChecked
{
    public function getSingleModeCheckedStatus(): bool
    {
        $oldChecked = old($this->name);
        if (isset($oldChecked)) {
            return $oldChecked;
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        return $this->checked ?? (bool) data_get($dataBatch, $this->name);
    }

    public function getGroupModeCheckedStatus(int|string $groupValue): bool
    {
        if (old($this->name)) {
            return in_array((string) $groupValue, array_map('strval', old($this->name)), true);
        }
        if ($this->checked) {
            return in_array((string) $groupValue, array_map('strval', $this->checked), true);
        }
        $dataBatch = $this->bind ?: app(FormBinder::class)->getBoundDataBatch();

        return in_array((string) $groupValue, array_map('strval', data_get($dataBatch, $this->name, [])), true);
    }
}
