<?php

use GA\Reproduction\UniformCrossOver;
use GA\Individual;

describe('Uniform cross over', function() {

    $spc = new UniformCrossOver();

    xit('should crossover', function() use ($spc) {
        mt_srand(5);
        $i1 = new Individual();
        $i1->generate();

        $i2 = new Individual();
        $i2->generate();

        $result = $spc->reproduce($i1, $i2);

        expect(count($result))->toEqual(2);

        expect($result[0]->getChromosome())
            ->toEqual('1000000110010110110001101111011000000001100011010010111011110011');

        expect($result[1]->getChromosome())
            ->toEqual('1000111001010101111011100001000000001101111111010110010100001011');
    });

});