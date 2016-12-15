<?php

namespace GA\Selection;

use GA\Fitness;
use GA\Individual;
use GA\Population;
use GA\Settings;

/**
 * Class Tournament
 * @package GA\Selection
 */
class Tournament extends AbstractSelection
{
    /**
     * @param Population $population
     * @param Fitness $fitness
     * @return Individual
     */
    public function getWinner(Population $population, Fitness $fitness) : Individual
    {
        $pool = $this->getPool($population);

        /* @var Individual $fittest */
        $fittest = $pool[0];

        foreach($pool as $individual) {
            if($fitness->getValue($individual) > $fitness->getValue($fittest)) {
                $fittest = $individual;
            }
        }

        return $fittest;
    }

    /**
     * @param Population $population
     * @return array
     */
    private function getPool(Population $population) : array
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