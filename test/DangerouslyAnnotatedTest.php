<?php

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Danger;

class DangerouslyAnnotatedTest extends TestCase {

   public function testDangerousAnnotationValues() {
      $annotations = Introspekt::get(new Danger());
      $this->assertEquals("admin@yahoo.com", $annotations->getAnnotation("@Email"));
   }
}