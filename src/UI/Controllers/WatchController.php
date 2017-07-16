<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */

namespace Endrsmar\GameeInterviewProject\UI\Controllers;

use Endrsmar\GameeInterviewProject\DAL\Exceptions\PersistenceException;
use Endrsmar\GameeInterviewProject\DataSources\WatchDataSource;
use Endrsmar\GameeInterviewProject\UI\Responses\ErrorResponse;
use Endrsmar\GameeInterviewProject\UI\Responses\JSONResponse;
use Endrsmar\GameeInterviewProject\UI\Responses\TextResponse;

class WatchController
{

    /**
     * @var WatchDataSource
     */
    private $dataSource;

    /**
     * @param \Endrsmar\GameeInterviewProject\UI\WatchDataSource $dataSource
     */
    public function __construct(
        WatchDataSource $dataSource
    ) {
        $this->dataSource = $dataSource;
    }

    public function getByIdAction($id)
    {
        if (!is_numeric($id) || !(floor($id) == $id) || $id < 0) {
            return new ErrorResponse(ErrorResponse::HTTP_BAD_REQUEST, 'id must be a positive whole number');
        }
        try {
            $watch = $this->dataSource->getWatchById($id);
        } catch (PersistenceException $ex) {
            return new TextResponse(ErrorResponse::HTTP_SERVER_ERROR,
                $this->debugMode() ? $ex->getMessage() : 'Server error'
            );
        }
        if (!$watch) {
            return new ErrorResponse(ErrorResponse::HTTP_NOT_FOUND, '');
        }
        return new JSONResponse(JSONResponse::HTTP_OK, $watch->asArray());
    }
}