<?php

use GA\Individual;


describe('Individual', function() {

    $individual = new Individual();
    
    it('it should generate chromosome', function() use ($individual) {
        mt_srand(5);
        $individual->generate();
       
        expect($individual->getChromosome())
            ->toEqual('1000101110010110110011100101010000001001111011010110010000100011');
    });
    
    it('should mutate', function() use ($individual) {
        mt_srand(5);
        $individual->generate();

        expect($individual->getChromosome())
            ->toEqual('1000101110010110110011100101010000001001111011010110010000100011');

        $individual->mutate();

        // Flips bit 8 and 13 by chance
        expect($individual->getChromosome())
            ->toEqual('1000101100010010110011100101010000001001111011010110010000100011');

        
    });
    
    it('shouldflip bits', function() use ($individual) {
        mt_srand(5);
        $individual->generate();
        expect($individual->flipBit())->toEqual("1");
        expect($individual->flipBit($exclude = "1"))->toEqual("0");
        expect($individual->flipBit($exclude = "0"))->toEqual("1");
    });

});