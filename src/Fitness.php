<?php

namespace GA;

class Fitness
{
    private $solution;

    public function __construct()
    {

    }

    public function setSolution($solution)
    {
        $this->solution = $solution;
    }

    public function getSolution()
    {
        return $this->solution;
    }

    public function getFitness(Individual $individual) : float
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
}
