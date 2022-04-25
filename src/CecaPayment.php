<?php

declare (strict_types = 1);

namespace CecaTpvPhp;

use CecaTpvPhp\Language\Language;
use CecaTpvPhp\ValueObject\AcquirerBin;
use CecaTpvPhp\ValueObject\Amount;
use CecaTpvPhp\ValueObject\MerchantId;
use CecaTpvPhp\ValueObject\TerminalId;
use CecaTpvPhp\ValueObject\UrlValue;
use Exception;
use InvalidArgumentException;

/**
 * @testFunction testCecaPayment
 */
class CecaPayment
{

    const EXPONENT = 2;
    const ENCRYPTION = 'SHA2';
    const DEFAULT_CURRENCY_TYPE = "978";

    const URL_DEVELOP = "https://tpv.ceca.es/tpvweb/tpv/compra.action";
    const URL_PRODUCTION = "https://pgw.ceca.es/tpvweb/tpv/compra.action";
    const SUPPORTED_PAYMENT = "SSL";
    const DEFAULT_LANGUAGE = 1;

    private $_merchantId;
    private $_acquirerBin;
    private $_terminalId;
    private $_operationNum;
    private $_amount;
    private $_currencyType;
    private $_urlOK;
    private $_urlNOK;
    private $_signature;
    private $_language;

    /**
     * @param MerchantId $merchantId
     * @param AcquirerBin $acquirerBin
     * @param TerminalId $terminalId
     * @param string $operationNum
     * @param Amount $amount
     * @param UrlValue $urlOK
     * @param UrlValue $urlNOK
     * @param string $signatureKey
     * @param string $currencyType
     * @return void
     * @throws Exception
     */
    public function __construct(
        MerchantId $merchantId,
        AcquirerBin $acquirerBin,
        TerminalId $terminalId,
        string $operationNum,
        Amount $amount,
        UrlValue $urlOk,
        UrlValue $urlKo,
        string $currencyType = self::DEFAULT_CURRENCY_TYPE,

    ) {
        $this->_merchantId = $merchantId;
        $this->_acquirerBin = $acquirerBin;
        $this->_terminalId = $terminalId;
        $this->_operationNum = $operationNum;
        $this->_amount = $amount;
        $this->_currencyType = $currencyType;
        $this->_urlOK = $urlOk;
        $this->_urlNOK = $urlKo;
        $this->_language = Language::SPANISH;
    }

    /**
     * @param string $key
     * @return $this
     * @throws Exception
     */
    public function generateSignature(string $key)
    {
        $signatureString = $key . $this->_merchantId->value() . $this->_acquirerBin->value() . $this->_terminalId->value() .
        $this->_operationNum . $this->_amount->convertedValue() . $this->_currencyType . self::EXPONENT . self::ENCRYPTION .
        $this->_urlOK->value() . $this->_urlNOK->value();

        if (strlen(trim($key)) <= 0) {
            throw new InvalidArgumentException('Signature Key is not valid');
        }

        $this->_signature = strtolower(hash('sha256', $signatureString));

        return $this;
    }

    /**
     * @return void
     */
    public function getSignature()
    {
        return $this->_signature;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'merchantId' => $this->_merchantId->value(),
            'acquirerBin' => $this->_acquirerBin->value(),
            'terminalId' => $this->_terminalId->value(),
            'operationNum' => $this->_operationNum,
            'amount' => $this->_amount->convertedValue(),
            'currencyType' => $this->_currencyType,
            'urlOK' => $this->_urlOK->value(),
            'urlNOK' => $this->_urlNOK->value(),
            'signature' => $this->_signature,
            'language' => $this->_language,
        ];
    }

}
