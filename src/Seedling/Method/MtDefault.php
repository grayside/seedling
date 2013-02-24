<?php

/**
 * Wraps the core PHP Mersenne-Twister randomization engine into Seedling.
 */

namespace Seedling\Method;

class MtDefault extends \Seedling\Seedling {

  protected static function createSeed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
  }

  public function setSeed($seed) {
    parent::setSeed($seed);
    mt_srand($seed);

    return $this;
  }

  /**
   * Replacement for shuffle that relies on this class.
   *
   * @param array $arr
   * @param array $shuffled
   *   Internal use only.
   *
   * @return array
   */
  public function shuffle($arr, $shuffled = array()) {
    $count = count($arr);

    if ($count == 0) {
      return $shuffled;
    }
    if ($count == 1) {
      $shuffled[] = $arr[0];
      return $shuffled;
    }

    $key = $this->number($count);
    $shuffled[] = $arr[$key];
    unset($arr[$key]);

    return $this->shuffle(array_values($arr), $shuffled);
  }

  public function number($below = NULL) {
    if (!isset($below)) {
      return mt_rand();
    }
    // mt_rand() handles "0" as an unlimited request.
    elseif ($below == 1) {
      return 0;
    }
    else {
      return mt_rand(0, $below - 1);
    }
  }
}