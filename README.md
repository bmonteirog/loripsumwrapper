# Loripsum API Wrapper in PHP

## Usage

````

$loripsum = new Loripsum\Wrapper;

echo $loripsum->render(); // Render 4 paragraphs in default Mode

echo $loripsum->length('short')
               ->withLinks()
               ->render(2); // Render 2 short paragraphs with links
````
