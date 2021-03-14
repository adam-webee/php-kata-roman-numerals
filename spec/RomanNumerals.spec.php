<?php

/**
 * For full copyright and licence information, please view the LICENCE file
 * that was distributed with this source code.
 *
 * (c) Adam Wojciechowski <adam@webee.online>
 */

declare(strict_types=1);

namespace WeBee\Tests\Spec;

use DomainException;
use WeBee\RomanNumerals;

describe(
    'Roman Numerals',
    function () {
        given(
            'rn',
            function () {
                return new RomanNumerals();
            }
        );

        it(
            'can be instantiated',
            function () {
                expect($this->rn)->toBeAn('object');
                expect($this->rn)->toBeAnInstanceOf('WeBee\RomanNumerals');
            }
        );

        given(
            'dataSet',
            function () {
                return [
                    1 => 'I', 2 => 'II', 9 => 'IX',
                    10 => 'X', 99 => 'XCIX', 54 => 'LIV',
                    100 => 'C', 999 => 'CMXCIX', 678 => 'DCLXXVIII',
                    1000 => 'M', 3999 => 'MMMCMXCIX', 2163 => 'MMCLXIII',
                ];
            }
        );

        it(
            'can convert numbers into roman numerals',
            function () {
                foreach ($this->dataSet as $number => $romanNumeral) {
                    expect($this->rn->convert($number))->toBe($romanNumeral);
                }
            }
        );

        it(
            'can throw an error if input is higher then 3999',
            function () {
                $e = function () {
                    $this->rn->convert(4000);
                };

                expect($e)->toThrow(new DomainException('Number must be in the range from 1 to 3999'));
            }
        );

        it(
            'can throw an error if input is 0',
            function () {
                $e = function () {
                    $this->rn->convert(0);
                };

                expect($e)->toThrow(new DomainException('Number must be in the range from 1 to 3999'));
            }
        );
    }
);
