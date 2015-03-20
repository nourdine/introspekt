<?php

use introspekt\Introspekt;
use artifacts\Person;

class MissingAnnotationTest extends PHPUnit_Framework_TestCase {

   /**
    * @expectedException introspekt\exception\NoAnnotationFoundException
    */
   public function testRetrieval() {
      Introspekt::get(new Person())->getAnnotation("@Not");
   }
}