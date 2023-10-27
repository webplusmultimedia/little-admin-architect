<?php

declare(strict_types=1);

namespace Webplusmultimedia\LittleAdminArchitect\Http\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentsAssetController
{
    /**
     * @return Response|BinaryFileResponse|void
     */
    public function __invoke(string $document)
    {

        switch ($document) {
            case 'xls':
            case 'xlsx':
                return $this->pretendResponseIsFile(__DIR__ . '/../../../resources/dist/images/xls.svg', 'image/svg+xml');
            case 'doc':
            case 'docx':
                return $this->pretendResponseIsFile(__DIR__ . '/../../../resources/dist/images/word.svg', 'image/svg+xml');
            case 'pdf':
                return $this->pretendResponseIsFile(__DIR__ . '/../../../resources/dist/images/pdf.svg', 'image/svg+xml');
            default:
                return $this->pretendResponseIsFile(__DIR__ . '/../../../resources/dist/images/unknown.svg', 'image/svg+xml');
        }
    }

    protected function getHttpDate(int $timestamp): string
    {
        return sprintf('%s GMT', gmdate('D, d M Y H:i:s', $timestamp));
    }

    protected function pretendResponseIsFile(string $path, string $contentType): Response | BinaryFileResponse
    {
        abort_unless(
            file_exists($path) || file_exists($path = base_path($path)),
            404,
        );

        $cacheControl = 'public, max-age=31536000';
        $expires = strtotime('+1 year');

        $lastModified = (int) filemtime($path);

        if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '') === $lastModified) {
            return response()->noContent(304, [
                'Expires' => $this->getHttpDate($expires),
                'Cache-Control' => $cacheControl,
            ]);
        }

        return response()->file($path, [
            'Content-Type' => $contentType,
            'Expires' => $this->getHttpDate($expires),
            'Cache-Control' => $cacheControl,
            'Last-Modified' => $this->getHttpDate($lastModified),
        ]);
    }
}
