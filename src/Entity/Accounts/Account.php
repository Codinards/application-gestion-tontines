<?php

namespace App\Entity\Accounts;

use App\Entity\Auth\User;
use App\Repository\Accounts\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
#[ORM\Table('account')]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $cashInflow = null;

    #[ORM\Column]
    private ?float $cashOutflow = null;

    #[ORM\Column]
    private ?float $cashBalance = null;

    #[ORM\Column]
    private ?float $loanInflow = null;

    #[ORM\Column]
    private ?float $loanOutflow = null;

    #[ORM\Column]
    private ?float $loanBalance = null;

    #[ORM\OneToOne(inversedBy: 'account', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'createdAccounts')]
    private ?User $admin = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: Fund::class)]
    private Collection $funds;

    public function __construct()
    {
        $this->funds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCashInflow(): ?float
    {
        return $this->cashInflow;
    }

    public function setCashInflow(float $cashInflow): self
    {
        $this->cashInflow = $cashInflow;

        return $this;
    }

    public function getCashOutflow(): ?float
    {
        return $this->cashOutflow;
    }

    public function setCashOutflow(float $cashOutflow): self
    {
        $this->cashOutflow = $cashOutflow;

        return $this;
    }

    public function getCashBalance(): ?float
    {
        return $this->cashBalance;
    }

    public function setCashBalance(float $cashBalance): self
    {
        $this->cashBalance = $cashBalance;

        return $this;
    }

    public function getLoanInflow(): ?float
    {
        return $this->loanInflow;
    }

    public function setLoanInflow(float $loanInflow): self
    {
        $this->loanInflow = $loanInflow;

        return $this;
    }

    public function getLoanOutflow(): ?float
    {
        return $this->loanOutflow;
    }

    public function setLoanOutflow(float $loanOutflow): self
    {
        $this->loanOutflow = $loanOutflow;

        return $this;
    }

    public function getLoanBalance(): ?float
    {
        return $this->loanBalance;
    }

    public function setLoanBalance(float $loanBalance): self
    {
        $this->loanBalance = $loanBalance;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Fund>
     */
    public function getFunds(): Collection
    {
        return $this->funds;
    }

    public function addFund(Fund $fund): self
    {
        if (!$this->funds->contains($fund)) {
            $this->funds[] = $fund;
            $fund->setAccount($this);
        }

        return $this;
    }

    public function removeFund(Fund $fund): self
    {
        if ($this->funds->removeElement($fund)) {
            // set the owning side to null (unless already changed)
            if ($fund->getAccount() === $this) {
                $fund->setAccount(null);
            }
        }

        return $this;
    }
}
