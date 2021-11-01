<?php

namespace App\Models;

use App\Rules\BuyingPrice;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buy extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wager_id',
        'buying_price',
        'bought_at'
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
        'wager_id',
        'buying_price',
        'bought_at'
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
                'wager_id' => 'required|numeric|exists:wagers,id',
                'buying_price' => [
                    'required',
                    'numeric',
                    'gt:0',
                    new BuyingPrice($this->wager_id)
                ]
            ],
        ];
    }

    /**
     * @return BelongsTo
     */
    public function wager(): BelongsTo
    {
        return $this->belongsTo(Wager::class, 'wager_id');
    }
}
