<?php

declare (strict_types = 1);

namespace CecaTpvPhp\ValueObject;

use CecaTpvPhp\Share\StringValueObject;
use InvalidArgumentException;

/**
 * @testFunction testMerchantId
 */
class MerchantId extends StringValueObject
{

    /**
     * @param string $value
     * @return void
     * @throws InvalidArgumentException
     */
    protected static function validate(string $value)
    {
        if (strlen($value) <= 0) {
            throw new InvalidArgumentException(
                sprintf("The MerchantID '%s' is required", $value)
            );
        }
    }

    /**
     * @param string $value
     * @return MerchantId
     * @throws InvalidArgumentException
     */
    public static function from(string $value): self
    {
        self::validate($value);
        return new self($value);
    }
}
