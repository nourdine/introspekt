<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\WebService;

class TypeObjectAnnotationTest extends TestCase
{
   public function testRetrievedValue()
   {
      $data = Introspekt::get(new WebService())->getAnnotation("@ServiceData");
      $this->assertEquals("array", gettype($data));
      $this->assertTrue(2 === count($data));
      $this->assertEquals("8080", $data["port"]);
      $this->assertEquals("http://www.something.blabla/api/", $data["URI"]);
   }
}
