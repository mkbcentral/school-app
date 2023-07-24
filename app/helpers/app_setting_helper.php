<?php
use Illuminate\Support\Facades\Cache;
function app_setting($key){
    $setting=\App\Models\Setting::first();
    return $setting->{$key};
}
