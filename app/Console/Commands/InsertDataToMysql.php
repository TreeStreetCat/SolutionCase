<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;

class InsertDataToMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:data_mysql {table_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert into data to mysql table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $num = 10000000;
//        $this->connect('127.0.0.1', 'root','123456', 'test');
//        DB::connect("mysql://root:123456@127.0.0.1/test?charset=UTF‐8");
        $table_name = $this->argument('table_name');
        // 开启进度条
        $this->info("--开始执行--");
        $start_time = time();
        $bar = $this->output->createProgressBar($num);
        for ($i = 1; $i <= $num; $i++) {
            // 需要插入的数据
            $codeArr[$i]['name'] = $this->random_user();
            $codeArr[$i]['age'] = rand(1,100);
            // 每1w数据插入1次
            if ($i % 1000 == 0) {
                DB::connection('mysql_test')->table($table_name)->insert($codeArr);
                $codeArr = [];
            }
            $bar->advance();
        }
        $bar->finish();
        $this->info("--结束执行--共 ".(time()-$start_time) ." s");

    }

    /**
     * 生成随机姓名
     *
     * @param int $len
     * @return string
     */
    private function random_user($len = 8)
    {
        $user = '';
        $lchar = 0;
        $char = 0;
        for ($i = 0; $i < $len; $i++) {
            while ($char == $lchar) {
                $char = rand(48, 109);
                if ($char > 57) $char += 7;
                if ($char > 90) $char += 6;
            }
            $user .= chr($char);
            $lchar = $char;
        }
        return $user;
    }

    /**
     * 重置数据
     *
     * @param $hostname
     * @param $username
     * @param $password
     * @param $database
     */
    function connect($hostname, $username, $password, $database)
    {
        // Erase the tenant connection, thus making Laravel get the default values all over again.
        DB::purge('mysql');
        // Make sure to use the database name we want to establish a connection.
        Config::set('database.connections.mysql.host', $hostname);
        Config::set('database.connections.mysql.database', $database);
        Config::set('database.connections.mysql.username', $username);
        Config::set('database.connections.mysql.password', $password);
        // Rearrange the connection data
        DB::reconnect('mysql');
        // Ping the database. This will throw an exception in case the database does not exists.
        Schema::connection('mysql')->getConnection()->reconnect();
    }
}
