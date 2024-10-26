<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Flasher\Prime\FlasherInterface;

class LeaveRequestForm extends Component
{
    public $start_date;
    public $end_date;
    public $purpose;

    public $currentDate;

    public function mount()
    {
        date_default_timezone_set('Asia/Thimphu');

        // Get the current date in Bhutan
        $currentDateTime = new \DateTime();
        $this->currentDate = $currentDateTime->format('Y-m-d');
    }
    public function submitLeaveRequest(FlasherInterface $flasher)
{
    // Validate the leave request
    $this->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'purpose' => 'required|string|max:255',
    ]);

    // Create leave records for each day in the range
    $start = \Carbon\Carbon::parse($this->start_date);
    $end = \Carbon\Carbon::parse($this->end_date);
    $dates = $start->daysUntil($end)->toArray();

    foreach ($dates as $date) {
        Leave::create([
            'user_id' => Auth::id(),
            'start_date' => $date,
            'end_date' => $date,
            'purpose' => $this->purpose,
            'status' => 'pending',
        ]);
    }

    // Use Flasher to show a success message
    $flasher->addSuccess('Leave request submitted successfully!');

    // Reset form fields
    $this->reset(['start_date', 'end_date', 'purpose']);

    // Optionally, redirect to another route
    return redirect()->route('employee.dashboard');
}
    public function render()
    {
        return view('livewire.leave-request-form');
    }
}
