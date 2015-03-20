<?php

use introspekt\Introspekt;
use artifacts\Hacker;
use artifacts\WebService;

/**
 * @runTestsInSeparateProcesses
 */
class ParcelInstanciesTest extends PHPUnit_Framework_TestCase {

   public function testAnnotationsParcelsOfTheSameClassAreASingleInstance() {
      $hackerAnnotations1 = Introspekt::get(new Hacker);
      $hackerAnnotations2 = Introspekt::get(new Hacker);
      $hackerAnnotations3 = Introspekt::get(new Hacker);
      $this->assertEquals(1, count(Introspekt::getAnnotationsParcels()));
      $wsAnnotations = Introspekt::get(new WebService());
      $this->assertEquals(2, count(Introspekt::getAnnotationsParcels()));
      // note the double backslash to escape meta characters like \n and \t 
      $this->assertEquals(1, count(Introspekt::getAnnotationsParcelByClassName("artifacts\Hacker")));
      $this->assertEquals(1, count(Introspekt::getAnnotationsParcelByClassName("artifacts\WebService")));
   }
}