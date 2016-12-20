<?php

namespace GA;

use GA\Selection\Elitism;
use GA\Selection\Tournament;
use GA\Fitness;

class Population
{
    private $encoding;
    private $population = [];

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

    /**
     * @return string
     */
    public function getEncoding() : string
    {
        return $this->encoding;
    }


    public function get() : array
    {
        return $this->population;
    }

    public function set(array $population = [])
    {
        $this->population = $population;
    }

    public function count()
    {
        return count($this->population);
    }

    public function evolve(Reproduction $reproduction, Fitness $fitness) : Population
    {
        $newPopulation = new Population($this->encoding);

        if(Settings::ELITISM) {
            $elitism = new Elitism();
            $elites = $elitism->getElites($this, $fitness);

            foreach($elites as $individual) {
                $newPopulation->add($individual);
            }
        }

        $tournament = new Tournament();

        while($newPopulation->count() < Settings::POPULATION_SIZE)
        {
            /* @var Individual $child1 */
            /* @var Individual $child2 */
            list($child1, $child2)= $reproduction->reproduce(
                $tournament->getWinner($this, $fitness),
                $tournament->getWinner($this, $fitness)
            );

            $encoding1 = $child1->encoding()->mutate();
            $encoding2 = $child2->encoding()->mutate();

            $offspring1 = new Individual($encoding1);
            $offspring2 = new Individual($encoding2);

            $newPopulation->add($offspring1);
            $newPopulation->add($offspring2);
        }

        return $newPopulation;
    }
}