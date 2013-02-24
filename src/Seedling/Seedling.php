<?php

namespace Seedling;

abstract class Seedling {
  protected $seed;
  
  function __construct($seed = NULL) {
    if (empty($seed)) {
      $this->setSeed($this->createSeed());
    }
    else {
      $this->setSeed($seed);
    }
  }

  /**
   * Retrieve the seed used to prime the pseudo-random generator.
   *
   * @return int
   */
  public function getSeed() {
    return $this->seed;
  }

  /**
   * Re-initialize the pseudo-random generator.
   *
   * @param integer $seed;
   *
   * @return Seedling
   */
  public function setSeed($seed) {
    $this->seed = $seed;
    return $this;
  }

  /**
   * Retrieve a random element from an array.
   *
   * @param array $array
   *
   * @return mixed
   */
  public function selectFromArray($array) {
    return $array[$this->number(count($array))];
  }
  
  /**
   * Select a random element from a 2-dimensional array.
   *
   * @param array $array
   *
   * @return mixed
   */
  public function selectFromGrid($array) {
    $row = $array[$this->number(count($array))];
    return $row[$this->number(count($row))];
  }

  /**
   * Generates a new distinct seed.
   *
   * @return int
   */
  abstract protected static function createSeed();
  
  /**
   * Randomly reorder the provided array.
   *
   * @param array $array
   *
   * @return array
   */
  abstract public function shuffle($array);
  
  /**
   * Generate a random number.
   *
   * @param int $below
   *   If specified, the generated number will be in the range including 0 and
   *   up to but not including this number.
   *
   * @return int
   */
  abstract public function number($below = NULL);
}