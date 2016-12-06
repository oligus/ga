<?php

use \GA\Reproduction\SinglePointCrossOver;
use Ga\Individual;

describe('Single point cross over', function() {

    $spc = new SinglePointCrossOver();

    xit('should crossover', function() use ($spc) {
        mt_srand(1);
        $i1 = new Individual();
        $i1->generate();

        $i2 = new Individual();
        $i2->generate();

        $result = $spc->reproduce($i1, $i2);

        expect(count($result))->toEqual(2);

        expect($result[0]->getChromosome())
            ->toEqual('1011001000001001101110101011010010010001010101010111110011011011');

        expect($result[1]->getChromosome())
            ->toEqual('1101111111110110010100010111100101011110011010111111101000011010');

    });

});