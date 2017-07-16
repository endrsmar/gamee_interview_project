<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */
namespace Endrsmar\GameeInterviewProject\DAL;

use Endrsmar\GameeInterviewProject\DAL\Exceptions\PersistenceException;
use Endrsmar\GameeInterviewProject\DTO\WatchDTO;

interface WatchPersistence
{
    
    /**
     * Retrieves WatchDTO from persistence
     * @param int id
     * @return WatchDTO|null Returns WatchDTO if watch was found, null otherwise
     * @throws PersistenceException Thrown when fatal error occurs
     *                              in underlying persistence accessor
     */
    public function getWatchById(int $id);
    
}
