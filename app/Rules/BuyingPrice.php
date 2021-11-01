<?php

namespace App\Rules;

use App\Models\Wager;
use Illuminate\Contracts\Validation\Rule;

class BuyingPrice implements Rule
{
    protected $wagerId;

    public function __construct(int $wagerId)
    {
        $this->wagerId = $wagerId;
    }

    /**
     * buying_price must be lesser or equal to current_selling_price of the wager_id
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $wager = Wager::findOrFail($this->wagerId);

        return $value <= $wager->current_selling_price;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must be less than or equal to the current selling price of wager.';
    }
}
