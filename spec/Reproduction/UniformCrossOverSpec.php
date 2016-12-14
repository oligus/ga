<?php

use GA\Reproduction\UniformCrossOver;
use GA\Individual;
use GA\Encoding\Binary;
use GA\Encoding\Permutation;
use GA\Encoding\Value;

describe('Uniform cross over', function() {

    $uco = new UniformCrossOver();

    it('should crossover binary', function() use ($uco) {
        mt_srand(5);

        $father = new Individual(new Binary('1011001000001001101110101011010010010001010101010111110011011011'));
        $mother = new Individual(new Binary('1101111111110110010100010111100101011110011010111111101000011010'));

        list($childA, $childB) = $uco->reproduce($father, $mother);

        expect($childA->encoding()->chromosome())
            ->toEqual('1101011001100000100110110011110101010111010001111111111000011011');

        expect($childB->encoding()->chromosome())
            ->toEqual('1011101110011111011100001111000010011000011110010111100011011010');
    });

    it('should crossover permutation', function() use ($uco) {
        mt_srand(1);

        $father = new Individual(new Permutation());
        $mother = new Individual(new Permutation());

        list($childA, $childB) = $uco->reproduce($father, $mother);

        expect($childA->encoding()->chromosome())
            ->toEqual('9179987937949166947843322657153942468939299276768689623395497564');

        expect($childB->encoding()->chromosome())
            ->toEqual('6658337282262634495775859185993175251183273751154898979321279465');
    });

    it('should crossover array value', function() use ($uco) {
        mt_srand(5);

        $father = new Individual(new Value(null, ['up', 'down', 'backward', 'forward']));
        $mother = new Individual(new Value(null, ['up', 'down', 'backward', 'forward']));

        list($childA, $childB) = $uco->reproduce($father, $mother);

        $childAResult = ['backward', 'up', 'up', 'up', 'up', 'down', 'down', 'forward', 'backward', 'up', 'down', 'backward', 'down', 'forward', 'backward', 'down', 'backward', 'backward', 'up', 'down', 'up', 'forward', 'forward', 'up', 'forward', 'forward', 'backward', 'backward', 'up', 'forward', 'backward', 'up', 'down', 'down', 'down', 'down', 'up', 'down', 'down', 'forward', 'forward', 'up', 'up', 'up', 'backward', 'forward', 'down', 'forward', 'down', 'down', 'forward', 'up', 'forward', 'forward', 'backward', 'down', 'backward', 'backward', 'forward', 'backward', 'up', 'up', 'forward', 'backward'];

        expect($childA->encoding()->chromosome())
            ->toEqual($childAResult);

        $childBResult = ['forward', 'up', 'up', 'down', 'forward', 'backward', 'forward', 'down', 'up', 'backward', 'down', 'forward', 'up', 'backward', 'up', 'forward', 'backward', 'forward', 'forward', 'up', 'forward', 'backward', 'backward', 'down', 'down', 'down', 'up', 'forward', 'up', 'up', 'down', 'up', 'up', 'up', 'down', 'up', 'backward', 'forward', 'down', 'backward', 'backward', 'backward', 'backward', 'backward', 'forward', 'backward', 'down', 'forward', 'up', 'forward', 'backward', 'up', 'up', 'forward', 'up', 'backward', 'up', 'up', 'up', 'up', 'forward', 'down', 'forward', 'backward'];

        expect($childB->encoding()->chromosome())
            ->toEqual($childBResult);
    });
});