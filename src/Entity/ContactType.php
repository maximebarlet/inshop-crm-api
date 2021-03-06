<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Traits\Blameable;
use App\Traits\IsActive;
use App\Traits\Timestampable;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * ContactType
 *
 * @ORM\Entity(repositoryClass="App\Repository\ContactTypeRepository")
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"contact_type_read", "read", "is_active_read"}},
 *          "denormalization_context"={"groups"={"contact_type_write", "is_active_write"}},
 *          "order"={"id": "ASC"}
 *     },
 *     collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_CONTACT_TYPE_LIST')"
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_CONTACT_TYPE_CREATE')"
 *          }
 *     },
 *     itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_CONTACT_TYPE_SHOW')"
 *          },
 *          "put"={
 *              "security"="is_granted('ROLE_CONTACT_TYPE_UPDATE')"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_CONTACT_TYPE_DELETE')"
 *          }
 *     })
 * @ApiFilter(DateFilter::class, properties={"createdAt", "updatedAt"})
 * @ApiFilter(SearchFilter::class, properties={
 *     "id": "exact",
 *     "name": "ipartial",
 * })
 * @ApiFilter(
 *     OrderFilter::class,
 *     properties={
 *          "id",
 *          "name",
 *          "createdAt",
 *          "updatedAt"
 *     }
 * )
 */
class ContactType
{
    /**
     * @var int
     */
    public const TYPE_PHONE = 1;
    /**
     * @var int
     */
    public const TYPE_MOBILE = 2;
    /**
     * @var int
     */
    public const TYPE_FAX = 3;
    /**
     * @var int
     */
    public const TYPE_EMAIL = 4;
    /**
     * @var int
     */
    public const TYPE_WWW = 5;

    use Timestampable;
    use Blameable;
    use IsActive;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @Groups({
     *     "contact_type_read",
     *     "contact_read",
     *     "contact_write",
     *     "client_read",
     *     "client_read_collection",
     *     "client_write",
     *     "company_read_collection",
     *     "company_read",
     * })
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "contact_type_read",
     *     "contact_type_write",
     *     "contact_read",
     *     "client_read",
     *     "client_read_collection",
     *     "company_read_collection",
     *     "company_read",
     * })
     * @Assert\NotBlank()
     */
    private string $name;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ContactType
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName() ?? '';
    }
}
