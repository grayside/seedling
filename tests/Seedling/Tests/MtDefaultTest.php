<?php
namespace Seedling\Tests;

use Seedling\Method\MtDefault;

/**
 * @covers Seedling
 */
class MtDefaultTest extends \PHPUnit_Framework_TestCase {

  public function testMakeSeed() {
    $random = new MTDefault();
    $this->assertTrue(is_numeric($random->getSeed()));
  }
  
  public function testInitializeWithSeed() {
    $random = new MTDefault(42);
    $this->assertEquals(42, $random->getSeed());
    $this->assertEquals(1354439493, $random->number());
  }
  
  public function testChangeSeed() {
    $random = new MTDefault(42);
    $random->setSeed(53);
    $this->assertEquals(53, $random->getSeed());
    $this->assertEquals(320117370, $random->number());
  }
  
  public function testShuffle() {
    $ordered = range(0, 5);
    $random = new MtDefault(42);
    $this->assertEquals(array(3,4,5,2,0,1), $random->shuffle($ordered));
  }
  
  public function testShuffleEmptyArray() {
    $random = new MtDefault(42);
    $this->assertEquals(array(), $random->shuffle(array()));
  }
  
  public function testRandomToOne() {
    $random = new MtDefault(42);
    $this->assertEquals(0, $random->number(1), 'A random number below 1 should always be 0.');
  }
  
  public function testSelectFromArray() {
    $random = new MtDefault(42);
    $ordered = range(0, 5);
    $this->assertEquals(3, $random->selectFromArray($ordered));
  }
  
  public function testSelectFromGrid() {
    $random = new MtDefault(42);
    $ordered = array(array(1, 2, 3), array(4, 5, 6), array(7, 8, 9));
    $this->assertEquals(6, $random->selectFromGrid($ordered));    
  }
}