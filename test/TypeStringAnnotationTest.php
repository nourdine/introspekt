<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Person;

class TypeStringAnnotationTest extends TestCase
{
   public function testRetrievedValue()
   {
      $annotations = Introspekt::get(new Person());
      $name = $annotations->getAnnotation("@Name");
      $this->assertEquals("string", gettype($name));
      $this->assertEquals("Foo", $name);
   }
}
