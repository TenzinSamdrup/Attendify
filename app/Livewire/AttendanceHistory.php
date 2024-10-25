<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class AttendanceHistory extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // Optional: Use Bootstrap styles for pagination

    public function render()
    {
        $attendances = Attendance::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc') // Latest attendance first
            ->paginate(10); // Paginate by 10 records

        return view('livewire.attendance-history', compact('attendances'));
    }
}

