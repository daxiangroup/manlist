<?php

use DG\Service\NameService;

class NameServiceTest extends TestCase {

    private $nameService;

    public function setUp()
    {
        $this->nameService = new NameService();
    }

    public function testValidateFailsOnNull()
    {
        $this->assertFalse($this->nameService->validate(null));
    }

    public function testValidateFailsOnEmptyString()
    {
        $this->assertFalse($this->nameService->validate(''));
    }

    public function testValidateFailsOnNameNotEndingInMan()
    {
        $this->assertFalse($this->nameService->validate('somename'));
    }

    public function testValidateFailsOnNameWithNonAlphaCharacters()
    {
        $this->assertFalse($this->nameService->validate('!@#$%^&*?><?>}{man'));
    }

    public function testValidateFailsOnOnlyMan()
    {
        $this->assertFalse($this->nameService->validate('man'));
    }

    public function testValidateValidNames()
    {
        $this->assertTrue($this->nameService->validate('someman'));
        $this->assertTrue($this->nameService->validate('twomann'));
    }
}