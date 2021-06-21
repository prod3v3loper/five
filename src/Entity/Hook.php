<?php

namespace App\Entity;

use App\Repository\HookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HookRepository::class)
 */
class Hook {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secret;

    /**
     * @ORM\Column(type="integer")
     */
    private $created;

    public function getId(): ?int {
        return $this->id;
    }

    public function getData(): ?string {
        return $this->data;
    }

    public function setData(string $data): self {
        $this->data = $data;

        return $this;
    }

    public function getSecret(): ?string {
        return $this->secret;
    }

    public function setSecret(string $secret): self {
        $this->secret = $secret;

        return $this;
    }

    public function getCreated(): ?int {
        return $this->created;
    }

    public function setCreated(int $created): self {
        $this->created = $created;

        return $this;
    }

}
