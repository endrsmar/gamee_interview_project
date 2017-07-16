<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */

namespace Endrsmar\GameeInterviewProject\Tests;

use Endrsmar\GameeInterviewProject\Caching\FileCacheException;
use Endrsmar\GameeInterviewProject\Caching\FileCacheProvider;
use PHPUnit\Framework\TestCase;

class FileCacheTest extends TestCase 
{
    /**
     * @var FileCacheProvider
     */
    private static $cache;
    
    public static function setUpBeforeClass() 
    {
        mkdir('cache', 0777);
        static::$cache = new FileCacheProvider('cache');
    }
    
    public static function tearDownAfterClass() 
    {
        static::$cache->clear();
        rmdir('cache');
    }
    
    public function testAccessabilityCheck()
    {
        mkdir('cache_invalid', 0444);
        $this->expectException(FileCacheException::class);
        try {
            $cache = new FileCacheProvider('cache_invalid');
        } finally {
            rmdir('cache_invalid');
        }
    }
    
    public function testKeyExists()
    {
        $this->assertFalse(static::$cache->keyExists('test'));
        static::$cache->store('test', true);
        $this->assertTrue(static::$cache->keyExists('test'));
    }
    
    public function testStore()
    {
        $val = ['a' => 1, 'b' => 2];
        static::$cache->store('test', $val);
        $this->assertEquals($val, static::$cache->retrieve('test'));
    }
    
    public function testInvalidate()
    {
        static::$cache->store('test', true);
        static::$cache->invalidate('test');
        $this->assertFalse(static::$cache->keyExists('test'));
    }
    
    public function testClear()
    {
        static::$cache->store('test', true);
        static::$cache->store('test2', true);
        static::$cache->clear();
        $this->assertFalse(static::$cache->keyExists('test'));
        $this->assertFalse(static::$cache->keyExists('test2'));
    }
    
}
