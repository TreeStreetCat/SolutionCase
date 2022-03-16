<?php

namespace App\Exceptions\Base;

use Exception;
use Throwable;

/**
 * 异常处理类
 *
 * Class BaseException
 * @package App\Exceptions\Base
 */
class BaseException extends Exception
{
    const HTTP_OK = 200;
    const HTTP_ERROR = 500;

    protected $data;

    public function __construct($message, int $code = self::HTTP_OK, array $data = [])
    {
        $this->data = $data;
        parent::__construct($message, $code);
    }

    public function render()
    {
        $content = [
            'code' => $this->code,
            'data' => $this->data ,
            'message' => $this->getErrorMessage($this->code),
            'timestamp' => time()
        ];

        return response()->json($content);
    }

    function getErrorMessage($code)
    {
        $err = require_once __DIR__.'/error.php';
        return $err[$code];
    }


}
