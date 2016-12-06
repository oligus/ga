<?php


use GA\Fitness\Binary;

use GA\Individual;

describe('Binary fitness', function() {

    xit('should give fitness score', function() {
        mt_srand(5);

        $individual = new Individual();
        $individual->generate();

        $binary = new Binary();

        $binary->setSolution('1100101110010110110011100101010000001001111011010110010000100011');
        expect($binary->getFitness($individual))->toEqual(98.4375);

        $binary->setSolution('1111111111111111111111111111111111111111111111111111111111111111');
        expect($binary->getFitness($individual))->toEqual(46.875);

        $binary->setSolution('1000101110010110110011100101010000001001111011010110010000100011');
        expect($binary->getFitness($individual))->toEqual(100);

        $binary->setSolution('0111010001101001001100011010101111110110000100101001101111011100');
        expect($binary->getFitness($individual))->toEqual(0);
    });

});