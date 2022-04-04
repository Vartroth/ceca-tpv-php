<?php
namespace PHPTDD\src\ValueObject;

use CecaTpvPhp\ValueObject\AcquirerBin;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AcquirerBinTest extends TestCase
{

    /**
     * @covers CecaTpvPhp\ValueObject\AcquirerBin
     **/
    public function testAcquirerBinException()
    {
        $this->expectException(InvalidArgumentException::class);
        AcquirerBin::from('');
    }

    /**
     * @covers CecaTpvPhp\ValueObject\AcquirerBin
     * @covers CecaTpvPhp\Share\StringValueObject
     **/
    public function testAcquirerBin()
    {
        $acquirerBin = AcquirerBin::from('123456');
        $this->assertEquals(AcquirerBin::class, get_class($acquirerBin));
        $this->assertEquals('123456', $acquirerBin->value());
    }
}
