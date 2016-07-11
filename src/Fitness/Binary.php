<?php

namespace GA\Fitness;

use GA\Individual;

class Binary extends AbstractFitness
{
    public function getFitness(Individual $individual) 
    {
        $chromosome = $individual->getChromosome();
        $score = 0;
        for($i = 0; $i < strlen($chromosome); $i++) {
            $geneA = substr($chromosome, $i, 1);
            $geneB = substr($this->getSolution(), $i, 1);
            if($geneA === $geneB) {
                $score++;
            }
        }

        return ($score/strlen($chromosome)) * 100;
    }

}