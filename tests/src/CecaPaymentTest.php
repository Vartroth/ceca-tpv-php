<?php
namespace PHPTDD\src;

use CecaTpvPhp\CecaPayment;
use CecaTpvPhp\Language\Language;
use CecaTpvPhp\ValueObject\AcquirerBin;
use CecaTpvPhp\ValueObject\Amount;
use CecaTpvPhp\ValueObject\MerchantId;
use CecaTpvPhp\ValueObject\TerminalId;
use CecaTpvPhp\ValueObject\UrlValue;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CecaPaymentTest extends TestCase
{

    private $cecaTpv;

    /**
     * This code will run before each test executes
     * @return void
     */
    protected function setUp(): void
    {

        $this->cecaTpv = new CecaPayment(
            MerchantId::from('111950028'),
            AcquirerBin::from('0000554052'),
            TerminalId::from('00000003'),
            '123',
            Amount::from(5.00),
            UrlValue::from('http://www.ceca.es'),
            UrlValue::from('http://www.ceca.es')
        );

    }

    /**
     * This code will run after each test executes
     * @return void
     */
    protected function tearDown(): void
    {

    }

    /**
     * @covers CecaTpvPhp\CecaPayment
     * @covers CecaTpvPhp\ValueObject\AcquirerBin
     * @covers CecaTpvPhp\ValueObject\Amount
     * @covers CecaTpvPhp\ValueObject\MerchantId
     * @covers CecaTpvPhp\ValueObject\TerminalId
     * @covers CecaTpvPhp\ValueObject\UrlValue
     * @covers CecaTpvPhp\Share\StringValueObject
     **/
    public function testCecaGenerateSignatureException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->cecaTpv->generateSignature('');
    }

    /**
     * @covers CecaTpvPhp\CecaPayment
     * @covers CecaTpvPhp\ValueObject\AcquirerBin
     * @covers CecaTpvPhp\ValueObject\Amount
     * @covers CecaTpvPhp\ValueObject\MerchantId
     * @covers CecaTpvPhp\ValueObject\TerminalId
     * @covers CecaTpvPhp\ValueObject\UrlValue
     * @covers CecaTpvPhp\Share\StringValueObject
     **/
    public function testCecaPayment()
    {
        $this->assertEquals(
            '2b7f686593f1a424c510321e4bc354d21924e02e980a90f4d46c41f92a06f5a9',
            $this->cecaTpv->generateSignature('99888888')->getSignature()
        );

        $array = $this->cecaTpv->toArray();

        $this->assertIsArray($array);
        $this->assertEquals([
            'merchantId' => '111950028',
            'acquirerBin' => '0000554052',
            'terminalId' => '00000003',
            'operationNum' => '123',
            'amount' => '500',
            'currencyType' => CecaPayment::DEFAULT_CURRENCY_TYPE,
            'urlOK' => 'http://www.ceca.es',
            'urlNOK' => 'http://www.ceca.es',
            'signature' => '2b7f686593f1a424c510321e4bc354d21924e02e980a90f4d46c41f92a06f5a9',
            'language' => Language::SPANISH,
        ], $array);
    }
}
