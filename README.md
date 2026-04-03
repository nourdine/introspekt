introspekt
==========

### 1. Intro

**introspekt** is an **annotations** library for php.

Annotations allow to add information (matadata) to classes and methods that can then be used at runtime to modify the behaviour of such entities.

### 2. It's all in the DocBlocks

Introspekt annotations needs to be defined inside the [DocBlock](http://en.wikipedia.org/wiki/PHPDoc#DocBlock) of a class or method. Here's an example of a DocBlock in php:

```php
/**
 * This is a documentation block! Not yet an annotation though :(
 */
class Foo { }
```

Obviously,  that doesn't contain any annotation yet. Here's what a simple string annotations would look like:

```php
/**
 * @Author("nourdine")
 */
class Foo { }
```

Now let's see what are the types of permitted annotations and then move on to see (in paragraph 4) how they can be retrieved and used programmatically.

### 3. Types and scopes

There are 4 types of annotations allowed in _introspekt_:

  1. **Null annotations (or marker annotations as they are called in java):** the value contained by this type od annotations is `null`. It can assume the following forms: 

```php
/**
 * @MyAnnotation
 * @MyAnnotation()
 * @MyAnnotation(null)
 */
class Foo { }
```

  2. **String annotations:** the value contained by this type of annotations is of type `string`: Here's an example: 

```php
/**
 * @MyAnnotation("nourdine")
 */
class Foo { }
```

  3. **Array annotations:** the value contained by this type of annotations is of type `array` (non associative): Here's an example: 

```php
/**
 * @MyAnnotation(["hi", "how", "are", "you", "?"])
 */
class Foo { }
```

  4. **Associative Array annotations:** the value contained by this type of annotations is of type `array` (associative): Here's an example: 

```php
/**
 * @MyAnnotation({
      "name": "nourdine",
      "age": "19",
      "languages": [
         "JavaScript,
         "php",
         "java"
      ]
   })
 */
class Foo { }
```

**Note:** When using arrays (associative and non) you are allowed to indent your annotation's code (instead of singleline it) provided that you **DO NOT** use the "asterisk" character at the beginning of each new line.

Finally, let's quickly point out how there are just two scopes you can target with your annotations:
  
  * class scope
  * method scope
  
  Here's some code sample that shows the two possible cases:

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

Now let's see how we can practically access information contained in annotations. To gain access to them, you need to obtain a `nourdine\introspekt\AnnotationsParcel` object containing a representation of the annotated data.

There are two possible ways to do this:

  1. Via an instance of the annotted class 
  2. Using the name of the class

Here's an example of the first type of access (we will use the class `AI` for ease of exposition):

```php
$hal = new AI();
// get an interface to the annotated class
$annotatedHal = Introspekt::get($hal);
// and now do cool things ...
$annotatedHal->getAnnotation("@Author"); // return "Nourdine": this is a class annotation 
$annotatedHal->getAnnotation("@Default", "answer"); // return 42 - this is a method annotation
```

The second access technique we mentioned (access through the class name) requires that you specify the _name_ of the class:

```php
$annotatedHal = Introspekt::get("AI");
// and now do cool things as above ...
```

if your classes are namespaced (who doesn't use namespaces these days?) you have to specify the **fully qualified name of the class**, namely the class's name preceded by the full namespace. In this very case you might need to double-escape certain backslashes that would otherwise be interpreted as _new line_ or _return_ characters (or anythig else of that sort). Suppose in fact you were trying to access the namespaced class `Nourdine\Recursion\Foo`. As you can see there is a `\n` (newline) in the fully-qualified name of the class and that would cause a problem to the interpreter. Therefore, this is how you must escape the backslash symbols in order for the script to work:

```php
$annotatedFoo = Introspekt::get("Nourdine\\Recursion\\Foo");
```

Finally remember that trying to access a non-existing annotation (both at the class or at the method's level) results in a `AnnotationNotFoundException` exception being thrown. Have a look: 

```php
try {
   $annotatedHal->getAnnotation("@Not"); // this will raise and exception ...
} catch (AnnotationNotFoundException $e) {
   echo $e->getMessage(); // ... and hence execution will get to this point!
}
```

### 5. Stacked annotations

When adding a certain annotation multiple times to a class or a method you get what we call a "stacked annotation". This will result in an array containg the different values you assigned to that annotation. So for instance you will have that:

```php
/**
 * @Name("Fabs")
 * @Name("Sbaf")
 */
class Foo {

}

$annotated = Introspekt::get("Foo");
$annotated->getAnnotation("@Name"); // this will return ["Fabs", "Sbaf"]
```

In some cases this feature con be really useful. Also bear in mind that **repeated values won't be stacked together** and only a single instance of the value will be recorded.

### 6. Format your JSON annotations well!

Because _introspekt_ interbally relies on the usage of [json_decode](http://ch2.php.net/manual/en/function.json-decode.php), you have to remember to carefully format your JSON annotation values.

Here's [an excerpt taken from php.net](http://www.php.net/manual/en/function.json-decode.php#example-3422) that shows possible issues related to the way you will format your JSON annotations:

```php
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
