<?php

namespace App\Form\Model\Transmission\Torrent\Uploading;

use Symfony\Component\HttpFoundation\File\File;

class UploadTorrentModel
{
    private ?string $savePath = null;

    private ?string $url = null;

    private ?File $file = null;

    public function getSavePath(): ?string
    {
        return $this->savePath;
    }

    public function setSavePath(?string $savePath): self
    {
        $this->savePath = $savePath;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;
        return $this;
    }
}
