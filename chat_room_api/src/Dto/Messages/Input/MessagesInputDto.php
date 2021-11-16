<?php

namespace App\Dto\Messages\Input;

use App\Entity\ChatRooms;

final class MessagesInputDto
{
    /**
     * @var ChatRooms $chatRoom
     */
    public $chatRoom;

    /**
     * @var string $content
     */
    public $content;

    /**
     * @return ChatRooms
     */
    public function getChatRoom(): ChatRooms
    {
        return $this->chatRoom;
    }

    /**
     * @param ChatRooms $chatRoom
     */
    public function setChatRoom(ChatRooms $chatRoom): void
    {
        $this->chatRoom = $chatRoom;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}