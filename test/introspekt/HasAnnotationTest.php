<?php

use introspekt\Introspekt;
use artifacts\Hacker;
use artifacts\DBBean;

class HasAnnotationTest extends PHPUnit_Framework_TestCase {

   public function testValueExistance() {
      $this->assertTrue(Introspekt::get(new Hacker())->hasAnnotation("@Languages"));
      $this->assertTrue(Introspekt::get(new DBBean())->hasAnnotation("@Persisted"));
   }
}
