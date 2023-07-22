<?php
function app_get_month_name($key):string{
    $date   = DateTime::createFromFormat('!m', $key);
    return $date->format('F');
}
