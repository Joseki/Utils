<?php

namespace TestCases\DataTransfers;

use Joseki\Utils\Numbers\Roman;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

Assert::equal('N', Roman::encode(0));
Assert::equal('I', Roman::encode(1));
Assert::equal('II', Roman::encode(2));
Assert::equal('III', Roman::encode(3));
Assert::equal('IV', Roman::encode(4));
Assert::equal('V', Roman::encode(5));
Assert::equal('VI', Roman::encode(6));
Assert::equal('VII', Roman::encode(7));
Assert::equal('VIII', Roman::encode(8));
Assert::equal('IX', Roman::encode(9));
Assert::equal('X', Roman::encode(10));

Assert::equal('X', Roman::encode(10));
Assert::equal('L', Roman::encode(50));
Assert::equal('C', Roman::encode(100));
Assert::equal('D', Roman::encode(500));
Assert::equal('M', Roman::encode(1000));

Assert::equal('DLV', Roman::encode(555));
Assert::equal('CDXLIV', Roman::encode(444));
Assert::equal('DCCLXXVII', Roman::encode(777));


Assert::equal(0, Roman::decode('N'));
Assert::equal(1, Roman::decode('I'));
Assert::equal(2, Roman::decode('II'));
Assert::equal(3, Roman::decode('III'));
Assert::equal(4, Roman::decode('IV'));
Assert::equal(5, Roman::decode('V'));
Assert::equal(6, Roman::decode('VI'));
Assert::equal(7, Roman::decode('VII'));
Assert::equal(8, Roman::decode('VIII'));
Assert::equal(9, Roman::decode('IX'));
Assert::equal(10, Roman::decode('X'));

Assert::equal(10, Roman::decode('X'));
Assert::equal(50, Roman::decode('L'));
Assert::equal(100, Roman::decode('C'));
Assert::equal(500, Roman::decode('D'));
Assert::equal(1000, Roman::decode('M'));

Assert::equal(555, Roman::decode('DLV'));
Assert::equal(444, Roman::decode('CDXLIV'));
Assert::equal(777, Roman::decode('DCCLXXVII'));
