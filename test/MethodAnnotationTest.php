<?php

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Hacker;
use Introspekt\Exception\AnnotationNotFoundException;

class MethodAnnotationTest extends TestCase {

   public function testHasValue() {
      $annotations = Introspekt::get(new Hacker());
      $this->assertFalse($annotations->hasAnnotation("@Target"));
      $this->assertTrue($annotations->hasAnnotation("@Target", "hackit"));
   }

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

   public function testMissingValue() {
      $this->expectException(AnnotationNotFoundException::class);

      $annotations = Introspekt::get(new Hacker());
      $this->assertEquals($annotations->getAnnotation("@Nooooot", "hackit"));
   }
}