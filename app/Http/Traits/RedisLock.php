<?php

namespace App\Http\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;

trait RedisLock
{

    /**
     * 分布式锁 redis key 前缀.
     *
     * @var string
     */
    protected $prefixKey;
    /**
     * 分布式锁 redis key .
     *
     * @var string
     */
    protected $lockKey;

    /**
     * 活动来源
     *
     * @var array
     */
    protected $source;

    /**
     * redis 对象.
     *
     * @var Redis
     */
    protected $redis;

    /**
     * RedisLock constructor
     *
     * @param $prefix
     * @param $source
     * @param $typeValue
     */
    public function init($prefix, $source, $typeValue = "")
    {
        $this->prefixKey = $prefix;
        $this->source = $source;
        if ($typeValue) {
            $this->lockKey = $prefix . ":" . $source . ":" . $typeValue;
        } else {
            $this->lockKey = $prefix . ":" . $source;
        }
    }

    /**
     * 为抢读列表加上并发锁
     * 上锁超时时间默认为 5 秒钟
     *
     * @param int $time
     * @return bool
     */
    public function addLock($time = 5)
    {
        $expireTime = Carbon::now()->addSeconds($time)->timestamp;
        if ($this->redis->setnx($this->lockKey, $expireTime)) {
            return true;
        }
        // 获取加锁的value
        $currentValue = $this->redis->get($this->lockKey);
        $currentTime = time();

        // 锁过期
        if (!empty($currentValue) && $currentValue < $currentTime) {
            // 获取上一个锁的时间
            $oldValue = $this->redis->getset($this->lockKey, $expireTime);
            if (!empty($oldValue) && $oldValue == $currentValue) {
                return true;
            }
            return false;
        }
    }

    /**
     * 主动为分布式锁解锁
     *
     * @return void
     */
    public function unlock()
    {
        $this->redis->del($this->lockKey);
    }

    /**
     * 是否已上锁
     *
     * @return boolean
     */
    public function isLocked()
    {
        $is_lock = $this->redis->get($this->lockKey);
        return (!is_null($is_lock) && intval($is_lock));
    }
}
