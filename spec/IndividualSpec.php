<?php

use GA\Individual;
use GA\Encoding\Binary;

describe('Individual', function() {


    it('it should create a new individual', function() {
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

});