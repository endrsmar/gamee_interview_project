<?php
/*
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 * Created as part of interview process at GAMEE
 */

namespace Endrsmar\GameeInterviewProject\UI\Responses;

class ErrorResponse extends JSONResponse
{
    const HTTP_NOT_FOUND = 404;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_SERVER_ERROR = 500;

    /**
     * @param int $statusCode
     * @param string $msg
     */
    public function __construct(int $statusCode, string $msg)
    {
        parent::__construct($statusCode, ['msg' => $msg]);
    }

}