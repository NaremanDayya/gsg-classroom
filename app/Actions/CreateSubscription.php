<?php

namespace App\Actions;

use App\Models\Subscription;

class CreateSubscription
{
    /**
     * @param array $data
     * @return Subscription
     */
    // public function __invoke(array $data): Subscription //عشان اتعامل مع الاوبجكت كفنكشن
    public function create(array $data): Subscription
    {
        return Subscription::create($data);
    }

    
}