<?php

use Illuminate\Support\Facades\Schedule;
Schedule::command('monitor:ping-check')->everyMinute();
