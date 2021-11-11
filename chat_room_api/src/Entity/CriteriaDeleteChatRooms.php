<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Dto\Input\FilterComponent;

class CriteriaDeleteChatRooms
{
    /**
     * @var string
     * @ApiProperty(identifier=true)
     */
    private $time;
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
        $this->time = (new \DateTime('NOW'))->format('Y-m-d');
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
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time): void
    {
        $this->time = $time->format('Y-m-d');
    }
}