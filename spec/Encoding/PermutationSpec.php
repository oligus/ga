<?php

use GA\Encoding\Permutation;
use GA\Settings;

describe('Permutation encoding', function() {

    it('should create chromosome', function() {
        mt_srand(5);
        $perm = new Permutation('7234164417584919778328939456116224543858911785391363896666279297');
        expect($perm->chromosome())->toBe('7234164417584919778328939456116224543858911785391363896666279297');
    });

    it('should throw', function() {
        $callable = function() {
            new Permutation('7234164417584919778');
        };

        expect($callable)->toThrow('GA\Encoding\EncodingException');
    });


    it('should generate chromosome', function() {
        mt_srand(5);

        $perm = new Permutation();
        expect($perm->generate())->toBe('7234164417584919778328939456116224543858911785391363896666279297');
    });

    it('should mutate', function() {
        mt_srand(5);
        $perm = new Permutation('7234164417584919778328939456116224543858911785391363896666279297');

        expect($perm->chromosome())
            ->toEqual('7234164417584919778328939456116224543858911785391363896666279297');

        $newPerm = $perm->mutate();

        // Swaps position 3 and 50 by chance
        //    *                                              *
        // 7234164417584919778328939456116224543858911785391363896666279297
        //    |                                              |
        // 7236164417584919778328939456116224543858911785391343896666279297
        expect($newPerm->chromosome())
            ->toEqual('7236164417584919778328939456116224543858911785391343896666279297');
    });

});
