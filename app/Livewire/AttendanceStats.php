<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class AttendanceStats extends Component
{
    public $onTimeCount;
    public $lateCount;
    public $onLeaveCount;
    public $absentCount;
    public $leavesToday;

    public function mount()
    {
        $today = date('Y-m-d');
        $userId = Auth::id(); // Adjust if admin should see data for all employees.

        // Count on-time attendance (adjust query as per your logic for on-time)
        $this->onTimeCount = Attendance::whereDate('created_at', $today)
            ->where('status', 'on-time')
            ->count();

        // Count late attendance
        $this->lateCount = Attendance::whereDate('created_at', $today)
            ->where('status', 'late')
            ->count();

        // Retrieve employees on leave today
        $this->leavesToday = Leave::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->where('status', 'approved')
            ->with('user')
            ->get();

        $this->onLeaveCount = $this->leavesToday->count();

        // Count absent employees (those who have no attendance and are not on leave)
        $this->absentCount = Attendance::whereDate('created_at', $today)
            ->where('status', 'absent')
            ->count(); 
    }

    public function render()
    {
        return view('livewire.attendance-stats');
    }
}
