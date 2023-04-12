<?php

namespace App\Providers;

use App\Interfaces\MemberRepositoryInterface;
use App\Repository\MemberRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
    }

    public function boot()
    {
        //
    }
}
