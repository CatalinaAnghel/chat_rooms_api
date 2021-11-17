<?php

namespace App\Dto\Messages\Input;

use App\Entity\ChatRooms;
use Symfony\Component\Validator\Constraints as Assert;

final class MessagesInputDto
{
    /**
     * @Assert\NotBlank()
     * @var ChatRooms $chatRoom
     */
    public $chatRoom;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=255)
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