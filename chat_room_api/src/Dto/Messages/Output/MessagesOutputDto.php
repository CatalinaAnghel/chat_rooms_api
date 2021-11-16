<?php

namespace App\Dto\Messages\Output;

use App\Dto\ChatRooms\Output\ChatRoomsOutputDto;

final class MessagesOutputDto
{
    /**
     * @var string $id
     */
    public $id;

    /**
     * @var string $content
     */
    public $content;

    /**
     * @var ChatRoomsOutputDto
     */
    public $chatRoom;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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

    /**
     * @return ChatRoomsOutputDto
     */
    public function getChatRoom(): ChatRoomsOutputDto
    {
        return $this->chatRoom;
    }

    /**
     * @param ChatRoomsOutputDto $chatRoom
     */
    public function setChatRoom(ChatRoomsOutputDto $chatRoom): void
    {
        $this->chatRoom = $chatRoom;
    }
}