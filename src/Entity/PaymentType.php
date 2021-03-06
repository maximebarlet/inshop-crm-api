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
 * PaymentType
 *
 * @ORM\Entity(repositoryClass="App\Repository\PaymentTypeRepository")
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"payment_type_read", "read", "is_active_read"}},
 *          "denormalization_context"={"groups"={"payment_type_write", "is_active_write"}},
 *          "order"={"id": "ASC"}
 *     },
 *     collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_PAYMENT_TYPE_LIST')"
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_PAYMENT_TYPE_CREATE')"
 *          }
 *     },
 *     itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_PAYMENT_TYPE_SHOW')"
 *          },
 *          "put"={
 *              "security"="is_granted('ROLE_PAYMENT_TYPE_UPDATE')"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_PAYMENT_TYPE_DELETE')"
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
class PaymentType
{
    use Timestampable;
    use Blameable;
    use IsActive;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @Groups({
     *     "payment_type_read",
     *     "order_header_read",
     *     "order_header_read_collection"
     * })
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "payment_type_read",
     *     "payment_type_write",
     *     "order_header_read",
     *     "order_header_read_collection",
     *     "order_header_write"
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
}
