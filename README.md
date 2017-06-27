# Loripsum API Wrapper in PHP

## Usage

```php
<?php

$loripsum = new Bmonteirog\Loripsum\Wrapper;

echo $loripsum->render(); // Render 4 paragraphs in default Mode

echo $loripsum->length('short')
              ->withLinks()
              ->render(2); // Render 2 short paragraphs with links

echo $loripsum->length('short')
              ->isPlaintext()
              ->render(2);     // Render 2 short plain text paragraphs

echo $loripsum->length('verylong')
              ->decorated()
              ->withLinks()
              ->withUnorderedLists()
              ->withNumberedLists()
              ->withDescriptionLists()
              ->withBlockquotes()
              ->withCode()
              ->withHeaders()
              ->isAllCaps()
              ->isPrude()
              ->render(10); // Render 10 verylong paragraphs with All options           
```
