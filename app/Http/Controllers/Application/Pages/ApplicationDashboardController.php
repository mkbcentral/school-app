<?php

namespace App\Http\Controllers\Application\Pages;

use App\Http\Controllers\Controller;
use App\Models\AppLink;
use Illuminate\Http\Request;

class ApplicationDashboardController extends Controller
{
    public function __invoke(AppLink $appLink)
    {
        return view('dashboard',compact('appLink'));
    }
}
