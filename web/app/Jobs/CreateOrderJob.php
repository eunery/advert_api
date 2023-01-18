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
            'tittle' => $this->fields['tittle'],
            'location' => $this->fields['location'],
            'price' => $this->fields['price'],
            'payment_schedule' => $this->fields['payment_schedule'],
            'size' => $this->fields['size'],
            'place' => $this->fields['place'],
            'text' => $this->fields['text'],
            'short_text' => $this->fields['short_text'],
            'image' => $this->fields['image'],
            'user_created' => $this->user_id
        ]);

        OrderImage::create([
            'src' => $this->fields['image'],
            'order_id' => $order->id
        ]);
    }
}
