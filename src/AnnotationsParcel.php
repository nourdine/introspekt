<?php

namespace Introspekt;

use Introspekt\Exception\AnnotationNotFoundException;
use Introspekt\Tokenizer;
use RuntimeException;

/**
 * Storage for the annotations contained in a string (typically a documentation block).
 */
class AnnotationsParcel
{
   private $annotatedClassName = "";
   private $classAnnotations;
   private $methodsAnnotations;

   public function __construct($docCommentHeader, array $docCommentsMethods, string $annotatedClassName)
   {
      $this->annotatedClassName = $annotatedClassName;
      $this->classAnnotations = (new Tokenizer($docCommentHeader))->getAnnotationLanguageTokens();
      foreach ($docCommentsMethods as $methodName => $methodDocComment) {
         $this->methodsAnnotations[$methodName] = (new Tokenizer($methodDocComment))->getAnnotationLanguageTokens();
      }
   }

   /**
    * Check if a certain annotation exists.
    * 
    * @param string $annotationName
    * @param string $methodName The name of method to restric the annotation lookup to.
    * @return boolean
    */
   public function hasAnnotation($annotationName, $methodName = null)
   {
      return array_key_exists($annotationName, $this->retrieve($methodName));
   }

   /**
    * Return the value of a certain annotation.
    * 
    * @throws AnnotationNotFoundException
    * @param string $annotationName The name of the annotation to search for.
    * @param string $methodName The name of method to restric the annotation lookup to.
    * @return mixed The value of the annotation. It can be null, a string or an (associative) array.
    */
   public function getAnnotation($annotationName, $methodName = null)
   {

      if (!$this->hasAnnotation($annotationName, $methodName)) {
         throw new AnnotationNotFoundException($this->annotatedClassName, $annotationName, $methodName);
      }

      $data = null;
      $annotations = $this->retrieve($methodName);
      $json = $annotations[$annotationName];

      if (is_string($json)) {
         $data = json_decode($json, true);
      } else {
         // Stacked case! 1 key -> array of json strings
         $data = array_map(function ($s) {
            return json_decode($s, true);
         }, $json);
      }

      return $data;
   }

   private function retrieve($method)
   {

      $annotations = $this->classAnnotations;

      if ($method !== null) {
         if (is_null($this->methodsAnnotations) || !array_key_exists($method, $this->methodsAnnotations)) {
            throw new RuntimeException("The method " . $method . " does not exist");
         }
         $annotations = $this->methodsAnnotations[$method];
      }

      return $annotations;
   }
}
