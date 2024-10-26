<div>
    <h2 class="mb-4" style="color: #003366">Attendance Records</h2>

    <!-- Export Button -->
    <button wire:click="export" class="btn text-white mb-3" style="background-color:#003366">Export CSV</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Emp ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Check-in Time</th>
                <th>Check-out Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendanceRecords as $attendance)
                <tr>
                    <td>{{ $attendance->user->employeeId }}</td>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->user->department }}</td>
                    <td>{{ $attendance->check_in }}</td>
                    <td>{{ $attendance->check_out }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @empty

            @endforelse
            @foreach($leaveRecords as $leave)
                        <tr>
                            <td>{{ $leave->user->employeeId }}</td>
                            <td>{{ $leave->user->name }}</td>
                            <td>{{ $leave->user->department }}</td>
                            <td>N/A</td>
                            <td>N/A</td>
                            <td>
                                On Leave
                            </td>
                        </tr>
                    @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $attendanceRecords->links() }} <!-- Render pagination links -->
    </div>
</div>
