<?php

use PHPUnit\Framework\TestCase;

use Bmonteirog\Loripsum\Wrapper as Wrapper;

class WrapperTest extends TestCase
{

    protected $wrapper;
    protected $paragraphRegex = '/<p>.*?<\/p>/m';

    public function testCanCreateWrapper()
    {
        $this->wrapper = new Wrapper;

        $this->assertTrue($this->wrapper instanceof Bmonteirog\Loripsum\Wrapper);
        $this->assertTrue($this->wrapper instanceof Bmonteirog\Loripsum\WrapperInterface);
        $this->assertFalse($this->wrapper instanceof Bmonteirog\Loripsum\WrapperUndefined);
    }

    /**
     * @depends testCanCreateWrapper
     */
    public function testCanRenderDefault()
    {
        $this->wrapper = new Wrapper;

        $output = $this->wrapper->render();

        $paragraph_count = preg_match_all($this->paragraphRegex, $output);

        // Check if the response is 4 paragraphs of random text
        $this->assertFalse($paragraph_count == 3);
        $this->assertTrue($paragraph_count == 4);
        $this->assertFalse($paragraph_count == 5);
    }

    /**
     * @depends testCanCreateWrapper
     */
    public function testCanSetNumberOfParagraphs()
    {
        $numberOfPsToRender = rand(1,6);

        $this->wrapper = new Wrapper;
        $output = $this->wrapper->render($numberOfPsToRender);

        $paragraph_count = preg_match_all($this->paragraphRegex, $output);

        $this->assertTrue($paragraph_count == $numberOfPsToRender);
    }

    /**
     * @depends testCanCreateWrapper
     */
    public function testCanSetLengthOfParagraphs()
    {
        $avaliableLengths = [
            'short',
            'medium',
            'long',
            'verylong'
        ];

        $length = $avaliableLengths[rand(0,3)];

        $this->wrapper = new Wrapper;
        $url = $this->wrapper->length($length)->getMountedEndpoint();

        $this->assertTrue('http://loripsum.net/api/4/'.$length == $url);
    }

    /**
     * @depends testCanCreateWrapper
     */
    public function testCanMountUrl()
    {
        // Check if the class can mount the URL
        // Let's select random attributes and call their methods
        // Then compare the url with the expected result.
        // That way we can test the class whithout actually
        // Hitting the API server

        $url = 'http://loripsum.net/api/4/medium';

        $this->wrapper = new Wrapper;

        $possibleAttributes = [
            'decorate' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'decorated'
            ],
            'link' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withLinks'
            ],
            'ul' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withUnorderedLists'
            ],
            'ol' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withNumberedLists'
            ],
            'dl' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withDescriptionLists'
            ],
            'bq' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withBlockquotes'
            ],
            'code' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withCode'
            ],
            'headers' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withHeaders'
            ],
            'allcaps' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'isAllCaps'
            ],
            'prude' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'isPrude'
            ],
            'plaintext' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'isPlaintext'
            ],
        ];

        foreach($possibleAttributes as $attrName => $attr){
            if($attr['call']){
                call_user_func([$this->wrapper, $attr['methodName']]);
                $url .= '/'.$attrName;
            }
        }

        $mounted = $this->wrapper->getMountedEndpoint();

        /*
        fwrite(STDERR, print_r($url, TRUE));
        fwrite(STDERR, print_r($mounted, TRUE));
        */
        $this->assertTrue($url == $mounted);
    }

    /**
     * @depends testCanCreateWrapper
     */
    public function testCanRenderMountedUrl()
    {
        // Based on ONE of the mounted URL's let's
        // hit the server and check the response.

        $this->wrapper = new Wrapper;

        $avaliableLengths = [
            'short',
            'medium',
            'long',
            'verylong'
        ];
        $numberOfPsToRender = rand(4,10);

        $length = $avaliableLengths[rand(0,3)];

        $this->wrapper->length($length);

        $possibleAttributes = [
            'decorate' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'decorated'
            ],
            'link' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withLinks'
            ],
            'ul' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withUnorderedLists'
            ],
            'ol' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withNumberedLists'
            ],
            'dl' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withDescriptionLists'
            ],
            'bq' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withBlockquotes'
            ],
            'code' => [
                'call' => (rand(0,1) == 1),
                'methodName' => 'withCode'
            ]
        ];

        foreach($possibleAttributes as $attrName => $attr){
            if($attr['call'])
                call_user_func([$this->wrapper, $attr['methodName']]);
        }

        $mounted = $this->wrapper->getMountedEndpoint();
        $output  = $this->wrapper->render($numberOfPsToRender);

        $paragraph_count = preg_match_all($this->paragraphRegex, $output);

        $this->assertTrue($numberOfPsToRender == $paragraph_count);
    }

}
