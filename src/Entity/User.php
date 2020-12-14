<?php

namespace App\Entity;


use App\Entity\Profil;
use App\Entity\Apprenant;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\AddController;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource(
 * routePrefix="/admin",
 * attributes={"security"="is_granted('ROLE_Admin')"},
 * normalizationContext={"groups"={ "read:user"}},
 * collectionOperations={
 * "get",
 * "post"={
 *         "method"="POST",
 *         "path"="/users",
 *         "controller"=AddController::class,
 *         "route_name"= "addUser",
 *         "swagger_context" = {
 *            "consumes" = {
 *                "multipart/form-data",
 *             },
 *             "parameters" = {
 *                 {
 *                      "name" = "file",
 *                      "in" = "formData",
 *                      "required" = "true",
 *                      "type" = "file",
 *                      "description" = "The file to upload"
 *                 }
 *             },
 *         }
 *     },
 * },
 * itemOperations={
 * "get",
 * "put",
 * "delete",
 * }
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="user_type", type="string")
 * @ORM\DiscriminatorMap({"apprenant"="Apprenant","user"="User", "admin"="Admin", "formateur"="Formateur", "cm"="CM"})
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:profil"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({ "read:user"})
     * @Assert\NotBlank(
     * message = "le champ username ne doit pas être vide")
     */
    protected $username;

    
    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(
     * message = "le champ password ne doit pas être vide"))
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({ "read:user"})
     * @Assert\NotBlank(
     * message = "le champ nom ne doit pas être vide"))
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({ "read:user"})
     * @Assert\NotBlank(
     * message = "le champ prenom ne doit pas être vide")
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     * message = "le champ tel ne doit pas être vide")
     */
    protected $tel;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(
     * message = "le champ email ne doit pas être vide")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(
     * message = "le champ genre ne doit pas être vide")
     */
    protected $genre;

    /**
     * @ORM\Column(type="blob", nullable= true)
     * @Assert\NotBlank(
     * message = "le champ photo ne doit pas être vide")
     * 
     */
    protected $photo;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $archivage=false;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     */
    private $profil;

   

    
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPhoto()
    {
          return null;
        if($this->photo){
            $this->photo= stream_get_contents($this->photo);
            $avatar= base64_encode($this->photo);
            return $avatar;
        }
        return null;
    }

    public function setPhoto( $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }


}
