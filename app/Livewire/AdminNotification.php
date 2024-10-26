<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Leave;
use App\Mail\NewLeaveRequest;
use Illuminate\Support\Facades\Mail;

class AdminNotification extends Component
{
    public $pendingCount = 0;

    public function mount()
    {
        $this->refreshPendingCount(); // Initialize the count on load
    }

    public function refreshPendingCount()
    {
        $newPendingCount = Leave::where('status', 'pending')->count();

        if ($newPendingCount > $this->pendingCount) {
            // Get the latest pending leave request
            $latestLeaveRequest = Leave::where('status', 'pending')->latest()->first();

            // Send email notification to admin
            Mail::to('tenzinsamdrup6@gmail.com')->send(new NewLeaveRequest($latestLeaveRequest));
        }

        $this->pendingCount = $newPendingCount;
    }

    public function render()
    {
        return view('livewire.admin-notification');
    }
}
