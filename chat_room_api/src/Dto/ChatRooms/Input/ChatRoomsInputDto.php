<?php

namespace App\Dto\ChatRooms\Input;

final class ChatRoomsInputDto
{
    /**
     * @var string $name
     */
    public $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}