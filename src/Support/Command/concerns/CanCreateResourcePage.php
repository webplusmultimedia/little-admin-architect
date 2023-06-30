<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Command\concerns;

use Illuminate\Support\Str;

trait CanCreateResourcePage
{
    private function createResourceAndPages(array $resourceParams, array $pageParams): bool
    {
        $replacements = [];
        if ($this->fileExists($resourceParams['file']) or $this->pageExist($pageParams)) {

            return false;
        }

        return $this->createResource($resourceParams);
        //$this->createPages($pageParams);
    }

    public function pageExist(array $pageParams): bool
    {
        $exist = false;
        foreach ($pageParams as $page) {
            if ($this->fileExists($page['file'])) {
                return true;
            }
        }

        return $exist;
    }

    protected function createResource(array $resourceParams): bool
    {
        $replacements = [
            'ressourceClass' => $resourceParams['name'],
            'modelClass' => $resourceParams['modelClass'],
            'namespace' => $resourceParams['nameSpace'],
            'pages' => $resourceParams['pages'],
        ];
        /*$path = (string) Str::of($resourceParams['file'])
            ->replace('\\', '/')
            ->replace('//', '/');*/
        $this->info($resourceParams['file'] . '   --    ' . $resourceParams['stub']);
        $this->copyStubToPath($resourceParams['stub'], $resourceParams['file'], $replacements);

        return true;
    }
}
