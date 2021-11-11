<?php

namespace App\Dto\Output;

use App\Dto\Input\FilterComponent;
use App\Entity\ChatRooms;

final class ChatRoomsCriteriaDelete
{
    /**
     * @var bool
     */
    private $isPreview;

    /**
     * @var ChatRooms[]|null
     */
    private $sample;

    /**
     * @return bool
     */
    public function isPreview(): bool
    {
        return $this->isPreview;
    }

    /**
     * @param bool $isPreview
     */
    public function setIsPreview(bool $isPreview): void
    {
        $this->isPreview = $isPreview;
    }

    /**
     * @return ChatRooms[]|null
     */
    public function getSample(): ?array
    {
        return $this->sample;
    }

    /**
     * @param ChatRooms[]|null $sample
     */
    public function setSample(?array $sample): void
    {
        $this->sample = $sample;
    }
}