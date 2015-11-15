<?php

namespace Joseki\Utils\Numbers;

use Nette\Utils\Strings;

class Roman
{
    public static function encode($number)
    {
        if ($number < 0 || $number > 3999) {
            throw new \InvalidArgumentException("Value must be in the range 0 - 3.999, '$number' given.");
        }
        if ($number === 0) {
            return 'N';
        }

        $items = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];

        $result = '';
        foreach ($items as $symbol => $value) {
            while ($number >= $value) {
                $result .= $symbol;
                $number -= $value;
            }
        }

        return $result;
    }



    public static function decode($string)
    {
        $digits = [
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000,
        ];
        $string = Strings::upper($string);

        if (!Strings::match($string, '#[IVXLCDMN]+#')) {
            throw new \InvalidArgumentException('Malformed symbol detected. Allowed symbols are: IVXLCDMN');
        }

        if (count(explode('V', $string)) > 2 || count(explode('L', $string)) > 2 || count(explode('D', $string)) > 2) {
            throw new \InvalidArgumentException('Multiple occurencies of V, L or D symbols');
        }

        if ($string === 'N') {
            return 0;
        }

        $count = 1;
        $last = 'Z';
        foreach (str_split($string) as $char) {
            if ($char === $last) {
                $count++;
                if ($count === 4) {
                    throw new \InvalidArgumentException('Malformed Roman number');
                }
            } else {
                $count = 1;
                $last = $char;
            }
        }

        $ptr = 0;
        $values = [];
        $maxDigit = 1000;
        while ($ptr < strlen($string)) {
            $numeral = $string[$ptr];
            $digit = $digits[$numeral];

            if ($digit > $maxDigit) {
                throw new \InvalidArgumentException('Rule 3');
            }

            if ($ptr < strlen($string) - 1) {
                $nextNumeral = $string[$ptr + 1];
                $nextDigit = $digits[$nextNumeral];

                if ($nextDigit > $digit) {
                    if (!in_array($numeral, ['I', 'X', 'C']) || $nextDigit > $digit * 10 || count(explode($numeral, $string)) > 2) {
                        throw new \InvalidArgumentException('Rule 3');
                    }
                    $maxDigit = $digit - 1;
                    $digit = $nextDigit - $digit;
                    $ptr++;
                }
            }

            $values[] = $digit;
            $ptr++;
        }

        for ($i = 0; $i < count($values) - 1; $i++) {
            if ($values[$i] < $values[$i + 1]) {
                throw new \InvalidArgumentException('Rule 5');
            }
        }

        return array_sum($values);
    }
}
