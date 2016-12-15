<?php

namespace GA;

/**
 * Class Fitness
 * @package GA
 */
class Fitness
{
    private $solution;

    /**
     * Fitness constructor.
     * @param $solution
     * @throws GaException
     */
    public function __construct($solution)
    {
        if(empty($solution)) {
            throw new GaException('No solution is set for fitness');
        }

        $this->solution = $solution;
    }

    /**
     * @return string|array
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * @param Individual $individual
     * @return float
     */
    public function getValue(Individual $individual) : float
    {
        $chromosome = $individual->encoding()->chromosome();
        $score = 0;

        if($individual->encoding()->getType() === 'array') {
            $length = count($chromosome);
            for ($i = 0; $i < $length; $i++) {
                $geneA = $chromosome[$i];
                $geneB = $this->getSolution()[$i];
                if ($geneA === $geneB) {
                    $score++;
                }
            }
        } else {
            $length = strlen($chromosome);
            for ($i = 0; $i < $length; $i++) {
                $geneA = substr($chromosome, $i, 1);
                $geneB = substr($this->getSolution(), $i, 1);
                if ($geneA === $geneB) {
                    $score++;
                }
            }
        }

        $result = ($score/$length) * 100;

        return (double) $result;
    }

    /**
     * @param Population $population
     * @return Population
     */
    public function orderByFitness(Population $population) : Population
    {
        $pop = $population->get();

        usort($pop, function(Individual $a, Individual $b) {
            if ($this->getValue($a) === $this->getValue($b)) {
                return 0;
            }
            return ($this->getValue($a) < $this->getValue($b)) ? 1 : -1;
        });

        $newPopulation = new Population($population->getEncoding());
        $newPopulation->set($pop);
        return $newPopulation;
    }

    /**
     * @param \GA\Population $population
     * @return \GA\Individual
     */
    public function getFittest(Population $population) : Individual
    {
        $orderedPopulation = $this->orderByFitness($population);
        return $orderedPopulation->get()[0];
    }
}
