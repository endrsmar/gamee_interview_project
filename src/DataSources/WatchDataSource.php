<?php
namespace Endrsmar\GameeInterviewProject\DataSources;

use Endrsmar\GameeInterviewProject\Caching\CacheException;
use Endrsmar\GameeInterviewProject\Caching\EntityDTOCache;
use Endrsmar\GameeInterviewProject\DAL\Exceptions\PersistenceException;
use Endrsmar\GameeInterviewProject\DAL\WatchPersistence;
use Endrsmar\GameeInterviewProject\DTO\WatchDTO;
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */


class WatchDataSource
{

    /**
     * @var WatchPersistence
     */
    private $persistence;

    /**
     * @var EntityDTOCache
     */
    private $cache;

    public function __construct(
        WatchPersistence $persistence,
        EntityDTOCache $cache
    ) {
        $this->persistence = $persistence;
        $this->cache = $cache;
    }

    /**
     * @param int $id
     * @return WatchDTO|null
     * @throws PersistenceException Thrown when fatal error occurs in persistence
     */
    public function getWatchById(int $id) {
        try {
            if ($this->cache->contains(WatchDTO::class, $id)) {
                return $this->cache->retrieve(WatchDTO::class, $id);
            }
        } catch (CacheException $ex) { }
        $watch = $this->persistence->getWatchById($id);
        if ($watch) {
            try {
                $this->cache->store($watch);
            } catch (CacheException $ex) { }
        }
        return $watch;
    }

}