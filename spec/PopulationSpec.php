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

        $population = new Population('binary', 5);
        $population->generate(5);
        expect($population->count())->toEqual(5);

        $fitness = new \GA\Fitness;
        $fitness->setSolution('1111111111000000000011111111110000000000111111111100000000001010');
        $population->setFitness($fitness);
        $population->orderByFitness();


        expect($population->getFitness()->getValue($population->get()[0]))
            ->toBeGreaterThan($population->getFitness()->getValue($population->get()[1]));

        expect($population->getFitness()->getValue($population->get()[1]))
            ->toBeGreaterThan($population->getFitness()->getValue($population->get()[2]));

        expect($population->getFitness()->getValue($population->get()[2]))
            ->toBeGreaterThan($population->getFitness()->getValue($population->get()[3]));
    });

    it('should get the fittest individual', function() {
        mt_srand(5);

        $population = new Population('binary', 5);
        $population->generate(5);
        expect($population->count())->toEqual(5);

        $fitness = new \GA\Fitness;
        $fitness->setSolution('1111111111000000000011111111110000000000111111111100000000001010');
        $population->setFitness($fitness);

        $individual = $population->getFittest();

        expect($individual->encoding()->chromosome())->toEqual('1000101110010110110011100101010000001001111011010110010000100011');
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