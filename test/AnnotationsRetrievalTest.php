<?php

use PHPUnit\Framework\TestCase;
use artifacts\Hacker;
use Introspekt\AnnotationsParcel;
use Introspekt\Introspekt;

class AnnotationsRetrievalTest extends TestCase {

   public function testRetrievalUsingObject() {
      Introspekt::get(new Hacker());
      $this->assertTrue(Introspekt::get(new Hacker) instanceof AnnotationsParcel);
   }

   public function testRetrievalUsingClassName() {
      // note the double escape to prevent \n in \nourdine to be interpreted as a new line character
      Introspekt::get("artifacts\Hacker");
      $this->assertTrue(Introspekt::get(new Hacker) instanceof AnnotationsParcel);
   }
}