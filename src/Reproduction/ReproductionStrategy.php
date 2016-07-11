<?php

namespace GA\Reproduction;

use Ga\Individual;

interface ReproductionStrategy
{
    public function reproduce(Individual $father, Individual $mother);
}