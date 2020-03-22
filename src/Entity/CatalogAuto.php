<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CatalogAutoRepository")
 */
class CatalogAuto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mark;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $steering;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $engine;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $power;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $transmission;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $drive;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mileage;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $bodyNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="page")
     * @ORM\OrderBy( {"id" = "DESC"} )
     */
    private $comments;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="catalogAutos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->isDeleted = false;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(?string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getSteering(): ?string
    {
        return $this->steering;
    }

    public function setSteering(?string $steering): self
    {
        $this->steering = $steering;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function setEngine(?string $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->power;
    }

    public function setPower(?string $power): self
    {
        $this->power = $power;

        return $this;
    }
    
    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(?string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDrive(): ?string
    {
        return $this->drive;
    }

    public function setDrive(?string $drive): self
    {
        $this->drive = $drive;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMileage(): ?string
    {
        return $this->mileage;
    }

    public function setMileage(?string $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getBodyNumber(): ?string
    {
        return $this->bodyNumber;
    }

    public function setBodyNumber(?string $bodyNumber): self
    {
        $this->bodyNumber = $bodyNumber;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function getNoDeletedComments(): Collection
    {
        $criteria = Criteria::create()
            ->andWhere(Criteria::expr()->eq('isDeleted', false));

        return $this->comments->matching($criteria);
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPage($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPage() === $this) {
                $comment->setPage(null);
            }
        }

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

}
