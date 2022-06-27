<?php

namespace App\Filters;


use Closure;
use App\Interfaces\IFilters;

class SubjectFilter implements IFilters
{

    public function filter($query, Closure $next)
    {
        if (request()->subject) {
            $query->where('subject', 'like', '%' . request()->subject . '%');
        }
        return $next($query);
    }

}
