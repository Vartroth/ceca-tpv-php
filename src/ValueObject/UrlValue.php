<?php

declare (strict_types = 1);

namespace CecaTpvPhp\ValueObject;

use CecaTpvPhp\Share\StringValueObject;
use InvalidArgumentException;

/**
 * @testFunction testUrlValue
 */
class UrlValue extends StringValueObject
{

    /**
     * @param int $value
     * @return void
     * @throws InvalidArgumentException
     */
    protected static function validate(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(
                sprintf("The Url '%s' is not valid", $value)
            );
        }
    }

    /**
     * @param string $value
     * @return UrlValue
     * @throws InvalidArgumentException
     */
    public static function from(string $value): self
    {
        self::validate($value);
        return new self($value);
    }
}
