<?php

namespace App\Entity;

use DateTime;
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
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $uploaddate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CatalogAuto", inversedBy="files")
     */
    private $catalogauto;

    public function __construct()
    {
        $this->uploaddate = new \DateTime();
    }

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

    public function getCatalogauto(): ?CatalogAuto
    {
        return $this->catalogauto;
    }

    public function setCatalogauto(?CatalogAuto $catalogauto): self
    {
        $this->catalogauto = $catalogauto;

        return $this;
    }
}
