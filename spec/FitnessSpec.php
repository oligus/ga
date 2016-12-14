<?php

use GA\Fitness;
use GA\Individual;
use GA\Encoding\Binary;
use GA\Encoding\Value;

describe('Fitness', function() {

    it('it should get fitness by string', function() {
        mt_srand(5);

        $individual = new Individual(new Binary());
        $fitness = new Fitness();

        $fitness->setSolution('1100101110010110110011100101010000001001111011010110010000100011');
        expect($fitness->getFitness($individual))->toEqual( 98.4375);

        $fitness->setSolution('1111111111111111111111111111111111111111111111111111111111111111');
        expect($fitness->getFitness($individual))->toEqual(46.875);

        $fitness->setSolution('1000101110010110110011100101010000001001111011010110010000100011');
        expect($fitness->getFitness($individual))->toEqual((float) 100);

        $fitness->setSolution('0111010001101001001100011010101111110110000100101001101111011100');
        expect($fitness->getFitness($individual))->toEqual((float) 0);
    });

    it('it should get fitness by array', function() {
        mt_srand(5);

        $individual = new Individual(new Value(null, ['A', 'B', 'C', 'D']));
        $fitness = new Fitness();

        $solution = [
            'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D',
            'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D',
            'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D',
            'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D',
            'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D',
            'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D',
            'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D',
            'A', 'B', 'C', 'D', 'A', 'B', 'C', 'D',
        ];
        $fitness->setSolution($solution);
        expect($fitness->getFitness($individual))->toEqual(21.875);

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
        $fitness->setSolution($solution);
        expect($fitness->getFitness($individual))->toBe( (float) 100);

        $solution = [
            "C", "B", "B", "C", "A", "C", "C", "B",
            "D", "B", "A", "A", "D", "B", "D", "D",
            "B", "A", "B", "D", "A", "D", "B", "C",
            "C", "A", "B", "A", "D", "C", "C", "C",
            "C", "C", "C", "B", "B", "C", "A", "D",
            "B", "A", "B", "B", "D", "B", "D", "C",
            "A", "A", "A", "B", "B", "B", "D", "C",
            "B", "D", "A", "B", "B", "D", "A", "B"
        ];

        $fitness->setSolution($solution);
        expect($fitness->getFitness($individual))->toEqual( (float) 0);

        $solution = [
            "D", "A", "A", "A", "D", "B", "D", "D",
            "C", "A", "B", "C", "A", "C", "C", "B",
            "C", "D", "A", "A", "D", "C", "C", "A",
            "B", "D", "A", "D", "A", "D", "B", "A",
            "C", "C", "C", "B", "B", "C", "A", "D",
            "B", "A", "B", "B", "D", "B", "D", "C",
            "A", "A", "A", "B", "B", "B", "D", "C",
            "B", "D", "A", "B", "B", "D", "A", "B"
        ];

        $fitness->setSolution($solution);
        expect($fitness->getFitness($individual))->toEqual( (float) 50 );

    });

});