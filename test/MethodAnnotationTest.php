<?php

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Hacker;

class MethodAnnotationTest extends TestCase {

   public function testGetSimpleValue() {
      $annotations = Introspekt::get(new Hacker());
      $this->assertEquals($annotations->getAnnotation("@Target", "hackit"), "microsoft");
   }

   public function testGetComplexValue() {
      $annotations = Introspekt::get(new Hacker());
      $data = $annotations->getAnnotation("@Technologies", "hackit");
      $this->assertEquals($data[0], "telnet");
      $this->assertEquals($data[1], "python");
   }
}