<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\Buy;

class BuyCreated extends Event
{
    use SerializesModels;

    public $buy;

    /**
     * Create a new event instance.
     *
     * @param Buy $buy
     * @return void
     */
    public function __construct(Buy $buy)
    {
        $this->buy = $buy;
    }
}
