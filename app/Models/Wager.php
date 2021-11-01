<?php

namespace App\Models;

use App\Rules\SellingPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\QueryFilterable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wager extends BaseModel
{
    use QueryFilterable, HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_wager_value',
        'odds',
        'selling_percentage',
        'selling_price',
        'current_selling_price',
        'percentage_sold',
        'amount_sold',
        'placed_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'total_wager_value',
        'odds',
        'selling_percentage',
        'selling_price',
        'current_selling_price',
        'percentage_sold',
        'amount_sold',
        'placed_at'
    ];

    /**
     * The fields that should be filterable by query.
     *
     * @var array
     */
    protected $filterable = [
        'selling_percentage',
        'selling_price',
        'current_selling_price',
        'percentage_sold',
        'amount_sold',
        'placed_at'
    ];

    /**
     * Validation rules for the model.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'CREATE' => [
                'total_wager_value' => 'required|numeric|gt:0',
                'odds' => 'required|numeric|gt:0',
                'selling_percentage' => 'required|digits_between:1,100',
                'selling_price' => [
                    'required', 'numeric', 'gt:0',
                    new SellingPrice([
                        'total_wager_value' => $this->total_wager_value,
                        'selling_percentage' => $this->selling_percentage,
                    ])
                ]
            ]
        ];
    }

    /**
     * @return HasMany
     */
    public function buys(): HasMany
    {
        return $this->hasMany(Buy::class);
    }
}
