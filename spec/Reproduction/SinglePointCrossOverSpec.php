<?php

use \GA\Reproduction\SinglePointCrossOver;
use Ga\Individual;
use GA\Encoding\Binary;
use GA\Encoding\Permutation;
use GA\Encoding\Value;

describe('Single point cross over', function() {

    $spc = new SinglePointCrossOver();

    it('should crossover binary', function() use ($spc) {
        mt_srand(1);

        $father = new Individual(new Binary('1011001000001001101110101011010010010001010101010111110011011011'));
        $mother = new Individual(new Binary('1101111111110110010100010111100101011110011010111111101000011010'));

        list($childA, $childB) = $spc->reproduce($father, $mother);

        expect($childA->encoding()->chromosome())
            ->toEqual('1011001000001001101110101011010010010110011010111111101000011010');

        expect($childB->encoding()->chromosome())
            ->toEqual('1101111111110110010100010111100101011001010101010111110011011011');
    });

    it('should crossover permutation', function() use ($spc) {
        mt_srand(1);

        $father = new Individual(new Permutation());
        $mother = new Individual(new Permutation());

        list($childA, $childB) = $spc->reproduce($father, $mother);

        expect($childA->encoding()->chromosome())
            ->toEqual('6179337232249136947775829155193172251139293756164689673395497565');

        expect($childB->encoding()->chromosome())
            ->toEqual('9658987987962664495843352687953945468983279271758898929321279464');
    });

    it('should crossover array value', function() use ($spc) {
        mt_srand(5);

        $father = new Individual(new Value(null, ['up', 'down', 'backward', 'forward']));
        $mother = new Individual(new Value(null, ['up', 'down', 'backward', 'forward']));

        list($childA, $childB) = $spc->reproduce($father, $mother);

        $childAResult = ['forward', 'up', 'up', 'up', 'forward', 'down', 'forward', 'forward', 'backward', 'up', 'down', 'backward', 'down', 'forward', 'up', 'forward', 'backward', 'backward', 'forward', 'down', 'up', 'forward', 'forward', 'down', 'forward', 'down', 'backward', 'backward', 'up', 'up', 'backward', 'up', 'up', 'down', 'down', 'down', 'up', 'forward', 'down', 'forward', 'forward', 'up', 'up', 'backward', 'forward', 'backward', 'down', 'forward', 'up', 'down', 'backward', 'up', 'forward', 'forward', 'backward', 'backward', 'backward', 'backward', 'up', 'backward', 'forward', 'up', 'forward', 'backward'];

        expect($childA->encoding()->chromosome())
            ->toEqual($childAResult);

        $childBResult = ['backward', 'up', 'up', 'down', 'up', 'backward', 'down', 'down', 'up', 'backward', 'down', 'forward', 'up', 'backward', 'backward', 'down', 'backward', 'forward', 'up', 'up', 'forward', 'backward', 'backward', 'up', 'down', 'forward', 'up', 'forward', 'up', 'forward', 'down', 'up', 'down', 'up', 'down', 'up', 'backward', 'down', 'down', 'backward', 'backward', 'backward', 'backward', 'up', 'backward', 'forward', 'down', 'forward', 'down', 'forward', 'forward', 'up', 'up', 'forward', 'up', 'down', 'up', 'up', 'forward', 'up', 'up', 'down', 'forward', 'backward'];

        expect($childB->encoding()->chromosome())
            ->toEqual($childBResult);
    });

});