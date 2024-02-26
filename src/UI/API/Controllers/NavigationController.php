<?php

declare(strict_types=1);

namespace RyanChandler\FilamentNavigation\UI\API\Controllers;

use RyanChandler\FilamentNavigation\Models\Navigation;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use RyanChandler\FilamentNavigation\UI\API\Resources\NavigationResource;

class NavigationController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $navigations = Navigation::query()
            ->get();

        return NavigationResource::collection($navigations);
    }
}
