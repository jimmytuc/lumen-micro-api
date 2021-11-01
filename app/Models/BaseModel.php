<?php

namespace App\Models;

use App\Traits\ModelValidatable;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $timestamps = false;
    use ModelValidatable;
}
