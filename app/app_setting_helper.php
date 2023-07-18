<?php
use Illuminate\Support\Facades\Cache;
function app_setting($key){
    $setting=Cache::rememberForever('app_setting',function(){
        return \App\Models\Setting::first();
    });
    return $setting->{$key};
}
