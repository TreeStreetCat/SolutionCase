<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $arr = array();
        $i = 0;
        while($i < 100){
            $i = $i + 1;
            $arr[] = $i;
        }
        $total = count($arr);
        $bar = $this->output->createProgressBar($total);
        for ($i = 0; $i < $total; $i++) {
            sleep(1);
//            $this->info($arr[$i]);
            $bar->advance();
        }
        $bar->finish();
    }
}
