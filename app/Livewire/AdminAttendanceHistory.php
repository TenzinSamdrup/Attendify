<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\User; // Ensure you import the User model
use Livewire\WithPagination;

class AdminAttendanceHistory extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // Optional: Use Bootstrap styles for pagination

    public $search = ''; // Holds the search query

    public function render()
    {
        // Fetch all attendance records with user data, filtered by the search input
        $attendances = Attendance::with('user') // Ensure you have a relationship in your Attendance model
            ->whereHas('user', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Paginate by 10 records

        return view('livewire.admin-attendance-history', compact('attendances'));
    }
}
