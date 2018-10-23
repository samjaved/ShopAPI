<?php
namespace App\Entity;


use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\MappedSuperclass
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
abstract class Base
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", name="deleted_at", nullable=true)
     */
    protected $deletedAt;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return Uuid::fromString($this->id);
    }
}
