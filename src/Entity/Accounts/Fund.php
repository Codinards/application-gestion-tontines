<?php

namespace App\Entity\Accounts;

use App\Entity\Auth\User;
use App\Repository\Accounts\FundRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FundRepository::class)]
class Fund
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $wording = null;

    #[ORM\Column]
    private ?float $inflow = null;

    #[ORM\Column]
    private ?float $outflow = null;

    #[ORM\Column]
    private ?float $balance = null;

    #[ORM\Column]
    private ?float $previousBalance = null;

    #[ORM\Column]
    private ?float $previousOutflows = null;

    #[ORM\Column]
    private ?float $previousInflows = null;

    #[ORM\Column(length: 4)]
    private ?string $year = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $observation = null;

    #[ORM\ManyToOne(inversedBy: 'funds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'createdFunds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $admin = null;

    #[ORM\ManyToOne(inversedBy: 'funds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?account $account = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    public function getInflow(): ?float
    {
        return $this->inflow;
    }

    public function setInflow(float $inflow): self
    {
        $this->inflow = $inflow;

        return $this;
    }

    public function getOutflow(): ?float
    {
        return $this->outflow;
    }

    public function setOutflow(float $outflow): self
    {
        $this->outflow = $outflow;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getPreviousBalance(): ?float
    {
        return $this->previousBalance;
    }

    public function setPreviousBalance(float $previousBalance): self
    {
        $this->previousBalance = $previousBalance;

        return $this;
    }

    public function getPreviousOutflows(): ?float
    {
        return $this->previousOutflows;
    }

    public function setPreviousOutflows(float $previousOutflows): self
    {
        $this->previousOutflows = $previousOutflows;

        return $this;
    }

    public function getPreviousInflows(): ?float
    {
        return $this->previousInflows;
    }

    public function setPreviousInflows(float $previousInflows): self
    {
        $this->previousInflows = $previousInflows;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAdmin(): ?User
    {
        return $this->admin;
    }

    public function setAdmin(?User $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getAccount(): ?account
    {
        return $this->account;
    }

    public function setAccount(?account $account): self
    {
        $this->account = $account;

        return $this;
    }
}
