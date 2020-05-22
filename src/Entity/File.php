<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     * @ORM\OneToMany(targetEntity=ImageFile::class, mappedBy="file")
     */
    private $imageFiles;

    public function __construct()
    {
        $this->imageFiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return Collection|ImageFile[]
     */
    public function getImageFiles(): Collection
    {
        return $this->imageFiles;
    }

    public function addImageFile(ImageFile $imageFile): self
    {
        if (!$this->imageFiles->contains($imageFile)) {
            $this->imageFiles[] = $imageFile;
            $imageFile->setFile($this);
        }

        return $this;
    }

    public function removeImageFile(ImageFile $imageFile): self
    {
        if ($this->imageFiles->contains($imageFile)) {
            $this->imageFiles->removeElement($imageFile);
            // set the owning side to null (unless already changed)
            if ($imageFile->getFile() === $this) {
                $imageFile->setFile(null);
            }
        }

        return $this;
    }
}
