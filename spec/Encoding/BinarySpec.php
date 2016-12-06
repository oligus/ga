<?php

use GA\Encoding\Binary;
use GA\Settings;

describe('Binary encoding', function() {

    it('should create chromosome', function() {
        mt_srand(5);
        $binary = new Binary('1000010001010101111001101011001000000101100111010010111111011011');
        expect($binary->chromosome())->toBe('1000010001010101111001101011001000000101100111010010111111011011');
    });

    it('should throw', function() {
        Settings::CHROMOSOME_SIZE;
        $callable = function() {
            new Binary(2);
        };

        expect($callable)->toThrow('GA\Encoding\EncodingException');
    });


    it('should generate chromosome', function() {
        mt_srand(5);

        $binary = new Binary();
        expect($binary->generate())->toBe('1000010001010101111001101011001000000101100111010010111111011011');
    });

    it('should flip bits', function()  {
        $binary = new Binary('1000010001010101111001101011001000000101100111010010111111011011');

        expect($binary->flipBit())->toEqual(0);
        expect($binary->flipBit())->toEqual(0);
        expect($binary->flipBit())->toEqual(0);
        expect($binary->flipBit())->toEqual(1);
        expect($binary->flipBit($exclude = 1))->toEqual(0);
        expect($binary->flipBit($exclude = 0))->toEqual(1);
    });

    it('should mutate', function() {
        mt_srand(5);
        $binary = new Binary('1000010001010101111001101011001000000101100111010010111111011011');

        expect($binary->chromosome())
            ->toEqual('1000010001010101111001101011001000000101100111010010111111011011');

        $newBinary = $binary->mutate();

        // Flips bit 43 and 59 by chance              *               *
        // 1000010001010101111001101011001000000101100111010010111111011011
        //                                            |               |
        // 1000010001010101111001101011001000000101100011010010111111001011
        //
        expect($newBinary->chromosome())
            ->toEqual('1000010001010101111001101011001000000101100011010010111111001011');

    });

});
