<?php
/* 
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */
namespace Endrsmar\GameeInterviewProject\Tests;

use Endrsmar\GameeInterviewProject\DTO\EntityDTO;
use PHPUnit\Framework\TestCase;

class BaseDTOTest extends TestCase 
{
    
    public function testAsArray() 
    {
        $dto = new TestDTO(1, 'Foo', 1);
        $this->assertEquals(
            ['identification' => 1, 'propA' => 'Foo', 'propB' => 1],
            $dto->asArray()
        );
    }
 }
 
 class TestDTO extends EntityDTO 
 {
    /**
     * @var string
     */
    public $propA;
    
    /**
     * @var int
     */
    public $propB;
    
    /**
     * @param string $a
     * @param int $b
     */
    public function __construct(int $identification, string $a, int $b) 
    {
        parent::__construct($identification);
        $this->propA = $a;
        $this->propB = $b;
    }
}