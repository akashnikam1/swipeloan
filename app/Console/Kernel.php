<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('emi:deduct')->cron('1 0 5,11,17,23 * *');
        $schedule->command('emi:deduct')->cron('1 0 28-31 * *')
            ->when(function () {
                return Carbon::now()->isLastOfMonth();
            });
        $schedule->command('emiNotification:send')->dailyAt('11:00');
        $schedule->command('emiReminder:send')->dailyAt('10:00');
        $schedule->command('nocDocument:send')->dailyAt('09:00');
        $schedule->command('apply:bounce_charges')->dailyAt('10:00');
        $schedule->call(function () {
            $processName = 'queue:work';
            $process = proc_open("pgrep -f $processName", [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ], $pipes);

            if (is_resource($process)) {
                $output = stream_get_contents($pipes[1]);
                fclose($pipes[1]);
                $isRunning = !empty($output);
                proc_close($process);

                if (!$isRunning) {
                    Artisan::call('queue:work', ['--tries' => 3]);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
