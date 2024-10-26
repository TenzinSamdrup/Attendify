<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Leave;
use App\Models\User;
use App\Mail\LeaveStatusNotification;
use Illuminate\Support\Facades\Mail;

class LeaveRequests extends Component
{
    use WithPagination;

    public $status = 'pending'; // Default status

    public function render()
    {
        // Retrieve leaves based on the selected status with pagination
        $leaves = Leave::where('status', $this->status)
            ->with('user')
            ->paginate(10);

        return view('livewire.leave-requests', [
            'leaves' => $leaves,
        ]);
    }

    public function updateStatus($leaveId, $newStatus)
    {
        $leave = Leave::find($leaveId);
        if ($leave) {
            $leave->status = $newStatus;
            $leave->save();

            // Send email notification to the employee
            $this->sendEmailNotification($leave);
        }
    }

    protected function sendEmailNotification($leave)
    {
        $employee = $leave->user; // Assumes Leave model has 'user' relationship
        Mail::to($employee->email)->send(new LeaveStatusNotification($leave));
    }
}
