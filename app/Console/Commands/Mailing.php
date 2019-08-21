<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Mailing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailing-merchants {type}{--f|date_from}{--t|date_to}{--m|merchant_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mails to merchants by types of mailing';

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
     * @return mixed
     */
    public function handle()
    {





        if ( $this->argument('type') == 1)
        {
//return    $this->info('1');
        }

        if ( $this->argument('type') == 2)
        {
//return    $this->info('1');
        }

        $this->error('Неверное значение type');

    }
}
