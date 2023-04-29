<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cron';

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
		 $page = file_get_contents($url."/getbrands");
        $page = file_get_contents($url."/getads");
        $page = file_get_contents($url."/getcampaigns");
        $page = file_get_contents($url."/cashback/getoffers");
        \Log::info("UpdateInfo: finished");
    }
}
