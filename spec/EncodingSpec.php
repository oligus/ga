<?php

use GA\Encoding;

describe('Encoding', function() {

    it('should create and return binary encoding', function() {
        mt_srand(5);
        $encoding = Encoding::create('binary');
        expect($encoding)->toBeAnInstanceOf('GA\Encoding\Binary');
        $encoding = Encoding::create('permutation');
        expect($encoding)->toBeAnInstanceOf('GA\Encoding\Permutation');
        $encoding = Encoding::create('value', null, ['A', 'B', 'C', 'D']);
        expect($encoding)->toBeAnInstanceOf('GA\Encoding\Value');
    });

});

