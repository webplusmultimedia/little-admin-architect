<?php

namespace Webplusmultimedia\LittleAdminArchitect\Support\Components\Concerns;




use Bkwld\Croppa\Facades\Croppa;

trait HasExtensionFile
{
    protected array $documentsExtension = ['doc', 'docx', 'pdf', 'xls', 'xlsx'];
    protected array $imagesExtension = ['jpg', 'jpge', 'png', 'svg', 'webp'];

    protected function isDocumentFile($file): bool
    {
        return in_array($this->getExtension($file), $this->documentsExtension);
    }

    protected function isSvgFile(string $file): bool
    {
        return 'svg' === $this->getExtension($file);
    }

    protected function getExtension(string $file): string
    {
        return str($file)->afterLast('.')->toString();
    }

    public function setDocumentsExtension(array $documentsExtension): static
    {
        $this->documentsExtension = $documentsExtension;

        return $this;
    }

    public function setImagesExtension(array $imagesExtension): static
    {
        $this->imagesExtension = $imagesExtension;

        return $this;
    }

    public function getDocumentsExtension(): array
    {
        return $this->documentsExtension;
    }

    public function getImagesExtension(): array
    {
        return $this->imagesExtension;
    }

    protected function getUrl(string $file,int $width=320,int $height = 200): string
    {
        if ($isDocument = $this->isDocumentFile($file) or $this->isSvgFile($file)) {
            $url = url(str($file)->prepend('storage/')->toString()); // svg
            if ($isDocument) {
                $url = route(str(config('little-admin-architect.route.prefix'))->append('.documents.file')->toString(), ['document' => $this->getExtension($file)]);
            }

            return $url;
        }

        return Croppa::url(str($file)->prepend('storage/')->toString(), $width, $height);

    }
}
