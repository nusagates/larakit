<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('management', function ($user) {
    return true;
});
