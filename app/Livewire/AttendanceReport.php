<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Include the pagination trait
use App\Models\Attendance;
use App\Models\Leave;

class AttendanceReport extends Component
{
    use WithPagination; // Use pagination trait

    public $leaveRecords = []; // We don't need to paginate leave records

    public function render()
    {
        // Fetch paginated attendance records with user relationship
        $attendanceRecords = Attendance::with('user')
            ->orderBy('check_in', 'desc') // Order by check-in time (latest first)
            ->paginate(10); // Paginate records, showing 10 per page

                // Get users on approved leave today
        $this->leaveRecords = Leave::where('status', 'approved')
            ->with('user')
            ->get();
        
        return view('livewire.attendance-report', [
            'attendanceRecords' => $attendanceRecords,
            'leaveRecords' => $this->leaveRecords // Keep this if you still need leave data
        ]);
    }

    public function export()
    {
        // Fetch all attendance records with user details
        $attendanceRecords = Attendance::with('user')->get(); 
        // Fetch approved leave records with user details
        $leaveRecords = Leave::where('status', 'approved')->with('user')->get();
    
        $csvFileName = 'attendance_records.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];
    
        return response()->stream(function () use ($attendanceRecords, $leaveRecords) {
            $handle = fopen('php://output', 'w');
            
            // Write CSV headers
            fputcsv($handle, ['Emp ID', 'Name', 'Department', 'Check-in Time', 'Check-out Time', 'Status']); // Add a header for Leave Status
    
            // Write attendance records to CSV
            foreach ($attendanceRecords as $attendance) {
                fputcsv($handle, [
                    $attendance->user->employeeId,
                    $attendance->user->name,
                    $attendance->user->department,
                    $attendance->check_in,
                    $attendance->check_out,
                    $attendance->status,
                ]);
            }
    
            // Write leave records to CSV
            foreach ($leaveRecords as $leave) {
                fputcsv($handle, [
                    $leave->user->employeeId,
                    $leave->user->name,
                    $leave->user->department,
                    'NA', // Leave records don't have check-in/check-out times
                    'NA', // Leave records don't have check-in/check-out times
                    'On Leave', // Indicate that the user is on leave
                ]);
            }
    
            fclose($handle);
        }, 200, $headers);
    }
    
}
