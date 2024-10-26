<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\WithPagination;

class EmployeeList extends Component
{
    use WithPagination;

    public $search = '';  
    public $showAttendanceModal = false;
    public $attendanceHistory = [];
    public $selectedEmployeeName;
    public $selectedEmployeeId;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        // Fetch non-admin employees with attendance statistics
        $employees = User::where('usertype', '!=', 'admin') 
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

    public function showEmployeeHistory($employeeId)
    {
        $employee = User::find($employeeId);
        $this->selectedEmployeeName = $employee->name;
        $this->selectedEmployeeId = $employeeId; // Store selected employee ID
        $this->attendanceHistory = Attendance::where('user_id', $employeeId)->orderBy('check_in', 'desc')->get();
        $this->showAttendanceModal = true;
    }

    public function closeAttendanceModal()
    {
        $this->showAttendanceModal = false; 
        $this->attendanceHistory = []; 
        $this->selectedEmployeeName = null; 
    }

    
public function exportAttendance($employeeId)
{
    $employee = User::find($employeeId);
    $attendances = $employee->attendances; // Adjust as necessary to fetch the attendances

    $pdf = PDF::loadView('pdf.attendance-details', [
        'employee' => $employee,
        'attendances' => $attendances,
    ]);

    return $pdf->download('attendance_' . $employee->name . '.pdf');
}
}
