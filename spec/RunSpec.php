<?php

use \GA\Fitness\Binary;
use \GA\Population;

describe('Population', function() {

    it('should make a run for it', function() {
        $solution = new Binary('1111111111000000000011111111110000000000111111111100000000001010');
        $population = new Population($solution);

        $generation = 0;
        
        
    });
});