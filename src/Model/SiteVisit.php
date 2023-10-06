<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'site_visits')]
#[ORM\Index(columns: ['ipAddress'], name: 'idx_site_visits_ip_address')]
#[ORM\Index(columns: ['createdAt'], name: 'idx_site_visits_created_at')]
class SiteVisit
{

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length: 45)]
    private string $ipAddress;

    #[ORM\Column(type: 'string', length: 512)]
    private string $userAgent;

    #[ORM\Column(type: 'string', length: 512)]
    private string $url;

    #[ORM\Column(type: 'string', length: 512, nullable: true)]
    private ?string $referrer = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): void
    {
        if (strlen($userAgent) > 512) {
            $userAgent = substr($userAgent, 0, 512);
        }

        $this->userAgent = $userAgent;

    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        if (strlen($url) > 512) {
            $url = substr($url, 0, 512);
        }

        $this->url = $url;

    }

    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    public function setReferrer(?string $referrer): void
    {
        if (strlen($referrer) > 512) {
            $referrer = substr($referrer, 0, 512);
        }

        $this->referrer = $referrer;

    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}
