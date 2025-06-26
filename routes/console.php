<?php

use Illuminate\Support\Facades\Schedule;
Schedule::command('monitor:check-ping')->everyMinute();
