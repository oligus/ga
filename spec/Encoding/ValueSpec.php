<?php

use GA\Encoding\Value;
use GA\Settings;

describe('Value encoding', function() {

    $genes = ['up', 'down', 'backward', 'forward'];

    it('should create chromosome', function() use ($genes) {
        mt_srand(5);
        $value = new Value(null, $genes);

        $result = ['forward', 'up', 'up', 'up', 'forward', 'down', 'forward', 'forward', 'backward', 'up', 'down', 'backward', 'up', 'backward', 'backward', 'down', 'backward', 'forward', 'up', 'up', 'forward', 'backward', 'backward', 'up', 'down', 'forward', 'up', 'forward', 'up', 'forward', 'down', 'up', 'down', 'up', 'down', 'up', 'backward', 'down', 'down', 'backward', 'backward', 'backward', 'backward', 'up', 'backward', 'forward', 'down', 'forward', 'down', 'forward', 'forward', 'up', 'up', 'forward', 'up', 'down', 'up', 'up', 'forward', 'up', 'up', 'down', 'forward', 'backward'];
        expect($value->chromosome())->toBe($result);
    });

    it('should only accept array', function() {
        $callable = function() { new Value(null, 234234); };
        expect($callable)->toThrow('GA\Encoding\EncodingException');
        $callable = function() { new Value(null, "moo"); };
        expect($callable)->toThrow('GA\Encoding\EncodingException');
    });

    it('should generate chromosome', function() use ($genes) {
        mt_srand(5);
        $value = new Value(null, $genes);
        $result = ['backward', 'up', 'up', 'down', 'up', 'backward', 'down', 'down', 'up', 'backward', 'down', 'forward', 'down', 'forward', 'up', 'forward', 'backward', 'backward', 'forward', 'down', 'up', 'forward', 'forward', 'down', 'forward', 'down', 'backward', 'backward', 'up', 'up', 'backward', 'up', 'up', 'down', 'down', 'down', 'up', 'forward', 'down', 'forward', 'forward', 'up', 'up', 'backward', 'forward', 'backward', 'down', 'forward', 'up', 'down', 'backward', 'up', 'forward', 'forward', 'backward', 'backward', 'backward', 'backward', 'up', 'backward', 'forward', 'up', 'forward', 'backward'];
        expect($value->generate())->toBe($result);
    });

    it('should mutate', function() use ($genes) {
        mt_srand(5);
        $value = new Value(null, $genes);
        $result = ['backward', 'up', 'up', 'down', 'up', 'backward', 'down', 'down', 'up', 'backward', 'down', 'forward', 'down', 'forward', 'up', 'forward', 'backward', 'backward', 'forward', 'down', 'up', 'forward', 'forward', 'down', 'forward', 'down', 'backward', 'backward', 'up', 'up', 'backward', 'up', 'up', 'down', 'down', 'down', 'up', 'forward', 'down', 'forward', 'forward', 'up', 'up', 'backward', 'forward', 'backward', 'down', 'forward', 'up', 'down', 'backward', 'up', 'forward', 'forward', 'backward', 'backward', 'backward', 'backward', 'up', 'backward', 'forward', 'up', 'forward', 'backward'];
        expect($value->generate())->toBe($result);

        $value->mutate();
    });

});
