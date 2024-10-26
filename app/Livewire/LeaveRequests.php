<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Leave;

class LeaveRequests extends Component
{
    use WithPagination; // Add pagination trait

    public $status = 'pending'; // Default status

    public function render()
    {
        // Retrieve leaves based on the selected status with pagination
        $leaves = Leave::where('status', $this->status)
            ->with('user')
            ->paginate(10); // Change this number for desired entries per page

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
        }
    }
}
