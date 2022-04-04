<?php
namespace PHPTDD\src\ValueObject;

use CecaTpvPhp\ValueObject\Amount;
use PHPUnit\Framework\TestCase;

class AmountTest extends TestCase
{

    /**
     * @covers CecaTpvPhp\ValueObject\Amount
     **/
    public function testAmount()
    {
        $amount = Amount::from(500);
        $this->assertEquals(500, $amount->value());
        $this->assertEquals('50000', $amount->convertedValue());

    }
}
