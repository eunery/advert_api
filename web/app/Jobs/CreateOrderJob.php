<?php

namespace App\Jobs;

use App\Models\OrderImage;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\SimpleCache\InvalidArgumentException;

class CreateOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $fields;
    private $user_id;

    /**
     * @param Request $request
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
     * @throws InvalidArgumentException
     */
    public function handle()
    {
        $order = Order::create([
            'car_brand' => $this->fields['car_brand'],
            'model' => $this->fields['model'],
            'color' => $this->fields['color'],
            'other' => $this->fields['other'],
            'issue_year' => $this->fields['issue_year'],
            'plate_number' => $this->fields['plate_number'],
            'user_created' => $this->user_id
        ]);

        OrderImage::create([
            'src' => $this->fields['image'],
            'order_id' => $order['id']
            # 'parent_id' => $order->id
        ]);
    }
}
