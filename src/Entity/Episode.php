<?php

namespace App\Entity;

use wapmorgan\Mp3Info\Mp3Info;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EpisodeRepository")
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          API_ROUTE_EPISODE_SHOW,
 *          parameters = { "episode_id" = "expr(object.getId())"}
 *      )
 * )
 * @Hateoas\Relation(
 *      "source",
 *      href = "expr(object.getSource())"
 * )
 */
class Episode
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
    private $title;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $number;

    /**
     * @ORM\Column(type="text")
     */
    private $abstract;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publicationDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", mappedBy="episodes")
     * @Serializer\Exclude()
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Series", inversedBy="episodes")
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Exclude()
     */
    private $series;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Exclude()
     */
    private $source;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $Title): self
    {
        $this->title = $Title;

        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addEpisode($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            $category->removeEpisode($this);
        }

        return $this;
    }

    public function getSeries(): ?Series
    {
        return $this->series;
    }

    public function setSeries(?Series $series): self
    {
        $this->series = $series;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }
    
    /**
     * @Serializer\VirtualProperty()
     */
    public function duration() {
        
        $audio = new Mp3Info(
             PUBLIC_ROOT . $this->getSource()
        );
        
        $duration = $audio->duration;
        $hours = floor($duration / 3600);
        $duration -= ($hours * 3600);
        $minutes = str_pad(
            floor($duration / 60),
            2,
            "0",
            STR_PAD_LEFT
        );
        $seconds = str_pad(
            floor($duration % 60),
            2,
            "0",
            STR_PAD_LEFT
        );;
        $duration = "$hours:$minutes:$seconds";
        return $duration;
    }
}