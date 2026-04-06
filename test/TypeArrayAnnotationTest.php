<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Person;

class TypeArrayAnnotationTest extends TestCase
{
   public function testRetrievedValue()
   {
      $annotations = Introspekt::get(new Person());
      $nationalities = $annotations->getAnnotation("@Nationality");
      $this->assertEquals("array", gettype($nationalities));
      $this->assertTrue(2 === count($nationalities));
      $this->assertEquals("British", $nationalities[0]);
      $this->assertEquals("French", $nationalities[1]);
   }
}
