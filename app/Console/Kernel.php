<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('app:cron')->everyTwoMinutes();
        $schedule->command('app:cron')->everyTwoMinutes();

        //$schedule->command('app:deleteactivitylog')->timezone('Asia/Kolkata')->at('13:00');
        $schedule->command('app:deleteactivitylog')->hourly();//->hourly()->daily();

        $schedule->command('fcm:androidnotification')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
