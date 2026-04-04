<?php

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Danger;

class DangerouslyAnnotatedTest extends TestCase {

   public function testDangerousAnnotationValues() {
      $annotations = Introspekt::get(new Danger());
      $this->assertEquals("admin@something.blabla", $annotations->getAnnotation("@Email"));
   }
}