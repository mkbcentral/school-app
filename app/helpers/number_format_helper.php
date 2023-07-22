<?php
function app_format_number($key):string{
    return number_format($key, 1, ',', ' ');
}
