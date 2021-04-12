<?php

namespace introspekt;

class Tokenizer {

   const TOKENS = "/(@[\w-]+) *(\((.*?)\))?/s"; // s stands for PCRE_DOTALL

   private $annotations;

   /**
    * Identify the tokens of ALL the annotations contained in a string (tipically a documentation comment block).
    * Allows annotations with the same name to be stacked on top of each other with NO REPEATED VALUES!
    * 
    * @param string $str
    * @return array
    */
   public function getAnnotationLanguageTokens($str) {

      $this->annotations = [];
      $matches = $this->pregMatchAll(self::TOKENS, $str);

      if (count($matches[0]) > 0) {

         $annotationNames = $matches[1];
         $annotationValues = $matches[3];

         for ($i = 0; $i < count($matches[0]); $i++) {
            $key = $annotationNames[$i];
            $value = $this->normalizeValue($annotationValues[$i]);
            $this->addAnnotation($key, $value);
         }
      }

      return $this->annotations;
   }

   private function addAnnotation($key, $value) {
      if (!key_exists($key, $this->annotations)) {
         $this->annotations[$key] = $value;
      } else {
         $this->mergeWithExistingValues($key, $value);
      }
   }

   private function mergeWithExistingValues($key, $value) {
      if (is_string($this->annotations[$key])) {
         if ($value !== $this->annotations[$key]) {
            $string = $this->annotations[$key];
            $this->annotations[$key] = [$string, $value];
         }
      } else {
         // it's already an array
         if (false === array_search($value, $this->annotations[$key], true)) {
            $this->annotations[$key][] = $value;
         }
      }
   }

   private function pregMatchAll($re, $str) {
      $match = [];
      preg_match_all($re, $str, $match);
      return $match;
   }

   /**
    * "Null", "null" (and uppercased/lowercased variations) and the empty string ("") must all be the same thing.
    * 
    * @param string $str
    * @return string 
    */
   private function normalizeValue($str) {
      if ($str === "" || strtolower($str) === "null") {
         $str = "null";
      }
      return $str;
   }
}