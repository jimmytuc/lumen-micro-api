<?php

namespace App\ViewModels;

use App\Models\Wager;
use App\Transformers\WagerTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class WagerViewModel
{
    /**
     * Get list of paginated users.
     *
     * @param Request $request
     * @return array
     */
    public function getWagers(Request $request): array
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;

        // hitting the limitation, try to keep the max value at 50
        if ($limit > 50) {
            $limit = 50;
        }

        $wagers = Wager::filter($request)
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();

        return current(
            fractal($wagers, new WagerTransformer())->toArray()
        );
    }

    /**
     * Store a new wager.
     *
     * @param  array  $attrs
     * @return array
     *
     * @throws ValidationException
     */
    public function storeWager(array $attrs): array
    {
        $wager = new Wager($attrs);

        if (!$wager->isValidFor('CREATE')) {
            throw new ValidationException($wager->validator());
        }

        // current_selling_price should be the selling_price until a Buy Wager action is taken against this wager record
        $wager->current_selling_price = $wager->selling_price;
        $wager->placed_at = Carbon::now()->toDateTimeString();
        $wager->save();

        return current(
            fractal($wager, new WagerTransformer())->toArray()
        );
    }
}
