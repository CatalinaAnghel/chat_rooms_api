<?php

namespace App\Dto\ChatRooms\Input;

use Symfony\Component\Validator\Constraints as Assert;

final class ChatRoomsInputDto
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=32)
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