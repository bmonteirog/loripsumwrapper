# Loripsum API Wrapper in PHP

## Installation

````
composer require bmonteirog/loripsumwrapper
````

## Usage

````
<?php

require __DIR__ . '/vendor/autoload.php';

$loripsum = new Loripsum\Wrapper;

echo $loripsum->render(); // Render 4 paragraphs in default Mode

echo $loripsum->length('short')
               ->withLinks()
               ->render(2); // Render 2 short paragraphs with links
````
