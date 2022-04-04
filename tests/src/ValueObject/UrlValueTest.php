<?php
namespace PHPTDD\src\ValueObject;

use CecaTpvPhp\ValueObject\UrlValue;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UrlValueTest extends TestCase
{

    /**
     * @covers CecaTpvPhp\ValueObject\UrlValue
     **/
    public function testUrlValueException()
    {
        $this->expectException(InvalidArgumentException::class);
        UrlValue::from('iamatest.test');
    }

    /**
     * @covers CecaTpvPhp\ValueObject\UrlValue
     * @covers CecaTpvPhp\Share\StringValueObject
     **/
    public function testUrlValue()
    {
        $url = UrlValue::from('http://iamatest.test');
        $this->assertEquals(UrlValue::class, \get_class($url));
        $this->assertEquals('http://iamatest.test', $url->value());
    }
}
