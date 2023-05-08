<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Commands;

use Illuminate\Console\Command;

class LittleAdminArchitectCommand extends Command
{
    public $signature = 'little-admin-architect';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
