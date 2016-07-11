<?php

use GA\Selection\Tournament;
use GA\Population;
use GA\Fitness\Binary;

describe('Tournament', function() {

    $tournament = new Tournament();

    it('should select best fit out of tournament pool', function() use ($tournament) {
        mt_srand(5);

        $binary = new Binary();
        $binary->setSolution('1010111111111111111111111111111111111111111111111111111111111111');

        $population = new Population($binary);
        $population->generate(100);

        $winner = $tournament->getWinner($population);
        expect($winner->getChromosome())->toEqual('0010001100110111011111110010101111001101111011010111100101011010');
    });

});