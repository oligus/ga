<?php

namespace GA;

use GA\Selection\Elitism;
use GA\Selection\Tournament;
use GA\Fitness;

class Population
{
    private $encoding;
    private $population = [];

    /* @var Fitness $fitness */
    private $fitness;

    public function __construct($encoding = 'binary')
    {
        $this->encoding = $encoding;
    }

    public function generate($size = null)
    {
        if(is_null($size)) {
            $size = Settings::POPULATION_SIZE;
        }

        for($i = 0; $i < $size; $i++) {
            $encoding = Encoding::create($this->encoding);
            $individual = new Individual($encoding);
            $this->add($individual);
        }
    }

    public function add(Individual $individual)
    {
        $this->population[] = $individual;
    }

    public function get()
    {
        return $this->population;
    }

    public function count()
    {
        return count($this->population);
    }

    public function setFitness(Fitness $fitness)
    {
        $this->fitness = $fitness;
    }

    public function getFitness()
    {
        return $this->fitness;
    }

    public function orderByFitness()
    {
        usort($this->population, function(Individual $a, Individual $b) {
            if ($this->fitness->getValue($a) === $this->fitness->getValue($b)) {
                return 0;
            }
            return ($this->fitness->getValue($a) < $this->fitness->getValue($b)) ? 1 : -1;
        });
    }

    /**
     * @return \GA\Individual
     */
    public function getFittest()
    {
        $this->orderByFitness();
        return $this->population[0];
    }

    public function evolve(Reproduction $reproduction) : Population
    {
        $newPopulation = new Population($this->fitness);

        if(Settings::ELITISM) {
            $elitism = new Elitism();
            $elites = $elitism->getElites($this);

            foreach($elites as $individual) {
                $newPopulation->add($individual);
            }
        }

        $tournament = new Tournament();
        
        while($newPopulation->count() < Settings::POPULATION_SIZE)
        {
            list($child1, $child2)= $reproduction->reproduce(
                $tournament->getWinner($this),
                $tournament->getWinner($this)
            );

            $child1->setFitness($this->fitness);
            $child2->setFitness($this->fitness);

            $child1->mutate();
            $child2->mutate();
            $newPopulation->add($child1);
            $newPopulation->add($child2);
        }

        return $newPopulation;

    }
}