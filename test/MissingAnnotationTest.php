<?php

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Person;
use Introspekt\Exception\AnnotationNotFoundException;

class MissingAnnotationTest extends TestCase {

   public function testRetrieval() {
      $this->expectException(AnnotationNotFoundException::class);

      Introspekt::get(new Person())->getAnnotation("@Not");
   }
}