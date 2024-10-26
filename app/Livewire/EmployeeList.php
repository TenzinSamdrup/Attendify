<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class EmployeeList extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteEmployee']; // Register listener for deletion

    // Render function to fetch employee data with pagination
    public function render()
    {
        $employees = User::where('usertype', '!=', 'admin')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.employee-list', compact('employees'));
    }

    // Called on search input change to update data
    public function searchChanged()
    {
        $this->resetPage(); // Reset to the first page on search
    }

    // Delete employee function
    public function deleteEmployee($employeeId)
    {
        $employee = User::findOrFail($employeeId);
        $employee->delete();  // Delete employee from the database

        session()->flash('message', 'Employee deleted successfully.');
    }
}
