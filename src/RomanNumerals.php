<?php

/**
 * For full copyright and licence information, please view the LICENCE file
 * that was distributed with this source code.
 *
 * (c) Adam Wojciechowski <adam@webee.online>
 */

declare(strict_types=1);

namespace WeBee;

use DomainException;

final class RomanNumerals
{
    private $convertMap = [
        ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'],
        ['', 'X', 'XX', 'XXX', 'XL', 'L', 'LX', 'LXX', 'LXXX', 'XC'],
        ['', 'C', 'CC', 'CCC', 'CD', 'D', 'DC', 'DCC', 'DCCC', 'CM'],
        ['', 'M', 'MM', 'MMM'],
    ];

    public function convert(int $number): string
    {
        if (1 > $number || 3999 < $number) {
            throw new DomainException('Number must be in the range from 1 to 3999');
        }

        $digits = str_split(sprintf('%04d', $number));
        $magnitude = 3;
        $result = '';

        foreach ($digits as $digit) {
            $result .= $this->convertMap[$magnitude--][$digit];
        }

        return $result;
    }
}
