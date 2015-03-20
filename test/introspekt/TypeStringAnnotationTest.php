<?php

use introspekt\Introspekt;
use artifacts\Person;

class TypeStringAnnotationTest extends PHPUnit_Framework_TestCase {

   public function testRetrievedValue() {
      $annotations = Introspekt::get(new Person());
      $this->assertEquals("Laurent", $annotations->getAnnotation("@Name"));
   }
}
