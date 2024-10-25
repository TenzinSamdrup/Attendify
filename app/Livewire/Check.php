<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Check extends Component
{
    public $isCheckedIn = false;
    public $checkOutTime;
    public $canCheckOut = false;
    public $statusMessage;
    public $scheduledStartTime = '09:00';

    public function mount()
    {
        $this->loadAttendanceStatus();
    }

    public function loadAttendanceStatus()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($attendance) {
            $this->isCheckedIn = true;
            $this->checkOutTime = Carbon::parse($attendance->check_in)->addHours(8);
            $this->canCheckOut = Carbon::now()->greaterThanOrEqualTo($this->checkOutTime);
        }
    }

    public function checkIn()
    {
        $checkInTime = Carbon::now();
        $scheduledTime = Carbon::parse(today()->format('Y-m-d') . ' ' . $this->scheduledStartTime);

        $this->statusMessage = $checkInTime->greaterThan($scheduledTime) ? 'Late' : 'On Time';

        try {
            Attendance::create([
                'user_id' => Auth::id(),
                'check_in' => $checkInTime,
                'status' => $this->statusMessage,
            ]);

            $this->isCheckedIn = true;
            $this->checkOutTime = $checkInTime->addHours(8);
            session()->flash('success', 'Checked in successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error recording attendance: ' . $e->getMessage());
        }
    }

    public function checkOut()
    {
        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($attendance) {
            $attendance->update(['check_out' => Carbon::now()]);
            $this->isCheckedIn = false;
            session()->flash('success', 'Checked out successfully.');
        }
    }

    public function render()
    {
        $this->loadAttendanceStatus(); // Refresh status every time component renders
        return view('livewire.check');
    }
}

