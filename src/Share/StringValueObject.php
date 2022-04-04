<?php

declare (strict_types = 1);

namespace CecaTpvPhp\Share;

abstract class StringValueObject
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param string $value
     * @return void
     */
    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param int $value
     * @throws InvalidArgumentException
     */
    abstract protected static function validate(string $value);

    /**
     * @param string $value
     * @return mixed
     */
    abstract public static function from(string $value): self;

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
