<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use function Psy\debug;

class SellingPrice implements Rule
{
    protected $totalWagerValue;
    protected $sellingPercentage;

    public function __construct($attributes = array())
    {
        if (sizeof($attributes) > 0) {
            $this->totalWagerValue = $attributes['total_wager_value'];
            $this->sellingPercentage = $attributes['selling_percentage'];
        }
    }

    /**
     * selling_price must be greater than total_wager_value * (selling_percentage / 100)
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        debug([
            'totalWagerValue' => $this->totalWagerValue,
            'sellingPercentage' => $this->sellingPercentage,
            'percentageOfSellingRate' => $this->sellingPercentage / 100
        ]);
        return $value > ($this->totalWagerValue * ($this->sellingPercentage / 100));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute must be greater than the total wager multiply to selling percentage.';
    }
}
