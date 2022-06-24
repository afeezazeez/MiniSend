<?php

namespace App\Filters;


use Closure;
use App\Contracts\IFilters;

class FromAndToEmailsFilter  implements IFilters
{

    public function filter($query, Closure $next){
        if(request()->sender){
            $query->where('from_email', 'like', '%' . request()->sender . '%');
        }
        if(request()->recipient){
            $query->where('to_email', 'like', '%' . request()->recipient . '%');;
        }
        return $next($query);
    }

}
