<?php namespace DG\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->bind('DG\Repository\NameRepository', 'DG\Repository\EloquentNameRepository');
    }
}
