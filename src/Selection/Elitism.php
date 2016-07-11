<?php

namespace GA\Selection;

use GA\Population;
use GA\Fitness;
use GA\Settings;

class Elitism extends AbstractSelection
{
    public function getElites(Population $population)
    {
        $population->orderByFitness();
        $pool = $population->get();
        $pool = array_slice($pool, 0, Settings::ELITISM_POOL_SIZE);

        return $pool;
    }
}