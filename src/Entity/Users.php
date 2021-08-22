<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(
 *     fields={"username"},
 *     errorPath="username",
 *     message="This username is already used."
 * )
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(min = 4,max = 30)
     * @Assert\Regex("/^[a-z0-9_-]{3,30}$/",message="Your username should contain only letters and numbers")
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min = 8,max = 30)
     * @Assert\Regex("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/",message="Your password should contain more than 8 chars ,at least one number, at least one special character")
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @Assert\Length(min = 8,max = 30)
     * @Assert\EqualTo(propertyPath="password",message="Your password don't match")
     * @Assert\NotBlank
     */
    public $confirm_password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getRoles() 
    {
        return ['ROLE_ADMIN'];
    }

    public function getSalt ()
    {
        return null;
    }   

    public function getUserIdentifier(){
        return $this->getUsername();
    }

    public function eraseCredentials() 
    {

    }

    public function serialize(){
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        return list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized,['allowed_class' => false]);
    }

}
