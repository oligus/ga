<?php

namespace GA\Selection;

use GA\Population;

/**
 * Class AbstractSelection
 * @package GA\Selection
 */
abstract class AbstractSelection
{
    
    /* @var \GA\Population $population */
    protected $population;

    /**
     * @param Population $population
     */
    public function setPopulation(Population $population)
    {
        $this->population = $population;
    }
}