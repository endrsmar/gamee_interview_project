<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */

namespace Endrsmar\GameeInterviewProject\DAL\Adapters;

use Endrsmar\GameeInterviewProject\DAL\Exceptions\PersistenceException;
use Endrsmar\GameeInterviewProject\DAL\Exceptions\XmlLoaderException;
use Endrsmar\GameeInterviewProject\DAL\Loaders\XmlWatchLoader;
use Endrsmar\GameeInterviewProject\DAL\WatchPersistence;
use Endrsmar\GameeInterviewProject\DTO\WatchDTO;

class XmlWatchAdapter implements WatchPersistence {
    
    /**
     * @var XmlWatchLoader
     */
    private $loader;

    public function __construct(XmlWatchLoader $loader)
    {
        $this->loader = $loader;
    }  
    
    public function getWatchById(string $id)
    {
        try {
            $watchArr = $this->loader->loadByIdFromXml($id);
        } catch (XmlLoaderException $ex) {
            throw new PersistenceException($ex->getMessage());
        }
        if (!$watchArr) { return null; }
        return new WatchDTO(
            $watchArr['id'],
            $watchArr['title'],
            $watchArr['price'],
            $watchArr['description']
        );
    }

}
