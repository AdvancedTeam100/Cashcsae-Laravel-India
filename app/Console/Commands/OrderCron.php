<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OrderCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:cron';

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
		$url=url('/');
         \Log::info("UpdateInfo: started");
		$page = file_get_contents($url."/cuelinkautofetchorders");
		$page = file_get_contents($url."/impactautofetchorders");
        \Log::info("UpdateInfo: finished");
    }
}
