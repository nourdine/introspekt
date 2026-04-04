<?php

declare(strict_types=1);

namespace Introspekt;

class Tokenizer
{
   private $annotations;
   private $raw;

   public function __construct(string $raw)
   {
      $this->raw = $raw;
   }

   /**
    * Identify the tokens of ALL the annotations contained in a string (tipically a documentation comment block).
    * Allows annotations with the same name to be stacked on top of each other with NO REPEATED VALUES!
    */
   public function getAnnotationLanguageTokens(): array
   {
      $this->annotations = [];
      $matches = $this->pregMatchAll($this->raw);
      if (count($matches[0]) > 0) {
         $annotationNames = $matches[1];
         $annotationValues = $this->stripWS($matches[2]);
         for ($i = 0; $i < count($matches[0]); $i++) {
            $this->addAnnotation(
               $annotationNames[$i],
               $this->normalizeValue($annotationValues[$i])
            );
         }
      }
      return $this->annotations;
   }

   private function addAnnotation(string $name, string $value): void
   {
      if (!key_exists($name, $this->annotations)) {
         $this->annotations[$name] = $value;
      } else {
         $this->mergeWithExistingValues($name, $value);
      }
   }

   private function mergeWithExistingValues(string $key, string $value): void
   {
      if (is_string($this->annotations[$key])) {
         if ($value !== $this->annotations[$key]) {
            $old = $this->annotations[$key];
            $this->annotations[$key] = [$old, $value];
         }
      } else {
         // it's already an array
         if (false === array_search($value, $this->annotations[$key], true)) {
            $this->annotations[$key][] = $value;
         }
      }
   }

   private function pregMatchAll(string $str): array
   {
      $pattern = '/(@[A-Za-z0-9_\-]+)\s*(?:\((.*?)\))?/s';
      preg_match_all($pattern, $str, $match);
      return $match;
   }

   /**
    * "Null", "null" (and uppercased/lowercased variations) and the empty string ("") are turned into `null`
    */
   private function normalizeValue(string $str): string
   {
      if ($str === "" || strtolower($str) === "null") {
         $str = "null";
      }
      return $str;
   }

   private function stripWS($str)
   {
      return preg_replace('/\s+(?=(?:[^"]*"[^"]*")*[^"]*$)/', '', $str);
   }
}
