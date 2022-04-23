<?php

namespace App\Exceptions\Base;

use Exception;

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

    public function __construct(int $code = self::HTTP_OK, $message = '',  array $data = [])
    {
        $this->data = $data;
        parent::__construct($message, $code);
    }

    public function render()
    {
        $content = [
            'code' => $this->code,
            'data' => $this->data,
            'message' => empty($this->message) ? $this->getErrorMessage($this->code) : $this->message,
            'timestamp' => time()
        ];

        return response()->json($content);
    }

    /**
     * 获取错误message
     *
     * @param $code
     * @return mixed
     */
    function getErrorMessage($code)
    {
        $err = require_once __DIR__ . '/error.php';
        return $err[$code];
    }


}
