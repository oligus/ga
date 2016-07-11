<?php

namespace GA\Fitness;

use GA\Fitness;

abstract class AbstractFitness implements Fitness
{
    private $solution;

    public function __construct($solution = null)
    {
        if(!is_null($solution)) {
            $this->solution = $solution;
        }
    }

    public function getSolution() {
        return $this->solution;
    }

    public function setSolution($solution) {
        $this->solution = $solution;
    }
}