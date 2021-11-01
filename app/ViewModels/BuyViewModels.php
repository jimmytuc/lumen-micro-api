<?php

namespace App\ViewModels;

use App\Events\BuyCreated;
use App\Models\Buy;
use App\Transformers\BuyTransformer;
use Illuminate\Validation\ValidationException;

class BuyViewModels
{

    /**
     * Store a new wager.
     *
     * @param  int    $id
     * @param  array  $attrs
     * @return array
     *
     * @throws ValidationException
     */
    public function storeBuyCommand(int $id, array $attrs): array
    {
        $attrs['wager_id'] = $id;
        $buy = new Buy($attrs);

        if (!$buy->isValidFor('CREATE')) {
            throw new ValidationException($buy->validator());
        }

        $buy->save();

        event(new BuyCreated($buy));

        return current(
            fractal($buy, new BuyTransformer())->toArray()
        );
    }
}
