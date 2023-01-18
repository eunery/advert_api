<?php

namespace App\Jobs;

use App\Models\OrderImage;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleImage;
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

    private $fields;
    private $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fields, $user_id)
    {
        $this->fields = $fields;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $vehicle = Vehicle::create([
            'car_brand' => $this->fields['car_brand'],
            'model' => $this->fields['model'],
            'color' => $this->fields['color'],
            'other' => $this->fields['other'],
            'issue_year' => $this->fields['issue_year'],
            'plate_number' => $this->fields['plate_number'],
            'user_id' => $this->user_id
        ]);

        VehicleImage::create([
            'src' => $this->fields['image'],
            'parent_id' => $vehicle['id']
            # 'parent_id' => $vehicle->id
        ]);
    }
}
