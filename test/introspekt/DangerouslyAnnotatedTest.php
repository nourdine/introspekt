<?php

use PHPUnit\Framework\TestCase;
use introspekt\Introspekt;
use artifacts\Danger;
use introspekt\AnnotationsParcel;

class DangerouslyAnnotatedTest extends TestCase {

   public function testDangerousAnnotationValues() {
      $annotations = Introspekt::get(new Danger());
      $this->assertEquals("admin@yahoo.com", $annotations->getAnnotation("@Email"));
   }
}