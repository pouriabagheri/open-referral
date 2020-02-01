<?php
/**
 * Created by PhpStorm.
 * User: poorya
 * Date: 20.10.2019
 * Time: 18:10
 */


namespace ReferralPanda\OpenReferral\Traits;


use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use ReferralPanda\OpenReferral\Models\Referral;

trait HasReferral
{


    private $model;

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $code = $model->generateReferral($model);
            $referrer_id = null;
            if ($referredBy = Cookie::get('referral')) {
                $referrer_id = Referral::whereReferralCode($referredBy)->firstOrFail()->referable_id;
            }
            $model->referral()->create([
                'referral_code' => $code,
                'referrer_id' => $referrer_id,
            ]);
        });

    }

    public function getReferralLink()
    {
        $referral_link = config('open_referral.referral_link', '');

        $referral_link = $referral_link != '' ? $referral_link : url('/') . '/?ref=';

        return $referral_link . $this->referral->referral_code;
    }

    protected function generateReferral($model)
    {
        $length = config('open_referral.referral_code_length', 5);
        $prefix = config('open_referral.referral_code_prefix', '');
        $case = config('open_referral.referral_code_case', 'mixcase');

        do {
            $referral = Str::random($length);
            switch ($case){
                case 'uppercase':
                    $referral = strtoupper($referral);
                    break;
                case 'lowercase':
                    $referral = strtolower($referral);
                    break;
            }
            $referral = $prefix.$referral;
        } while (Referral::where('referral_code',$referral)->exists());

        return $referral;
    }

    public function referral()
    {
        return $this->morphOne(Referral::class, 'referable');
    }

    public function referredBy()
    {
        return $this->referral->referrer;
    }

    public function referredUsers()
    {
        return $this->hasMany(Referral::class, 'referrer_id', 'id');
    }



}