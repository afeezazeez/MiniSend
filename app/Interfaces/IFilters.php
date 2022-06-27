<?php

namespace App\Interfaces;

use Closure;

// interface to be implemented by all Filter classes

interface IFilters
{

    public function filter($query, Closure $next);

}
