<?php

namespace App\Console\Commands;

use App\Models\CrmCustomer;
use Illuminate\Console\Command;

class request_docs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'request:documents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Robot that emails leads requesting missing documents';

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

    }
}
