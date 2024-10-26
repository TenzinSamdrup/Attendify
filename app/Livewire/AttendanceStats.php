<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Leave;

class AttendanceStats extends Component
{
    public $attendanceStats = [];
    public $attendanceRecords = [];
    public $leaveRecords = [];
    public $onLeaveCount = 0;

    public function mount()
    {
        $this->fetchAttendanceData();
    }

    public function fetchAttendanceData()
    {
        $today = date('Y-m-d'); // Today's date

        // Get today's attendance records
        $this->attendanceRecords = Attendance::whereDate('check_in', $today)
            ->with('user')
            ->get();

        // Calculate attendance statistics
        $this->attendanceStats = [
            'on_time' => $this->attendanceRecords->where('status', 'On Time')->count(),
            'late' => $this->attendanceRecords->where('status', 'Late')->count(),
            'absent' => $this->attendanceRecords->where('status', 'Absent')->count(),
        ];

        // Get users on approved leave today
        $this->leaveRecords = Leave::where('status', 'approved')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->with('user')
            ->get();

        $this->onLeaveCount = $this->leaveRecords->count();
    }

    public function render()
    {
        return view('livewire.attendance-stats');
    }
}
