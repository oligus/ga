<?php

namespace GA\Selection;

use GA\Fitness;
use GA\Individual;
use GA\Population;
use GA\Settings;

class Tournament extends AbstractSelection
{
    public function getWinner(Population $population)
    {
        $pool = $this->getPool($population);

        $fittest = $pool[0];

        foreach($pool as $individual) {
            if($population->getFitnessFunction()->getFitness($individual) > $fittest->getFitness() ) {
                $fittest = $individual;
            }
        }

        return $fittest;
    }

    private function getPool(Population $population)
    {
        $pool = [];

        for($i = 0; $i < Settings::TOURNAMENT_POOL_SIZE; $i++) {
            $individualId = mt_rand(0, $population->count() - 1);
            $individual = $population->get()[$individualId];

            if($individual instanceof Individual) {
                $pool[] = $individual;
            }

        }

        return $pool;
    }

}