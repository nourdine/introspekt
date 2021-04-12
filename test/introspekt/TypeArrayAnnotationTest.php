<?php

use PHPUnit\Framework\TestCase;
use introspekt\Introspekt;
use artifacts\Hacker;

class TypeArrayAnnotationTest extends TestCase {

   public function testRetrievedValue() {
      $annotations = Introspekt::get(new Hacker());
      $langs = $annotations->getAnnotation("@Languages");
      $this->assertTrue(3 === count($langs));
      $this->assertEquals("php", $langs[0]);
      $this->assertEquals("javascript", $langs[2]);
   }
}