<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateVehicleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fields)
    {
        $this->data = $fields;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Vehicle::create([
            'car_brand' => $this->data['car_brand'],
            'model' => $this->data['model'],
            'color' => $this->data['color'],
            'other' => $this->data['other'],
            'issue_year' => $this->data['issue_year'],
            'image' => $this->data['image'],
            'plate_number' => $this->data['plate_number']
        ]);
    }
}
