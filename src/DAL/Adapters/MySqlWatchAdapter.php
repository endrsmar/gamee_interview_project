<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */

namespace Endrsmar\GameeInterviewProject\DAL\Adapters;

use Endrsmar\GameeInterviewProject\DAL\Exceptions\MySqlRepositoryException;
use Endrsmar\GameeInterviewProject\DAL\Exceptions\PersistenceException;
use Endrsmar\GameeInterviewProject\DAL\Repositories\MySqlWatchNotFoundException;
use Endrsmar\GameeInterviewProject\DAL\Repositories\MySqlWatchRepository;
use Endrsmar\GameeInterviewProject\DAL\WatchPersistence;

class MySqlWatchAdapter implements WatchPersistence
{
    
    /**
     * @var MySqlWatchRepository
     */
    private $repository;
    
    public function __construct(MySqlWatchRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function getWatchById(int $id)
    {
        try {
            $watch = $this->repository->getWatchById($id);
        } catch (MySqlWatchNotFoundException $ex) {
            return null;
        } catch (MySqlRepositoryException $ex) {
            throw new PersistenceException($ex->getMessage());
        }
        return new WatchDTO(
            $watch->id,
            $watch->title,
            $watch->price,
            $watch->description
        );
    }

}
