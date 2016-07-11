<?php

namespace GA;

abstract class Settings
{
    const POPULATION_SIZE = 200;
    const CHROMOSOME_SIZE = 64;
    const MUTATION_RATE = 0.004;
    const TOURNAMENT_POOL_SIZE = 5;

    /* Elitism */
    const ELITISM = true;
    const ELITISM_POOL_SIZE = 2;

    const UNIFORM_CROSSOVER_MIXING_RATIO = 0.5;
}