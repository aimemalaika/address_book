<?php

namespace App\Entity;

use App\Repository\ContactsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactsRepository::class)
 */
class Contacts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message="Name is mandatory")
     * @Assert\Length(min=4,max=30)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(min=4,max=30)
     * @Assert\NotBlank(message="Name is mandatory")
     */
    private $lastname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Emails::class, mappedBy="contact", orphanRemoval=true)
     */
    private $emails;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->emails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Emails[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Emails $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
            $email->setContact($this);
        }

        return $this;
    }

    public function removeEmail(Emails $email): self
    {
        if ($this->emails->removeElement($email)) {
            // set the owning side to null (unless already changed)
            if ($email->getContact() === $this) {
                $email->setContact(null);
            }
        }

        return $this;
    }
}
