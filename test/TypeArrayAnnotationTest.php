<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Hacker;

class TypeArrayAnnotationTest extends TestCase
{
   public function testRetrievedValue()
   {
      $annotations = Introspekt::get(new Hacker());
      $langs = $annotations->getAnnotation("@Languages");
      $this->assertEquals("array", gettype($langs));
      $this->assertTrue(3 === count($langs));
      $this->assertEquals("php", $langs[0]);
      $this->assertEquals("java", $langs[1]);
      $this->assertEquals("JavaScript", $langs[2]);
   }
}
