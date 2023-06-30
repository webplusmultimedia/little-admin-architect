<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Support\Command\concerns;

trait CanCreateResourcePage
{
    private function createResourceAndPages(array $resourceParams, array $pageParams): bool
    {
        $replacements = [];
        if ($this->fileExists($resourceParams['file']) or $this->pageExist($pageParams)) {

            return false;
        }

        $this->createResource($resourceParams);
        $this->createPages($pageParams);

        return true;
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
            'pageNamespace' => str($resourceParams['nameSpace'])
                ->append('\\', $resourceParams['name'], '\\Pages'),
        ];

        $this->copyStubToPath($resourceParams['stub'], $resourceParams['file'], $replacements);

        return true;
    }

    protected function createPages(array $paramsPages): void
    {
        foreach ($paramsPages as $page) {
            $replacements = [
                'extendPageNamespace' => $page['extendPageNamespace'],
                'extendPageName' => $page['extendPageName'],
                'PageResourceClass' => $page['PageResourceClass'],
                'PageResourceNamespace' => $page['PageResourceNamespace'],
                'pageClass' => $page['pageClass'],
                'nameSpace' => $page['nameSpace'],
            ];

            $this->copyStubToPath($page['stub'], $page['file'], $replacements);

        }
    }
}
