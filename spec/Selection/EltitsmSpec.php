<?php

use GA\Selection\Elitism;
use GA\Population;
use GA\Fitness\Binary;

describe('Elitism', function() {

    $elitism = new Elitism();

    xit('should', function() use ($elitism) {
        mt_srand(5);

        $population = new Population(new Binary('1010111111111111111111111111111111111111111111111111111111111111'));
        $population->generate(10);

        $elitism->setPopulation($population);
        
        $pool = $elitism->getElites($population);

        expect(count($pool))->toEqual(2);

        expect($pool[0]->getFitness())->toEqual(65.625);

    });
});