<?php

namespace GA;

interface Fitness
{
    public function setSolution($solution);
    public function getSolution();
    public function getFitness(Individual $individual);
}
