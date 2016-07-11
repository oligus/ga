<?php

namespace GA;

use GA\Fitness;

class Individual
{
    private $genes = "01";
    private $chromosome;

    /* @var Fitness $fitness */
    private $fitness;

    public function __construct($chromosome = null)
    {
        if(!is_null($chromosome)) {
            $this->setChromosome($chromosome);
        }
    }

    public function setChromosome($chromosome)
    {
        $this->chromosome = $chromosome;
    }

    public function getChromosome()
    {
        return $this->chromosome;
    }

    public function generate()
    {
        $chromosome = '';
        for($i = 0; $i < Settings::CHROMOSOME_SIZE; $i++) {
            $position = mt_rand(0, strlen($this->genes) - 1);
            $chromosome = $chromosome . substr($this->genes, $position, 1);
        }

        $this->setChromosome($chromosome);
    }

    public function mutate()
    {
        for($i = 0; $i < Settings::CHROMOSOME_SIZE; $i++) {
            $rnd = (float)mt_rand()/(float)getrandmax();

            if($rnd <= (1 / Settings::CHROMOSOME_SIZE)) {
                $gene = substr($this->chromosome, $i , 1);
                $newGene = $this->flipBit($gene);
                $this->chromosome = substr_replace($this->chromosome, $newGene, $i, 1);
            }
        }
    }

    public function flipBit($bit = null)
    {
        $position = mt_rand(0, strlen($this->genes) - 1);

        if(is_null($bit)) {
            return substr($this->genes, $position, 1);
        }

        if($bit === "1") {
            return "0";
        }

        return "1";
    }

    /**
     * @param Fitness $fitness
     */
    public function setFitness(Fitness $fitness)
    {
        $this->fitness = $fitness;
    }

    /**
     * @return Fitness
     */
    public function getFitness()
    {
        return $this->fitness->getFitness($this);
    }
}