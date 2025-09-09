<?php

namespace App\Entity;

use App\Enum\CouponTypes;
use App\Repository\CouponRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponRepository::class)]
class Coupon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 20, unique: true)]
    private ?string $code = null;

    #[ORM\Column(type: 'string', enumType: CouponTypes::class)]
    private ?CouponTypes $type = null;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 2)]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?CouponTypes
    {
        return $this->type;
    }

    public function setType(?CouponTypes $type): self
    {
        $this->type = $type;

        return $this;
    }
}
