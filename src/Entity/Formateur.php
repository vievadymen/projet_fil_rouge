<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * routePrefix="/formateur",
 * attributes={"security"="is_granted('ROLE_Formateur')"},
 * collectionOperations={
 * "get",
 * "post"={
 *         "method"="POST",
 *         "path"="/apprenants",
 *         "controller"=AddFormateurController::class,
 *         "route_name"= "addFormateur",
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
 * itemOperations={"get","put", "delete",},
 * )
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 */
class Formateur extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

   

    public function getId(): ?int
    {
        return $this->id;
    }

}
