<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Patch;
use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['note:read']]),
        new GetCollection(normalizationContext: ['groups' => ['note:read']]),
        new Post(denormalizationContext: ['groups' => ['note:write']]),
        new Put(denormalizationContext: ['groups' => ['note:write']]),
        new Patch(denormalizationContext: ['groups' => ['note:write']]),
        new Delete()
    ]
)]
#[ApiFilter(OrderFilter::class, properties: ['priority' => 'DESC'], arguments: ['orderParameterName' => 'order'])]
#[ApiFilter(SearchFilter::class, properties: ['priority' => 'exact'])]
#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['note:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['note:read', 'note:write'])]
    private string $name;

    #[ORM\Column(type: 'text')]
    #[Groups(['note:read', 'note:write'])]
    private string $description;

    #[ORM\Column]
    #[Groups(['note:read', 'note:write'])]
    private int $priority;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['note:read', 'note:write'])]
    private \DateTimeImmutable $modified;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['note:read', 'note:write'])]
    private \DateTimeImmutable $created;

    public function __construct()
    {
        $this->created = new \DateTimeImmutable();
        $this->modified = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    public function getModified(): \DateTimeImmutable
    {
        return $this->modified;
    }

    public function setModified(\DateTimeImmutable $modified): self
    {
        $this->modified = $modified;
        return $this;
    }

    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
    }

    public function setCreated(\DateTimeImmutable $created): self
    {
        $this->created = $created;
        return $this;
    }
}
