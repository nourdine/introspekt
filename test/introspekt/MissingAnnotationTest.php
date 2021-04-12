<?php

use PHPUnit\Framework\TestCase;
use introspekt\Introspekt;
use artifacts\Person;
use introspekt\exception\NoAnnotationFoundException;

class MissingAnnotationTest extends TestCase {

   public function testRetrieval() {
      $this->expectException(NoAnnotationFoundException::class);

      Introspekt::get(new Person())->getAnnotation("@Not");
   }
}