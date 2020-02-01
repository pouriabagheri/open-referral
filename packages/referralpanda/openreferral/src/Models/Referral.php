<?php

namespace ReferralPanda\OpenReferral\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referrals';

    protected $fillable = [
        'referable_type',
        'referable_id',
        'referral_code',
        'referrer_id',
    ];

    public static function scopeReferralExists($query, $referral)
    {
        return $query->whereReferralCode($referral)->exists();
    }

    public function referrer()
    {
        return $this->belongsTo(config('open_referral.user_model', 'App\User'),'referrer_id');
    }

    public function referee(){
        return $this->morphTo('referable');
    }


}
