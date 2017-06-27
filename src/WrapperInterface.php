<?php declare(strict_types = 1);

namespace Loripsum;

interface WrapperInterface
{

    public function render($paragraphs = 4) : string;

    public function length($length) : WrapperInterface;

    public function decorated() : WrapperInterface;

    public function withLinks() : WrapperInterface;

    public function withUnorderedLists() : WrapperInterface;

    public function withNumberedLists() : WrapperInterface;

    public function withDescriptionLists() : WrapperInterface;

    public function withBlockquotes() : WrapperInterface;

    public function withCode() : WrapperInterface;

    public function withHeaders() : WrapperInterface;

    public function isAllCaps() : WrapperInterface;

    public function isPrude() : WrapperInterface;

    public function isPlaintext() : WrapperInterface;

    public function getMountedEndpoint() : string;
}
