<?php
use PHPUnit\Framework\TestCase;

final class AnalyzeControllerTest extends TestCase
{
    public function testEmpty(): array
    {
        $arrayData = [];
        $this->assertEmpty($arrayData);

        return $arrayData;
    }

    public function testStyle(): string
    {
        $styleData = '<style> some classess </style>';
        $this->assertStringContainsString('<style>',$styleData);

        return $styleData;
    }

    public function testClass(): string
    {
        $styleData = '<style> .some </style>';
        $this->assertStringContainsString('.',$styleData);

        return $styleData;
    }
}
