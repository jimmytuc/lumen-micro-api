<?php

namespace App\Listeners;

use App\Events\BuyCreated;
use Illuminate\Support\Carbon;

class SendBuyCommand
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BuyCreated  $event
     * @return void
     */
    public function handle(BuyCreated $event)
    {
        $buyingPrice = $event->buy->buying_price;
        $wager = $event->buy->wager()->get(['selling_price', 'current_selling_price']);
        $wagerCollection = $wager->firstOrFail();

        $sellingPrice = $wagerCollection->selling_price;
        $currentSellingPrice = $wagerCollection->current_selling_price;
        $amountSold = $wagerCollection->amount_sold ?? 0;

        $event->buy->wager()->update([
            'current_selling_price' => floatval($currentSellingPrice - $buyingPrice),
            'percentage_sold' => floatval($buyingPrice * 100 / $sellingPrice),
            'amount_sold' => floatval($amountSold + $buyingPrice),
        ]);

        $event->buy->bought_at = Carbon::now()->toDateTimeString();
        $event->buy->save();
    }
}
