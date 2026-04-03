<?php

use PHPUnit\Framework\TestCase;
use introspekt\Introspekt;
use artifacts\Person;
use introspekt\exception\AnnotationNotFoundException;

class MissingAnnotationTest extends TestCase {

   public function testRetrieval() {
      $this->expectException(AnnotationNotFoundException::class);

      Introspekt::get(new Person())->getAnnotation("@Not");
   }
}