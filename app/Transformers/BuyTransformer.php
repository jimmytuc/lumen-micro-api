<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Buy;

class BuyTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Buy $buy
     * @return array
     */
    public function transform(Buy $buy): array
    {
        return [
            'id' => (int) $buy->id,
            'wager_id' => (int) $buy->wager->id,
            'buying_price' => (float) $buy->buying_price,
            'bought_at' => (string) $buy->bought_at
        ];
    }
}
