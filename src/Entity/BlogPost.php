<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
// BlogPost rappresenta la tabella corrispondente nel DB, gestita con Doctrine.
class BlogPost
{
    // Definizione delle colonne che comporranno la tabella
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titolo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenuto = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    // construct utilizzato per impostare la data di creazione ogni volta che viene creato un nuovo post.
    public function __construct()
    {
        $this->createdAt = new \DateTime('now', new \DateTimeZone('Europe/Rome'));
    }

    // Metodi getter e setter per ogni attributo, necessari per la gestione tramite Doctrine.
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitolo(): ?string
    {
        return $this->titolo;
    }

    public function setTitolo(string $titolo): static
    {
        $this->titolo = $titolo;

        return $this;
    }

    public function getContenuto(): ?string
    {
        return $this->contenuto;
    }

    public function setContenuto(?string $contenuto): static
    {
        $this->contenuto = $contenuto;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
