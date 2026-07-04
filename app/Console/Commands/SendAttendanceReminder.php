<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Notification;
use App\Helpers\FcmHelper;
use Carbon\Carbon;

class SendAttendanceReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-attendance-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send attendance check-in and check-out reminders to users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sending attendance reminders...');

        // Get all active users
        $users = User::where('status', 'active')->get();

        $today = Carbon::today()->format('Y-m-d');
        $now = Carbon::now();

        foreach ($users as $user) {
            // Check if user has a shift
            if (!$user->shift) continue;

            // Get today's attendance
            $attendance = Attendance::where('user_id', $user->id)
                ->where('date', $today)
                ->first();

            $shiftStartTime = Carbon::parse($user->shift->start_time);
            $shiftEndTime = Carbon::parse($user->shift->end_time);

            // Reminder Check In (30 minutes before shift starts)
            if (!$attendance || !$attendance->check_in) {
                $checkInReminderTime = $shiftStartTime->copy()->subMinutes(30);
                
                if ($now->hour == $checkInReminderTime->hour && $now->minute >= $checkInReminderTime->minute && $now->minute < $checkInReminderTime->minute + 30) {
                    $this->sendReminder($user, 'checkin');
                }
            }

            // Reminder Check Out (30 minutes before shift ends)
            if ($attendance && $attendance->check_in && !$attendance->check_out) {
                $checkOutReminderTime = $shiftEndTime->copy()->subMinutes(30);
                
                if ($now->hour == $checkOutReminderTime->hour && $now->minute >= $checkOutReminderTime->minute && $now->minute < $checkOutReminderTime->minute + 30) {
                    $this->sendReminder($user, 'checkout');
                }
            }
        }

        $this->info('Attendance reminders sent successfully!');
    }

    /**
     * Send reminder to user
     */
    protected function sendReminder(User $user, string $type): void
    {
        $title = $type === 'checkin' ? 'Reminder Absen Masuk' : 'Reminder Absen Keluar';
        $message = $type === 'checkin' 
            ? 'Jangan lupa untuk melakukan absen masuk hari ini!' 
            : 'Jangan lupa untuk melakukan absen keluar hari ini!';

        // Save notification
        Notification::create([
            'user_id' => $user->id,
            'type' => 'attendance',
            'title' => $title,
            'message' => $message,
        ]);

        // Send FCM notification
        FcmHelper::sendToUser($user, $title, $message, ['type' => 'attendance']);

        $this->info("Reminder sent to: {$user->name} ({$type})');
    }
}
