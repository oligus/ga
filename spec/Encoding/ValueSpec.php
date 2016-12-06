<?php

use GA\Encoding\Value;
use GA\Settings;

describe('Value encoding', function() {

    it('should create chromosome', function() {
        $genes = ['up', 'down', 'backward', 'forward'];

        mt_srand(5);
        $value = new Value(null, $genes);

        $result = ['forward', 'up', 'up', 'up', 'forward', 'down', 'forward', 'forward', 'backward', 'up', 'down', 'backward', 'up', 'backward', 'backward', 'down', 'backward', 'forward', 'up', 'up', 'forward', 'backward', 'backward', 'up', 'down', 'forward', 'up', 'forward', 'up', 'forward', 'down', 'up', 'down', 'up', 'down', 'up', 'backward', 'down', 'down', 'backward', 'backward', 'backward', 'backward', 'up', 'backward', 'forward', 'down', 'forward', 'down', 'forward', 'forward', 'up', 'up', 'forward', 'up', 'down', 'up', 'up', 'forward', 'up', 'up', 'down', 'forward', 'backward'];
        expect($value->chromosome())->toBe($result);
    });


});
