<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Dto\Utils\FilterComponent;

/**
 * @ApiResource
 */
class CriteriaDeleteChatRooms
{
    /**
     * @var string
     * @ApiProperty(identifier=true)
     */
    private $id;
    /**
     * @var FilterComponent[]|null $filters
     */
    private $filters;

    /**
     * @var bool $preview
     */
    private $preview;

    /**
     * @var ChatRooms[]
     */
    private $sample;

    public function __construct()
    {
        $this->id = (new \DateTime('NOW'))->format('Y-m-d');
    }

    /**
     * @return FilterComponent[]
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    /**
     * @param FilterComponent[] $filters
     */
    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    /**
     * @return bool
     */
    public function isPreview(): bool
    {
        return $this->preview;
    }

    /**
     * @param bool $preview
     */
    public function setPreview(bool $preview): void
    {
        $this->preview= $preview;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     */
    public function setId(): void
    {
        $this->id = (new \DateTime('NOW'))->format('Y-m-d');
    }
}