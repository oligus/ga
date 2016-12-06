<?php

use GA\Reproduction\TwoPointCrossOver;
use GA\Individual;

describe('Two point cross over', function() {

    $spc = new TwoPointCrossOver();

    xit('should crossover', function() use ($spc) {
        mt_srand(1);
        $i1 = new Individual();
        $i1->generate();

        $i2 = new Individual();
        $i2->generate();

        $result = $spc->reproduce($i1, $i2);

        expect(count($result))->toEqual(2);

        expect($result[0]->getChromosome())
            ->toEqual('11010010000010011011101010110100100100010101010101111100110011010');

        expect($result[1]->getChromosome())
            ->toEqual('10111111111101100101000101111001010111100110101111111010001011011');


    });

});