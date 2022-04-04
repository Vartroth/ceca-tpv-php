<?php

declare (strict_types = 1);

namespace CecaTpvPhp\ValueObject;

/**
 * @testFunction testAmount
 */
class Amount
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param float $value
     * @return void
     */
    protected function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @param float $value
     * @return Amount
     */
    public static function from(float $value): self
    {
        return new self($value);
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function convertedValue(): string
    {
        return number_format($this->value, 2, '', '');
    }
}
