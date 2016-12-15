<?php

use GA\Population;
use GA\Fitness;

describe('Population', function() {

    it('should generate population', function() {
        mt_srand(5);
        $population = new Population('binary');
        $population->generate();
        expect($population->count())->toEqual(200);
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