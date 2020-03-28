<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FileRepository")
 */
class File
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70000)
     */
    private $file;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uploaddate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getUploaddate(): ?\DateTimeInterface
    {
        return $this->uploaddate;
    }

    public function setUploaddate(\DateTimeInterface $uploaddate): self
    {
        $this->uploaddate = $uploaddate;

        return $this;
    }
}
