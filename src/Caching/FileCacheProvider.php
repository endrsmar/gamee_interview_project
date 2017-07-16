<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */
namespace Endrsmar\GameeInterviewProject\Caching;

use DirectoryIterator;

/**
 * Implementation of ICacheProvider using files
 */
class FileCacheProvider implements CacheProvider 
{    
    /**
     * @var string 
     */
    private $cacheFolder;
    
    /**
     * @param string $cacheFolder
     * @throws FileCacheException Thrown when cache folder does not exist 
     *                            or is not writable
     */
    public function __construct(string $cacheFolder) 
    {
        $this->cacheFolder = $cacheFolder;
        if (!file_exists($this->cacheFolder) ||
            !is_writable($this->cacheFolder) ||
            !is_readable($this->cacheFolder)) {
            throw new FileCacheException('Cannot access cache folder');
        }
    }
    
    public function invalidate(string $key) 
    {
        if (!$this->keyExists($key)) {
            throw new CacheKeyNotFoundException();
        }
        unlink($this->getFilename($key));
    }

    public function keyExists(string $key): bool 
    {
        return file_exists($this->getFilename($key));
    }

    public function retrieve(string $key) 
    {
        if (!$this->keyExists($key)) {
            throw new CacheKeyNotFoundException();
        }
        if (!is_readable($this->getFilename($key))) {
            throw new FileCacheException('File is not readable');
        }
        return unserialize(file_get_contents($this->getFilename($key)));
    }

    public function store(string $key, $value) 
    {
        if ($this->keyExists($key)) {
            $this->invalidate($key);
        }
        if (!is_writable($this->cacheFolder)) {
            throw new FileCacheException('Cache folder is not writable');
        }
        if (!file_put_contents($this->getFilename($key), serialize($value))) {
            throw new FileCacheException('Failed to write a cache file');
        }
    }
    
    public function clear() 
    {
        if (!is_writable($this->cacheFolder)) {
            throw new FileCacheException('Cache folder is not writable');
        }
        foreach (new DirectoryIterator($this->cacheFolder) as $fileInfo) {
            if ($fileInfo->isDot()) { continue; }
            unlink($fileInfo->getPathname());
        }
    }

    /**
     * Returns filename for given key
     * @param string $key
     * @return string
     */
    private function getFilename(string $key) : string
    {
        if (!static::isValidFilename($key)) {
            $key = md5($key);
        }
        return $this->cacheFolder.'/'.$key.'.cache';
    }
    
    /**
     * Checks whether the value is a valid filename
     * @param string $val
     * @return bool
     */
    private static function isValidFilename(string $val) : bool
    {
        return !preg_match('/[^a-zA-Z0-9_\-\.]/', $val);
    }
    
}

class FileCacheException extends CacheException { }
