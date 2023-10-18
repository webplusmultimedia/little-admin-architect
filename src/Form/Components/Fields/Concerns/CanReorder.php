<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 *
 * @category    Category
 *
 * @author      daniel
 *
 * @link        http://webplusm.net
 * Date: 18/10/2023 08:31
 */

namespace Webplusmultimedia\LittleAdminArchitect\Form\Components\Fields\Concerns;

use Closure;

trait CanReorder
{
    protected bool|Closure $isReordable = false;

    public function reorder(array $newOrder): array
    {
        $values = [];
        /** @var array<string,array> $state */
        $state = $this->getState();
        //remove delete images first
        /** @var array<string,array> $deleteState */
        $deleteState = collect($state)->filter(fn ($value) => ! in_array($value['id'], $newOrder))->values()->all();
        /** @var array<string,array> $newOrderState */
        $newOrderState = collect($state)->filter(fn ($value) => in_array($value['id'], $newOrder))->values()->all();

        foreach ($newOrder as $order) {
            if ( ! blank($orderState = collect($newOrderState)->filter(fn ($value) => $value['id'] === $order)->values()->all())) {
                $mergeTmp = array_merge($values, $orderState);
                $values = $mergeTmp;
            }
        }
        $values = array_merge($values, $deleteState);
        if (blank($values)) {
            return [];
        }
        $this->state($values);

        return $this->getUploadFileUrlsUsing();
    }

    public function canReorder(bool|Closure $canReorder = true): static
    {
        $this->isReordable = $canReorder;

        return $this;
    }

    public function isReordable(): bool
    {
        return $this->evaluate($this->isReordable);
    }
}
