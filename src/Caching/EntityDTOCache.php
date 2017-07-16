<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */
namespace Endrsmar\GameeInterviewProject\Caching;

use Endrsmar\GameeInterviewProject\DTO\EntityDTO;

class EntityDTOCache
{
    
    /**
     * @var CacheProvider
     */
    private $cache;
    
    /**
     * @param CacheProvider $cache
     */
    public function __construct(CacheProvider $cache)
    {
        $this->cache = $cache;
    }
    
    /**
     * Checks for presence of EntityDTO in cache
     * @param string $dtoType
     * @param int $identification
     * @throws CacheException Thrown when fatal error in cache storage occurs
     * @return bool
     */
    public function contains(string $dtoType, int $identification) : bool
    {
        return $this->cache->keyExists($this->getCacheKey($dtoType, $identification));
    }
    
    /**
     * Retrieves EntityDTO from cache
     * @param string $dtoType
     * @param int $identification
     * @return EntityDTO
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function retrieve(string $dtoType, int $identification) : EntityDTO
    {
        return $this->cache->retrieve($this->getCacheKey($dtoType, $identification));
    }
    
    /**
     * Invalidates EntityDTO cache
     * @param string $dtoType
     * @param int $identification
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function invalidate(string $dtoType, int $identification)
    {
        $this->cache->invalidate($this->getCacheKey($dtoType, $identification));
    }
    
    /**
     * Clears EntityDTO cache
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function clear()
    {
        $this->cache->clear();
    }
    
    /**
     * Stores EntityDTO in cache
     * @param EntityDTO
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function store(EntityDTO $dto)
    {
        $this->cache->store($this->getCacheKey(get_class($dto), $dto->identification), $dto);
    }
    
    /**
     * Returns cache key for DTO specification
     * @param string $dtoType
     * @param int $identification
     * @return string
     */
    private function getCacheKey(string $dtoType, int $identification) : string
    {
        return $dtoType.'_'.$identification;
    }
    
}
