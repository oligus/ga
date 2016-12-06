<?php

use GA\Population;

describe('Population', function() {

    xit('should return fittest', function() {
        mt_srand(5);

        $fitness = new \GA\Fitness\Binary();
        $fitness->setSolution('1111111111000000000011111111110000000000111111111100000000001010');

        $population = new Population($fitness);
        $population->generate();
        expect($population->count())->toEqual(200);

        expect($population->getFittest()->getChromosome())->toEqual('0010111111001100100111111100110001100010010101111110001110001010');
        expect($population->getFittest()->getFitness())->toEqual(70.3125);
    });

    xit('should generate population', function() {
        $population = new Population(new \GA\Fitness\Binary());
        $population->generate();
        expect($population->count())->toEqual(200);
    });

    xit('should remove individual', function() {
        mt_srand(5);
        $population = new Population(new \GA\Fitness\Binary());
        $population->generate();
        expect($population->count())->toEqual(200);

        $individualId = mt_rand(0, $population->count() - 1);
        $individual = $population->get()[$individualId];

        $population->removeIndividual($individual);

        expect($population->count())->toEqual(199);
    });

    xit('should evolve', function() {
        mt_srand(5);
        $population = new Population(new \GA\Fitness\Binary('1111111111000000000011111111110000000000111111111100000000001010'));
        $population->generate(10);
        expect($population->count())->toEqual(10);

        $generation = 1;
        echo "Generation " .  $generation . ' - Fittest: ' . $population->getFittest()->getFitness() . "\n";

        $myPop = $population->evolve(new \GA\Reproduction\UniformCrossOver());

        while($myPop->getFittest()->getFitness() < 100) {

            $myPop = $myPop->evolve(new \GA\Reproduction\UniformCrossOver());
            echo "Generation " .  $generation . ' - Fittest: ' . $myPop->getFittest()->getFitness() . "\n";
            $generation++;

            //Bail
            if($generation > 2000) {
                break;
            }

        }
        
    });
});