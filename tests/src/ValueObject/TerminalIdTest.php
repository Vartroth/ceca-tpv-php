<?php
namespace PHPTDD\src\ValueObject;

use CecaTpvPhp\ValueObject\TerminalId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class TerminalIdTest extends TestCase
{

    /**
     * @covers CecaTpvPhp\ValueObject\TerminalId
     **/
    public function testMerchantIdException()
    {
        $this->expectException(InvalidArgumentException::class);
        TerminalId::from('');
    }

    /**
     * @covers CecaTpvPhp\ValueObject\TerminalId
     * @covers CecaTpvPhp\Share\StringValueObject
     **/
    public function testMerchantId()
    {
        $terminal = TerminalId::from('123');
        $this->assertEquals('123', $terminal->value());
        $this->assertEquals(TerminalId::class, get_class($terminal));
    }
}
