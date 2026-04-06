<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\StackedNull;
use artifacts\StackedString;
use artifacts\StackedArray;
use artifacts\StackedObject;

class StackedAnnotationsTest extends TestCase
{
   public function testStackedNulls()
   {
      $annotations = Introspekt::get(new StackedNull());
      $nill = $annotations->getAnnotation("@Nill");
      $this->assertFalse(is_array($nill));
      $this->assertTrue(is_null($nill));
   }

   public function testStackedStrings()
   {
      $annotations = Introspekt::get(new StackedString());
      $nationalities = $annotations->getAnnotation("@Nationality");
      $this->assertEquals(3, count($nationalities));
      $this->assertTrue(is_array($nationalities));
      $this->assertTrue(is_string($nationalities[0]));
      $this->assertTrue($nationalities[0] == "Italian");
      $this->assertTrue($nationalities[1] == "English");
      $this->assertTrue($nationalities[2] == "French");
   }

   public function testStackedArrays()
   {
      $annotations = Introspekt::get(new StackedArray());
      $langArrays = $annotations->getAnnotation("@Languages");
      $this->assertEquals(2, count($langArrays));
      $this->assertEquals("php", $langArrays[0][0]);
      $this->assertEquals("haskell", $langArrays[1][1]);
   }

   public function testStackedObjects()
   {
      $annotations = Introspekt::get(new StackedObject());
      $queryParams = $annotations->getAnnotation("@QueryParam");
      $this->assertEquals(3, count($queryParams));
      $this->assertEquals("Nou", $queryParams[0]["name"]);
      $this->assertEquals("White", $queryParams[1]["surname"]);
      $this->assertEquals("nowhere", $queryParams[2]["nationality"]);
   }

   // TODO add tests for method level annotations
}
