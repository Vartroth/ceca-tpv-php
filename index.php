<?php

use CecaTpvPhp\CecaPayment;
use CecaTpvPhp\ValueObject\AcquirerBin;
use CecaTpvPhp\ValueObject\Amount;
use CecaTpvPhp\ValueObject\MerchantId;
use CecaTpvPhp\ValueObject\TerminalId;
use CecaTpvPhp\ValueObject\UrlValue;

require 'vendor/autoload.php';

$cecaTpv = new CecaPayment(
    MerchantId::from('111950028'),
    AcquirerBin::from('0000554052'),
    TerminalId::from('00000003'),
    '123',
    Amount::from(500),
    UrlValue::from('http://www.ceca.es'),
    UrlValue::from('http://www.ceca.es'),
    '99888888'
);

var_dump($cecaTpv->toArray());
