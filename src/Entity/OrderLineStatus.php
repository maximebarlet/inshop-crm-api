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
 * OrderLineStatus
 *
 * @ORM\Table(name="order_line_status")
 * @ORM\Entity(repositoryClass="App\Repository\OrderLineStatusRepository")
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"order_line_status_read", "read", "is_active_read"}},
 *          "denormalization_context"={"groups"={"order_line_status_write", "is_active_write"}},
 *          "order"={"id": "ASC"}
 *     },
 *     collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ORDER_LINE_STATUS_LIST')"
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_ORDER_LINE_STATUS_CREATE')"
 *          }
 *     },
 *     itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ORDER_LINE_STATUS_SHOW')"
 *          },
 *          "put"={
 *              "security"="is_granted('ROLE_ORDER_LINE_STATUS_UPDATE')"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_ORDER_LINE_STATUS_DELETE')"
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
class OrderLineStatus
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
     *     "order_line_status_read",
     *     "order_header_read",
     *     "order_header_write"
     * })
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "order_line_status_read",
     *     "order_line_status_write",
     *     "order_header_read"
     * })
     * @Assert\NotBlank()
     */
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
