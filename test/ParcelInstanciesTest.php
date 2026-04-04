<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Introspekt\Introspekt;
use artifacts\Hacker;
use artifacts\WebService;

/**
 * @runTestsInSeparateProcesses
 */
class ParcelInstanciesTest extends TestCase
{
   public function testAnnotationsParcelsOfTheSameClassIsASingleInstance()
   {
      Introspekt::get(new Hacker);
      Introspekt::get(new Hacker);
      Introspekt::get(new Hacker);
      $this->assertEquals(1, Introspekt::countAnnotationsParcels());

      Introspekt::get(new WebService());
      $this->assertEquals(2, Introspekt::countAnnotationsParcels());
   }
}
