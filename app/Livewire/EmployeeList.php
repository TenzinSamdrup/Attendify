<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class EmployeeList extends Component
{
    use WithPagination;

    public $search = '';  // Search input

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Fetch non-admin employees with attendance statistics
        $employees = User::where('usertype', '!=', 'admin') // Exclude admins
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->withCount([
                'attendances as leaves_count' => function ($query) {
                    $query->where('status', 'Leave');
                },
                'attendances as late_count' => function ($query) {
                    $query->where('status', 'Late');
                },
                'attendances as on_time_count' => function ($query) {
                    $query->where('status', 'On Time');
                },
            ])
            ->paginate(10);

        return view('livewire.employee-list', compact('employees'));
    }
}
