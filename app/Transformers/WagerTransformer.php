<?php

namespace App\Transformers;

use App\Models\Wager;
use League\Fractal\TransformerAbstract;

class WagerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Wager $wager
     * @return array
     */
    public function transform(Wager $wager): array
    {
        return [
            'id' => (int) $wager->id,
            'total_wager_value' => (int) $wager->total_wager_value,
            'odds' => (int) $wager->odds,
            'selling_percentage' => (int) $wager->selling_percentage,
            'selling_price' => (float) $wager->selling_price,
            'current_selling_price' => (float) $wager->current_selling_price,
            'percentage_sold' => $wager->percentage_sold ? (int) $wager->percentage_sold : null,
            'amount_sold' => $wager->amount_sold ? (float) $wager->amount_sold : null,
            'placed_at' => (string) $wager->placed_at,
        ];
    }
}
