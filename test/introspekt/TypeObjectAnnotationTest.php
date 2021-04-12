<?php

use PHPUnit\Framework\TestCase;
use introspekt\Introspekt;
use artifacts\WebService;

class TypeObjectAnnotationTest extends TestCase {

   public function testRetrievedValue() {
      $data = Introspekt::get(new WebService())->getAnnotation("@ServiceData");
      $this->assertTrue(4 === count($data));
      $this->assertEquals("8001", $data["port"]);
      $this->assertEquals("hello123", $data["passw"]);
   }
}