<?php


namespace App\Common;


use PhpEnum\Enum;

/**
 * 公共状态码
 *
 * Class CommonCode
 * @package App\Common
 */
class CommonCode extends Enum
{
    const INVALID_PARAM = [ 10000, "非法参数！"];
    const SUCCESS = [true, 10002, "操作成功！"];
    const FAIL = [false, 10003, "操作失败！"];
    const NO_MORE_DATAS = [false, 10004, "没有数据！"];
    const UNAUTHENTICATED = [false, 10005, "此操作需要登陆系统！"];
    const UNAUTHORISE = [false, 10006, "权限不足，无权操作！"];
    const SERVER_ERROR = [false, 99999, "抱歉，系统繁忙，请稍后重试！"];

    //操作是否成功
    private $success;
    //操作代码
    private $code;
    //提示信息
    private $message;

    /**
     * CommonCode constructor.
     * @param $success
     * @param $code
     * @param $message
     */
    protected function construct($success, $code, $message)
    {
        $this->success = $success;
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

}
