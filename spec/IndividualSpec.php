<?php

use GA\Individual;
use GA\Encoding\Binary;
use GA\Encoding\Permutation;
use GA\Encoding\Value;

describe('Individual', function() {

    it('it should create a new binary individual', function() {
        mt_srand(5);
        $encoding = new Binary();
        $individual = new Individual($encoding);

        expect($individual->encoding()->chromosome())
            ->toEqual('1000101110010110110011100101010000001001111011010110010000100011');

        mt_srand(2);
        $individual = new Individual();

        expect($individual->encoding()->chromosome())
            ->toEqual('1111111100100000110010011011001100100100110111000010000101011101');
    });

    it('it should create a new permutation individual', function() {
        mt_srand(5);
        $encoding = new Permutation();
        $individual = new Individual($encoding);

        expect($individual->encoding()->chromosome())
            ->toEqual('7122849951463655792296724727283242326545677179383881291411811587');
    });

    it('it should create a new vlue individual', function() {
        mt_srand(5);
        $encoding = new Value(null, ['A', 'B', 'C', 'D']);
        $individual = new Individual($encoding);

        $solution = [
            "D", "A", "A", "A", "D", "B", "D", "D",
            "C", "A", "B", "C", "A", "C", "C", "B",
            "C", "D", "A", "A", "D", "C", "C", "A",
            "B", "D", "A", "D", "A", "D", "B", "A",
            "B", "A", "B", "A", "C", "B", "B", "C",
            "C", "C", "C", "A", "C", "D", "B", "D",
            "B", "D", "D", "A", "A", "D", "A", "B",
            "A", "A", "D", "A", "A", "B", "D", "C"
        ];

        expect($individual->encoding()->chromosome())
            ->toEqual($solution);
    });

});