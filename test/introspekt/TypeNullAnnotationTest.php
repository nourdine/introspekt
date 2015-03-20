<?php

use introspekt\Introspekt;
use artifacts\DBBean;
use artifacts\StackedNull;

class TypeNullAnnotationTest extends PHPUnit_Framework_TestCase {

   private $annotations = null;

   public function setUp() {
      $this->annotations = Introspekt::get(new DBBean());
   }

   public function testRetrievedAnnotationValueWithEmptyBrackets() {
      $exist = $this->annotations->hasAnnotation("@Persisted");
      $value = $this->annotations->getAnnotation("@Persisted");
      $this->assertTrue($exist);
      $this->assertTrue(is_null($value));
   }

   public function testRetrievedAnnotationValueWithNoBrackets() {
      $exist = $this->annotations->hasAnnotation("@Cool");
      $value = $this->annotations->getAnnotation("@Cool");
      $this->assertTrue($exist);
      $this->assertTrue(is_null($value));
   }

   public function testRetrievedAnnotationValueWithNull() {
      $exist = $this->annotations->hasAnnotation("@Yeah");
      $value = $this->annotations->getAnnotation("@Yeah");
      $this->assertTrue($exist);
      $this->assertTrue(is_null($value));
   }
}