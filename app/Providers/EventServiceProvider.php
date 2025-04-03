<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\TikTok\TikTokExtendSocialite;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SocialiteWasCalled::class => [
            TikTokExtendSocialite::class . '@handle',
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
