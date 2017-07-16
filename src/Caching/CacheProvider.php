<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */
namespace Endrsmar\GameeInterviewProject\Caching;

use RuntimeException;

/**
 * Cache storage interface, cache expiration is ignored as per task declaration
 */
interface CacheProvider
{
    
    /**
     * Checks for existence of a key in the cache storage
     * @param string $key
     * @return bool
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function keyExists(string $key) : bool;
    
    /**
     * Stores entry in cache storage
     * @param string $key
     * @param mixed $value
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function store(string $key, $value);
    
    /**
     * Retrieves entry from cache storage
     * @param string $key
     * @return mixed
     * @throws CacheKeyNoFoundException Thrown when cache does not contain
     *                                  given key
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function retrieve(string $key);
    
    /**
     * Invalidates entry from cache storage
     * @param string $key
     * @throws CacheKeyNotFoundException Thrown when cache does not contain
     *                                   given key
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function invalidate(string $key);
    
    /**
     * Clears whole cache
     * @throws CacheException Thrown when fatal error in cache storage occurs
     */
    public function clear();
    
}

class CacheException extends RuntimeException { }
class CacheKeyNotFoundException extends CacheException { }
