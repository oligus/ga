<?php

use GA\Selection\Elitism;
use GA\Population;
use GA\Fitness\Binary;

describe('Elitism', function() {

    $elitism = new Elitism();

    it('should', function() use ($elitism) {
        mt_srand(5);

        $population = new Population('binary');
        $population->generate(10);
        $elitism->setPopulation($population);

        $fitness = new \GA\Fitness('1010111111111111111111111111111111111111111111111111111111111111');
        $pool = $elitism->getElites($population, $fitness);

        expect(count($pool))->toEqual(2);
        expect($fitness->getValue($pool[0]))->toEqual((float) 65.625);
    });
});