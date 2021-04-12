<?php

use PHPUnit\Framework\TestCase;
use introspekt\Introspekt;
use artifacts\StackedNull;
use artifacts\StackedString;
use artifacts\StackedArray;
use artifacts\StackedObject;

class AnnotationStackingTest extends TestCase {

   public function testStackingNulls() {
      $anno = Introspekt::get(new StackedNull());
      $nill = $anno->getAnnotation("@Nill");
      $this->assertFalse(is_array($nill));
      $this->assertTrue(is_null($nill));
   }

   public function testStackingStrings() {
      $anno = Introspekt::get(new StackedString());
      $nationalities = $anno->getAnnotation("@Nationality");
      $this->assertEquals(3, count($nationalities)); // stacked annotations ARE MERGED when containing identical values
      $this->assertTrue(is_array($nationalities));
      $this->assertTrue(is_string($nationalities[0]));
      $this->assertTrue($nationalities[0] == "Italian");
      $this->assertTrue($nationalities[1] == "English");
   }

   public function testStackingArrays() {
      $anno = Introspekt::get(new StackedArray());
      $langArrays = $anno->getAnnotation("@Languages");
      $this->assertEquals(2, count($langArrays));
      $this->assertEquals("php", $langArrays[0][0]);
      $this->assertEquals("haskell", $langArrays[1][1]);
   }

   public function testStackingObjects() {
      $anno = Introspekt::get(new StackedObject());
      $queryParams = $anno->getAnnotation("@QueryParam");
      $this->assertEquals(3, count($queryParams));
      $this->assertEquals("fabs", $queryParams[0]["name"]);
      $this->assertEquals("text", $queryParams[1]["surname"]);
      $this->assertEquals("nowhere", $queryParams[2]["nationality"]);
   }
}