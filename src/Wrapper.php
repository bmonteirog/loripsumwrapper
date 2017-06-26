<?php declare(strict_types = 1);

namespace Loripsum;

class Wrapper implements WrapperInterface
{

    protected $wrapperInfo;
    protected $endpoint;
    protected $connection;

    protected $paragraphs; // (integer) - The number of paragraphs to generate. (Default 4)
    protected $length;     // short, medium, long, verylong - The average length of a paragraph. (Default medium)
    protected $decorate;   // - Add bold, italic and marked text. (Default false)
    protected $link;       // - Add links. (Default false)
    protected $ul;         // - Add unordered lists. (Default false)
    protected $ol;         // - Add numbered lists. (Default false)
    protected $dl;         // - Add description lists. (Default false)
    protected $bq;         // - Add blockquotes. (Default false)
    protected $code;       // - Add code samples. (Default false)
    protected $headers;    // - Add headers. (Default false)
    protected $allcaps;    // - Use ALL CAPS. (Default false)
    protected $prude;      // - Prude version. (Default false)
    protected $plaintext;  // - Return plain text, no HTML. (Default false)

    public function __construct()
    {
        $this->wrapperInfo = 'LoripsumWrapper/0.1 (bmonteirog@gmail.com)';
        $this->endpoint    = 'http://loripsum.net/api';

        $this->length = 'medium';
        $this->availableLengths = [
            'short',
            'medium',
            'long',
            'verylong'
        ];

        $this->decorate = false;
        $this->link = false;
        $this->ul = false;
        $this->ol = false;
        $this->dl = false;
        $this->bq = false;
        $this->code = false;
        $this->headers = false;
        $this->allcaps = false;
        $this->prude = false;
        $this->plaintext = false;
    }

    private function connectToEndpoint()
    {
        $this->connection = curl_init();
        curl_setopt($this->connection, CURLOPT_URL, $this->mountEndpoint());
        curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->connection, CURLOPT_USERAGENT, $this->wrapperInfo);
    }

    private function mountEndpoint()
    {
        $url = $this->endpoint;

        $url = $url . '/'.$this->paragraphs;

        $url = $url . '/'.$this->length;

        if($this->decorate)
            $url = $url . '/decorate';

        if($this->link)
            $url = $url . '/link';

        if($this->ul)
            $url = $url . '/ul';

        if($this->ol)
            $url = $url . '/ol';

        if($this->dl)
            $url = $url . '/dl';

        if($this->bq)
            $url = $url . '/bq';

        if($this->code)
            $url = $url . '/code';

        if($this->headers)
            $url = $url . '/headers';

        if($this->allcaps)
            $url = $url . '/allcaps';

        if($this->prude)
            $url = $url . '/prude';

        if($this->plaintext)
            $url = $url . '/plaintext';

        return $url;
    }

    private function requestJson()
    {
        $this->connectToEndpoint();
        $data = curl_exec($this->connection);
        curl_close($this->connection);

        return $data;
    }

    public function render($paragraphs = 4) : string
    {
        $this->paragraphs = $paragraphs;

        $response = $this->requestJson();

        return $response;
        //return $this->mountEndpoint();
    }

    public function length($length) : WrapperInterface
    {
        if(!in_array($length, $this->availableLengths))
            throw new InvalidLengthException("Invalid Length", 1);

        $this->length = $length;

        return $this;
    }

    public function decorated() : WrapperInterface
    {
        $this->decorate = true;

        return $this;
    }

    public function withLinks() : WrapperInterface
    {
        $this->link = true;

        return $this;
    }

    public function withUnorderedLists() : WrapperInterface
    {
        $this->ul = true;

        return $this;
    }

    public function withNumberedLists() : WrapperInterface
    {
        $this->ol = true;

        return $this;
    }

    public function withDescriptionLists() : WrapperInterface
    {
        $this->dl = true;

        return $this;
    }

    public function withBlockquotes() : WrapperInterface
    {
        $this->bq = true;

        return $this;
    }

    public function withCode() : WrapperInterface
    {
        $this->code = true;

        return $this;
    }

    public function withHeaders() : WrapperInterface
    {
        $this->headers = true;

        return $this;
    }

    public function isAllCaps() : WrapperInterface
    {
        $this->allcaps = true;

        return $this;
    }

    public function isPrude() : WrapperInterface
    {
        $this->prude = true;

        return $this;
    }

    public function isPlaintext() : WrapperInterface
    {
        $this->plaintext = true;

        return $this;
    }
}
