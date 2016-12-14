<?php

use GA\Reproduction\TwoPointCrossOver;
use Ga\Individual;
use GA\Encoding\Binary;
use GA\Encoding\Permutation;
use GA\Encoding\Value;

describe('Two point cross over', function() {

    $tpc = new TwoPointCrossOver();

    it('should crossover binary', function() use ($tpc) {
        mt_srand(1);

        $father = new Individual(new Binary('1011001000001001101110101011010010010001010101010111110011011011'));
        $mother = new Individual(new Binary('1101111111110110010100010111100101011110011010111111101000011010'));

        list($childA, $childB) = $tpc->reproduce($father, $mother);

        expect($childA->encoding()->chromosome())
            ->toEqual('1011001000001001101100010111100100010001010101010111110011011011');

        expect($childB->encoding()->chromosome())
            ->toEqual('1101111111110110010110101011010011011110011010111111101000011010');
    });

    it('should crossover permutation', function() use ($tpc) {
        mt_srand(1);

        $father = new Individual(new Permutation());
        $mother = new Individual(new Permutation());

        list($childA, $childB) = $tpc->reproduce($father, $mother);

        expect($childA->encoding()->chromosome())
            ->toEqual('6658337232249136947775829155193172251139293756164689673391279464');

        expect($childB->encoding()->chromosome())
            ->toEqual('9179987987962664495843352687953945468983279271758898929325497565');
    });

    it('should crossover array value', function() use ($tpc) {
        mt_srand(5);

        $father = new Individual(new Value(null, ['up', 'down', 'backward', 'forward']));
        $mother = new Individual(new Value(null, ['up', 'down', 'backward', 'forward']));

        list($childA, $childB) = $tpc->reproduce($father, $mother);

        $childAResult = ['forward', 'up', 'up', 'up', 'forward', 'backward', 'down', 'down', 'up', 'backward', 'down', 'forward', 'down', 'forward', 'up', 'forward', 'backward', 'backward', 'forward', 'down', 'up', 'forward', 'forward', 'down', 'forward', 'down', 'backward', 'backward', 'up', 'up', 'backward', 'up', 'up', 'down', 'down', 'up', 'backward', 'down', 'down', 'backward', 'backward', 'backward', 'backward', 'up', 'backward', 'forward', 'down', 'forward', 'down', 'forward', 'forward', 'up', 'up', 'forward', 'up', 'down', 'up', 'up', 'forward', 'up', 'up', 'down', 'forward', 'backward'];

        expect($childA->encoding()->chromosome())
            ->toEqual($childAResult);

        $childBResult = ['backward', 'up', 'up', 'down', 'up', 'down', 'forward', 'forward', 'backward', 'up', 'down', 'backward', 'up', 'backward', 'backward', 'down', 'backward', 'forward', 'up', 'up', 'forward', 'backward', 'backward', 'up', 'down', 'forward', 'up', 'forward', 'up', 'forward', 'down', 'up', 'down', 'up', 'down', 'down', 'up', 'forward', 'down', 'forward', 'forward', 'up', 'up', 'backward', 'forward', 'backward', 'down', 'forward', 'up', 'down', 'backward', 'up', 'forward', 'forward', 'backward', 'backward', 'backward', 'backward', 'up', 'backward', 'forward', 'up', 'forward', 'backward'];

        expect($childB->encoding()->chromosome())
            ->toEqual($childBResult);
    });
});