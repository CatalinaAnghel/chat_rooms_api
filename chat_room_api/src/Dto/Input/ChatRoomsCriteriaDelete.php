<?php

namespace App\Dto\Input;

final class ChatRoomsCriteriaDelete
{
    /**
     * @var FilterComponent[]|null $filters
     */
    public $filters;

    /**
     * @var boolean
     */
    public $preview = true;

    /**
     * @return FilterComponent[]|null
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     */
    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    /**
     * @return bool
     */
    public function getPreview(): bool
    {
        return $this->preview;
    }

    /**
     * @param bool $preview
     */
    public function setPreview(bool $preview): void
    {
        $this->preview = $preview;
    }

}