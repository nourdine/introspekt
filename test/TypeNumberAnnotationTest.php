<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Geometry;

class TypeNumberAnnotationTest extends TestCase
{
   public function testRetrievedValue()
   {
      $annotations = Introspekt::get(new Geometry());
      $PI = $annotations->getAnnotation("@PI");
      $sides = $annotations->getAnnotation("@ShapeSides");
      $this->assertEquals("double", gettype($PI));
      $this->assertEquals("integer", gettype($sides));
      $this->assertEquals(3.14159, $PI);
      $this->assertEquals(5, $sides);
   }
}
