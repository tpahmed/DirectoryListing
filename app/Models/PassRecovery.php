<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PassRecovery extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'used',
        'account_id',
      ];

    public function Account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = bcrypt($value);
    }
}
