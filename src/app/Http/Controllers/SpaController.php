<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class SpaController extends Controller
{
    /**
     * Get the SPA view.
     *
     * @return View
     */
    public function __invoke()
    {
        $config = [
            'app_name' => config('app.name'),
            'locale' => app()->getLocale(),
        ];

        return view('spa', compact('config'));
    }
}
