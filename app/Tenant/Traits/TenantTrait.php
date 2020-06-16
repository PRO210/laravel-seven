<?php

namespace App\Tenant\Traits;

//use App\Observers\TableObserver;
use App\Tenant\Observers\TenantObserver;
use App\Tenant\Scopes\TenantScope;


trait TenantTrait
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        static::observe(TenantObserver::class);

        static::addGlobalScope(new TenantScope);

        //static::observe(TableObserver::class);
    }
}
