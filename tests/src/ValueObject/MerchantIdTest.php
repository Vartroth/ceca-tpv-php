<?php
namespace PHPTDD\src\ValueObject;

use CecaTpvPhp\ValueObject\MerchantId;
use PHPUnit\Framework\TestCase;

class MerchantIdTest extends TestCase
{

    /**
     * @covers CecaTpvPhp\ValueObject\MerchantId
     **/
    public function testMerchantIdException()
    {
        $this->expectException(\InvalidArgumentException::class);
        MerchantId::from('');
    }

    /**
     * @covers CecaTpvPhp\ValueObject\MerchantId
     * @covers CecaTpvPhp\Share\StringValueObject
     **/
    public function testMerchantId()
    {
        $merchantId = MerchantId::from('123');
        $this->assertEquals('123', $merchantId->value());
        $this->assertEquals(MerchantId::class, get_class($merchantId));
    }
}
