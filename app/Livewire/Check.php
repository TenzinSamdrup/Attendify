<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class Check extends Component
{
    public $attendance;
    public $currentDate;
    public $currentTime;
    public $message = '';

    public function mount()
    {
        $this->refreshCurrentTime();
        $this->attendance = $this->getTodayAttendance();
    }

    public function render()
    {
        $this->refreshCurrentTime();

        $user = Auth::user();
        $today = strtolower(date('l')); // Current day of the week
        $workingDays = json_decode($user->working_days, true) ?? [];
        $isWorkingDay = in_array($today, array_map('strtolower', $workingDays));

        return view('livewire.check', [
            'isWorkingDay' => $isWorkingDay,
            'startTime' => $user->start_time,
            'endTime' => $user->end_time,
            'currentStatus' => $this->getCurrentStatus(),
            'name' => $user->name,
            'employeeId' => $user->employeeId,
            'department' => $user->department,
            'currentTime' => $this->currentTime,
        ]);
    }

    private function refreshCurrentTime()
    {
        date_default_timezone_set('Asia/Thimphu');
        $currentDateTime = new \DateTime();
        $this->currentDate = $currentDateTime->format('Y-m-d');
        $this->currentTime = $currentDateTime->format('H:i:s');
    }

    private function getTodayAttendance()
    {
        date_default_timezone_set('Asia/Thimphu');
        $today = date('Y-m-d');
        return Attendance::where('user_id', Auth::id())
            ->whereDate('check_in', $today)
            ->first();
    }

    private function getCurrentStatus()
    {
        if (!$this->attendance) {
            return 'Not Checked In';
        }
        return $this->attendance->check_out ? 'Checked Out' : 'Checked In';
    }

    public function checkIn()
    {
        $user = Auth::user();
        date_default_timezone_set('Asia/Thimphu');
        $currentDateTime = new \DateTime();
        $startTime = new \DateTime($currentDateTime->format('Y-m-d') . ' ' . $user->start_time);
        $status = $currentDateTime <= $startTime ? 'On Time' : 'Late';

        // Record check-in
        if (!$this->attendance) {
            $this->attendance = Attendance::create([
                'user_id' => $user->id,
                'check_in' => $currentDateTime->format('Y-m-d H:i:s'),
                'status' => $status,
            ]);
            $this->message = "Checked in successfully! Status: $status";
        } else {
            $this->message = 'You have already checked in today!';
        }
    }

    public function checkOut()
    {
        if (!$this->attendance) {
            $this->message = 'No check-in record found for today!';
            return;
        }

        if ($this->attendance->check_out) {
            $this->message = 'You have already checked out today!';
            return;
        }

        date_default_timezone_set('Asia/Thimphu');
        $currentDateTime = new \DateTime();

        $this->attendance->update([
            'check_out' => $currentDateTime->format('Y-m-d H:i:s'),
        ]);

        $this->message = 'Checked out successfully!';
    }
}
