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
 * Date: 29/10/2023 12:07
 */

namespace Webplusmultimedia\LittleAdminArchitect\Admin\Widgets;

use Webplusmultimedia\LittleAdminArchitect\Admin\Widgets\Stats\SimpleStat;

class OverviewSimpleStatWidget extends Widget
{
    protected string $heading = '';

    /**
     * @var array<string,SimpleStat>
     */
    protected array $cachedStats;

    protected static string $view = 'little-views::widgets.defaults.infos-la';

    protected function getHeading(): string
    {
        return $this->heading;
    }

    /**
     * @return array<string,SimpleStat>
     */
    protected function getCachedStats(): array
    {
        return $this->cachedStats ??= $this->getStats();
    }

    /**
     * @return array<string,SimpleStat>
     */
    protected function getStats(): array
    {
        return $this->cachedStats;
    }

    public function getColumnSpan(): int | string | array
    {
        $columns = count($this->getCachedStats());
        if ($columns >= 4) {
            return 4;
        }

        return $columns;
    }
}
