<?php

namespace Introspekt\Output;

use Introspekt\Exception\AnnotationNotFoundException;
use Introspekt\Tokenizer\Tokenizer;

/**
 * Storage for the annotations contained in a string (typically a documentation block).
 */
class AnnotationsParcel
{
   private string $annotatedClassName;
   private array $classAnnotations;
   private array $methodsAnnotations;

   public function __construct(string $docCommentClass, array $docCommentsMethods, string $annotatedClassName)
   {
      $this->annotatedClassName = $annotatedClassName;
      $this->classAnnotations = (new Tokenizer($docCommentClass))->getAnnotationLanguageTokens();
      foreach ($docCommentsMethods as $methodName => $methodDocComment) {
         $this->methodsAnnotations[$methodName] = (new Tokenizer($methodDocComment))->getAnnotationLanguageTokens();
      }
   }

   public function hasAnnotation(string $annotationName, ?string $methodName = null): bool
   {
      $context = $this->getLookUpContext($methodName);
      if ($context !== null && array_key_exists($annotationName, $context)) {
         return true;
      }
      return false;
   }

   /**
    * Return the value of a given annotation.
    * 
    * @throws AnnotationNotFoundException
    */
   public function getAnnotation($annotationName, $methodName = null): mixed
   {
      if (
         $this->getLookUpContext($methodName) === null ||
         !$this->hasAnnotation($annotationName, $methodName)
      ) {
         throw new AnnotationNotFoundException($this->annotatedClassName, $annotationName, $methodName);
      }

      $data = null;
      $annotations = $this->getLookUpContext($methodName);
      $raw = $annotations[$annotationName];

      if (is_string($raw)) {
         $data = json_decode($raw, true);
      } else {
         // This is the stacked case: annotation name (e.g.: @Whatever) -> array of json strings
         $data = array_map(function ($s) {
            return json_decode($s, true);
         }, $raw);
      }

      return $data;
   }

   private function getLookUpContext($method): ?array
   {
      if ($method !== null) {
         if ($this->methodsAnnotations && array_key_exists($method, $this->methodsAnnotations)) {
            return $this->methodsAnnotations[$method];
         } else {
            return null;
         }
      } else {
         return $this->classAnnotations;
      }
   }
}
