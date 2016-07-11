<?php

namespace GA\Selection;

use GA\Population;

abstract class AbstractSelection
{
    
    /* @var \GA\Population $population */
    protected $population;

    public function setPopulation(Population $population)
    {
        $this->population = $population;
    }
}