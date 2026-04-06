<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Person;
use artifacts\WebService;

/**
 * @runTestsInSeparateProcesses
 */
class InstancesOfAnnotationParcelTest extends TestCase
{
   public function testAnnotationsParcelsOfTheSameClassIsASingleInstance()
   {
      Introspekt::get(new Person);
      Introspekt::get(new Person);
      Introspekt::get(new Person);
      $this->assertEquals(1, Introspekt::countAnnotationsParcels());

      Introspekt::get(new WebService());
      $this->assertEquals(2, Introspekt::countAnnotationsParcels());
   }
}
