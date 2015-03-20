<?php

use introspekt\Introspekt;
use artifacts\Danger;
use introspekt\AnnotationsParcel;

class DangerouslyAnnotatedTest extends PHPUnit_Framework_TestCase {

   public function testDangerousAnnotationValues() {
      $annotations = Introspekt::get(new Danger());
      $this->assertEquals("admin@yahoo.com", $annotations->getAnnotation("@Email"));
   }
}
