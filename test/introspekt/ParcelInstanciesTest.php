<?php

use PHPUnit\Framework\TestCase;
use introspekt\Introspekt;
use artifacts\Hacker;
use artifacts\WebService;

/**
 * @runTestsInSeparateProcesses
 */
class ParcelInstanciesTest extends TestCase {

   public function testAnnotationsParcelsOfTheSameClassAreASingleInstance() {

      $hackerAnnotations1 = Introspekt::get(new Hacker);
      $hackerAnnotations2 = Introspekt::get(new Hacker);
      $hackerAnnotations3 = Introspekt::get(new Hacker);

      $this->assertEquals(1, count(Introspekt::getAnnotationsParcels()));
           
      $wsAnnotations = Introspekt::get(new WebService());
      
      $this->assertEquals(2, count(Introspekt::getAnnotationsParcels()));
   }
}