<?php

namespace App\Dto\ChatRoomsCriteriaDelete\Output;

use App\Dto\ChatRooms\Output\ChatRoomsOutputDto;

final class ChatRoomsCriteriaDelete
{
    /**
     * @var bool
     */
    private $isPreview;

    /**
     * @var ChatRoomsOutputDto[]
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
     * @return ChatRoomsOutputDto[]
     */
    public function getSample(): ?array
    {
        return $this->sample;
    }

    /**
     * @param ChatRoomsOutputDto[] $sample
     */
    public function setSample(?array $sample): void
    {
        $this->sample = $sample;
    }
}