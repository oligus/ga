<?php

namespace GA;

use GA\Selection\Elitism;
use GA\Reproduction\ReproductionStrategy;
use GA\Selection\Tournament;

class Population
{
    private $population = [];
    private $fitness;

    public function __construct(Fitness $fitness)
    {
        $this->fitness = $fitness;
    }

    public function getFitnessFunction()
    {
        return $this->fitness;
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

    public function orderByFitness()
    {
        usort($this->population, function(Individual $a, Individual $b) {
            if ($this->fitness->getFitness($a) == $this->fitness->getFitness($b)) {
                return 0;
            }
            return ($this->fitness->getFitness($a) < $this->fitness->getFitness($b)) ? 1 : -1;
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

    public function generate($size = null)
    {
        if(is_null($size)) {
            $size = Settings::POPULATION_SIZE;
        }

        for($i = 0; $i < $size; $i++) {
            $individual = new Individual();
            $individual->generate();
            $individual->setFitness($this->fitness); // XXX Probably not needed
            $this->add($individual);
        }
    }

    // XXX Probably not needed
    public function removeIndividual(Individual $individual)
    {
        $key = null;
        
        /* @var \GA\Individual $popIndividual */
        foreach($this->population as $index => $popIndividual) {
            if($popIndividual->getChromosome() === $individual->getChromosome()) {
                $key = $index;
            }
        }

        if(!is_null($key)) {
            unset($this->population[$key]);
        }
    }

    public function evolve(ReproductionStrategy $reproduction) : Population
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