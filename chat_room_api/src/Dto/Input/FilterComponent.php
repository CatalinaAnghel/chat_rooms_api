<?php

namespace App\Dto\Input;

class FilterComponent
{
    /**
     * @var string $attribute
     */
    private $attribute;

    /**
     * @var string $value
     */
    private $value;

    /**
     * @var bool $included
     */
    private $included = true;

    /**
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * @param string $attribute
     */
    public function setAttribute(string $attribute): void
    {
        $this->attribute = $attribute;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isIncluded(): bool
    {
        return $this->included;
    }

    /**
     * @param bool $included
     */
    public function setIncluded(bool $included): void
    {
        $this->included = $included;
    }
}