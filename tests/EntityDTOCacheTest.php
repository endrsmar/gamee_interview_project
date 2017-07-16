<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */

namespace Endrsmar\GameeInterviewProject\Tests;

use Endrsmar\GameeInterviewProject\Caching\EntityDTOCache;
use Endrsmar\GameeInterviewProject\Caching\FileCacheProvider;
use Endrsmar\GameeInterviewProject\DTO\EntityDTO;
use PHPUnit\Framework\TestCase;

class EntityDTOCacheTest extends TestCase
{
    
    /**
     * @var EntityDTOCache
     */
    private static $cache;
    
    public static function setUpBeforeClass() 
    {
        mkdir('cache', 0777);
        static::$cache = new EntityDTOCache(new FileCacheProvider('cache'));
    }
    
    public static function tearDownAfterClass() 
    {
        static::$cache->clear();
        rmdir('cache');
    }
    
    public function testStore()
    {
        $dto1 = new TestEntityDTO(1, 10, 'test');
        $dto2 = new TestEntityDTO(2, 50, 'test2');
        static::$cache->store($dto1);
        static::$cache->store($dto2);
        $this->assertTrue(static::$cache->contains(TestEntityDTO::class, 1));
        $this->assertTrue(static::$cache->contains(TestEntityDTO::class, 2));
        $this->assertEquals($dto1, static::$cache->retrieve(TestEntityDTO::class, 1));
        $this->assertEquals($dto2, static::$cache->retrieve(TestEntityDTO::class, 2));
    }
    
}

class TestEntityDTO extends EntityDTO
{
    
    /**
     * @var int
     */
    private $cost;
    
    /**
     * @var string
     */
    private $description;
    
    public function __construct(int $identification, int $cost, string $description)
    {
        parent::__construct($identification);
        $this->cost = $cost;
        $this->description = $description;
    }
    
}
