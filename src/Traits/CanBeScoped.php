<?php

namespace akr4m\scoping\Traits;

use akr4m\scoping\Scoping\Scoper;
use Illuminate\Database\Eloquent\Builder;

trait CanBeScoped
{
    public function scopeWithScopes(Builder $builder, $scopes = [])
    {
        return (new Scoper(request()))->apply($builder, $scopes);
    }
}
