<?php

use PHPUnit\Framework\TestCase;
use introspekt\Introspekt;
use artifacts\Person;

class TypeStringAnnotationTest extends TestCase {

   public function testRetrievedValue() {
      $annotations = Introspekt::get(new Person());
      $this->assertEquals("Laurent", $annotations->getAnnotation("@Name"));
   }
}
