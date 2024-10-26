<div class="container" wire:poll.1s="fetchAttendanceData">
    <!-- Attendance Statistics Section -->
    <div class=" mb-4">
        <h2 class="mb-3" style="color: #003366">Today's Attendance Statistics and Records</h2>
        <div class="row text-center pt-3 mx-1 rounded" style="border:1px solid #003366 ">
            <div class="col-md-3 " style="border-right:1px solid #003366 ">
                <h4>On Time</h4>
                <p class="display-4 text-success">{{ $attendanceStats['on_time'] }}</p>
            </div>
            <div class="col-md-3" style="border-right:1px solid #003366 ">
                <h4>Late</h4>
                <p class="display-4 text-warning">{{ $attendanceStats['late'] }}</p>
            </div>
            <div class="col-md-3" style="border-right:1px solid #003366 ">
                <h4>Absent</h4>
                <p class="display-4 text-danger">{{ $attendanceStats['absent'] }}</p>
            </div>
            <div class="col-md-3">
                <h4>On Leave</h4>
                <p class="display-4 text-info">{{ $onLeaveCount }}</p>
            </div>
        </div>
    </div>

    <!-- Attendance Records Table -->
    <div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>EmpID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceRecords as $record)
                        <tr>
                            <td>{{ $record->user->employeeId }}</td>
                            <td>{{ $record->user->name }}</td>
                            <td>{{ $record->user->department }}</td>
                            <td>{{ date('H:i', strtotime($record->check_in)) }}</td>
                            <td>{{ $record->check_out ? date('H:i', strtotime($record->check_out)) : 'N/A' }}</td>
                            <td>
                                <span class="badge" style="font-size: 1em; color: white;
                                    background-color: 
                                    {{ $record->status == 'On Time' ? '#28a745' : ($record->status == 'Late' ? '#ffc107' : '#dc3545') }}">
                                    {{ $record->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach

                    @foreach($leaveRecords as $leave)
                        <tr>
                            <td>{{ $leave->user->employeeId }}</td>
                            <td>{{ $leave->user->name }}</td>
                            <td>{{ $leave->user->department }}</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>
                                <span class="badge" style="font-size: 1em; color: white; background-color: #17a2b8;">
                                    On Leave
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
