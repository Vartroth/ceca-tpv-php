<?php

declare (strict_types = 1);

namespace CecaTpvPhp\ValueObject;

use CecaTpvPhp\Share\StringValueObject;
use InvalidArgumentException;

/**
 * @testFunction testTerminalId
 */
class TerminalId extends StringValueObject
{

    /**
     * @param int $value
     * @return void
     * @throws InvalidArgumentException
     */
    protected static function validate(string $value)
    {
        if (strlen((string) $value) <= 0) {
            throw new InvalidArgumentException(
                sprintf("The TerminalId '%s' is required", $value)
            );
        }
    }

    /**
     * @param string $value
     * @return TerminalId
     * @throws InvalidArgumentException
     */
    public static function from(string $value): self
    {
        self::validate($value);
        return new self($value);
    }
}
