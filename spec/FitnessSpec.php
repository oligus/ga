<?php

use GA\Fitness;
use GA\Individual;
use GA\Population;
use GA\Encoding\Binary;
use GA\Encoding\Value;

describe('Fitness', function() {

    it('it should get fitness by string', function() {
        mt_srand(5);

        $individual = new Individual(new Binary());

        $fitness1 = new Fitness('1100101110010110110011100101010000001001111011010110010000100011');
        expect($fitness1->getValue($individual))->toEqual( 98.4375);

        $fitness2 = new Fitness('1111111111111111111111111111111111111111111111111111111111111111');
        expect($fitness2->getValue($individual))->toEqual(46.875);

        $fitness3 = new Fitness('1000101110010110110011100101010000001001111011010110010000100011');
        expect($fitness3->getValue($individual))->toEqual((float) 100);

        $fitness4 = new Fitness('0111010001101001001100011010101111110110000100101001101111011100');
        expect($fitness4->getValue($individual))->toEqual((float) 0);
    });

    it('it should get fitness by array', function() {
        mt_srand(5);

        $individual = new Individual(new Value(null, ['A', 'B', 'C', 'D']));

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
        $fitness1 = new Fitness($solution);

        expect($fitness1->getValue($individual))->toEqual(21.875);

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
        $fitness2 = new Fitness($solution);
        expect($fitness2->getValue($individual))->toBe( (float) 100);

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

        $fitness3 = new Fitness($solution);
        expect($fitness3->getValue($individual))->toEqual( (float) 0);

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

        $fitness4 = new Fitness($solution);
        expect($fitness4->getValue($individual))->toEqual( (float) 50 );
    });

    it('should order by fittest', function() {
        mt_srand(5);

        $population = new Population('binary');
        $population->generate(5);
        expect($population->count())->toEqual(5);

        $fitness = new \GA\Fitness('1111111111000000000011111111110000000000111111111100000000001010');
        $population = $fitness->orderByFitness($population);

        expect($fitness->getValue($population->get()[0]))
            ->toBeGreaterThan($fitness->getValue($population->get()[1]));

        expect($fitness->getValue($population->get()[1]))
            ->toBeGreaterThan($fitness->getValue($population->get()[2]));

        expect($fitness->getValue($population->get()[2]))
            ->toBeGreaterThan($fitness->getValue($population->get()[3]));

    });

    it('should get the fittest individual', function() {
        mt_srand(5);

        $population = new Population('binary');
        $population->generate(5);
        expect($population->count())->toEqual(5);

        $fitness = new \GA\Fitness('1111111111000000000011111111110000000000111111111100000000001010');
        $individual = $fitness->getFittest($population);

        expect($individual->encoding()->chromosome())->toEqual('1000101110010110110011100101010000001001111011010110010000100011');
    });
});