<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Vehicle;
class deleteVehicles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:vehicles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command deletes softDeleted vehicles';

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
        Vehicle::where('deleted_at')->where('insurance_date', '<=', date('Y-m-d'))->delete();
    }
}
