<?php

use introspekt\Introspekt;
use artifacts\Geometry;

class TypeNumberAnnotationTest extends PHPUnit_Framework_TestCase {

   public function testRetrievedValue() {
      $annotations = Introspekt::get(new Geometry());
      $this->assertEquals(3.14159, $annotations->getAnnotation("@PI"));
      $this->assertEquals(5, $annotations->getAnnotation("@ShapeSides"));
   }
}
