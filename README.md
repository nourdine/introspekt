introspekt
==========

### 1. Intro

**introspekt** is a php library that implements a functionality that, as of the time of this writing, is completely missing in the language: **annotations**.

Annotations permit to add information (matadata) to classes and methods that can then be used at runtime to modify the behaviour of the scripts using such (annotated) classes/methods.

Annotations were born in the java world and the implementation provided by _introspekt_ are kind of different from the one that is available in such language. There are [libraries](http://code.google.com/p/addendum/) out there that more closely mimic java's annotations but I thought to provide here a more laid back implementation, possibly more performant and based on the usage of annotations carrying JSON data structures rather than adopting the traditional java's annotations sintax.

### 2. It's all about comments

The only trick that we (as php developers) can possibly use to simulate annotations is adding meta information to a [DocBlock](http://en.wikipedia.org/wiki/PHPDoc#DocBlock). Here's an example of a DocBlock in php:

```php
/**
 * This is a documentation block! Not yet an annotation though :(
 */
class Foo { }
```

But that doesn't contain any annotation yet. Here's what a simple string annotations would look like:

```php
/**
 * @Author("nourdine")
 */
class Foo { }
```

Now let's see what are the types of annotations permitted in _introspekt_ and then move on to see (in paragraph 4) how they can be retrieved and used programmatically.

### 3. Types and scopes

There are 4 types of annotations allowed in _introspekt_:

  * `null` annotations (or marker annotations as they are called in java). The value contained by this type od annotations is `null`. It can assume the following forms: 

```php
/**
 * @MyAnnotation
 * @MyAnnotation()
 * @MyAnnotation(null)
 */
class Foo { }
```

  * String annotations. The value contained by this type of annotations is of type `string`: Here's an example: 

```php
/**
 * @MyAnnotation("nourdine")
 */
class Foo { }
```

  * Array annotations. The value contained by this type of annotations is of type `array` (non associative): Here's an example: 

```php
/**
 * @MyAnnotation(["hi", "how", "are", "you", "?"])
 */
class Foo { }
```

  * Associative Array annotations. The value contained by this type of annotations is of type `array` (associative): Here's an example: 

```php
/**
 * @MyAnnotation({
      "name": "nourdine",
      "age": "30something",
      "languages": [
         "JavaScript,
         "php",
         "java"]
   })
 */
class Foo { }
```

**[Note!]** When using arrays (associative and non) you are allowed to indent your annotation's code (instead of singleline it) provided that you do not use the "asterisk" character at the beginning of each new line.

Finally let's quickly point out how there are just two scopes you can target with your funky annotations: _classes_ and _methods_. Here's some code sample that shows the two possible cases:

```php
/**
 * @Author("Nourdine")
 */
class AI { 
   
   /**
    * @Default(42)
    */
   public function answer(Context $c) {
      
   } 
}
```

### 4. Retrieve and use annotations

Now let's see how we can practically access information contained into annotations. To gain access to the class' annotations you need to obtain a `nourdine\introspekt\AnnotationsParcel` object containing a representation of this data. There are two possible ways to do this:

  * via an instance of the annotted class 
  * using the name of the class

Here's an example of the first access method (the sample will use the class `AI` for ease of exposition):

```php
// make an instance
$hal = new AI();
// get an interface to the annotated class
$annotatedHal = Introspekt::get($hal);
// and now do cool things ...
$annotatedHal->getAnnotation("@Author"); // Nourdine - this is a class annotation 
$annotatedHal->getAnnotation("@Default", "answer"); // 42 - this is a method annotation
```

The second access technique we mentioned (access through the class name) requires that you specify the _name_ of the class. Here follows some code:

```php
$annotatedHal = Introspekt::get("AI");
// and now do cool things as above ...
```

In the case of _namespaced classes_ (that is to say classes contained in a file that defines a [namespace](http://php.net/manual/en/language.namespaces.php)) you have to specify the **full name of the class**, namely the class's name preceded by the full namespace. In this very case you might need to double-escape certain backslashes that would otherwise be interpreted as _new line_ or _return_ characters (or anythig else of that sort). Suppose in fact you were trying to access the namespaced class `net\nourdine\recursion\Foo`. As you can see there is a `\n` and an `\r` in the fully-qualified name of the class Foo. And so you must make sure to escape those guys twice in order to have the script to work alright. Something like this would surely do:

```php
$annotatedFoo = Introspekt::get("net\\nourdine\\recursion\Foo");
```

All clear? 

Finally remember that trying to access a non-existing annotation (both a class' or a method's one) results in a `NoAnnotationFoundException` exception being thrown. Have a look: 

```php
try {
   $annotatedHal->getAnnotation("@Not"); // this will raise and exception ...
} catch (NoAnnotationFoundException $e) {
   echo $e->getMessage(); // ... and hence execution will get to this point!
}
```

### 5. Stacked annotations

When adding a certain annotation multiple times to a class or a method you get what we call a "stacked annotation"; that is to say an array containg the different values you assigned to a certain annotation type. So for instance you will have that:

```php
/**
 * @name("Fabs")
 * @name("Sbaf")
 */
class C {
   // bla bla bla...
}

$annotatedC = Introspekt::get("C");
$annotatedC->getAnnotation("@name"); // this is an array contanining ALL the names assigned to C using the @name annotation (namely Fabs and Sabf)
```

In some cases this feature con be really useful. Also bear in mind that **repeated values won't be stacked together** and only a single instance of the value will be recorded.

### 6. Format your JSON annotations well!

Because _introspekt_ relies on the internal usage of [json_decode](http://ch2.php.net/manual/en/function.json-decode.php) you have to remember to carefully format your JSON annotations values right! Here's [an excerpt taken from php.net](http://www.php.net/manual/en/function.json-decode.php#example-3422) that shows possible issues related to the way you format your JSON annotations:

```php
// the following strings are valid JavaScript but not valid JSON

// the name and value must be enclosed in double quotes
// single quotes are not valid 
$bad_json = "{ 'bar': 'baz' }";
json_decode($bad_json); // null

// the name must be enclosed in double quotes
$bad_json = '{ bar: "baz" }';
json_decode($bad_json); // null

// trailing commas are not allowed
$bad_json = '{ bar: "baz", }';
json_decode($bad_json); // null
```

### 7. Running Unit Tests

```
composer install
composer run-script test
```
