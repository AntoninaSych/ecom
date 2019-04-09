<?php
namespace App\Classes\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;

class MenuFilter  implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item) && ! Auth::user()->can($item)) {
            return false;
        }

        return $item;
    }

}

