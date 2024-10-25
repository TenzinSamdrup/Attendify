<div class="container mt-5" wire:poll.1s>
    <h2 class="mb-4">Attendance History</h2>

    <input type="text" wire:model.debounce.500ms="search" class="form-control mb-3" placeholder="Search by user name...">

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Check In Time</th>
                    <th>Check Out Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->user_id }}</td>
                        <td>{{ $attendance->user->name }}</td>
                        <td>{{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('Y-m-d h:i A') : 'N/A' }}</td>
                        <td>{{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('Y-m-d h:i A') : 'N/A' }}</td>
                        <td>{{ $attendance->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination Links -->
        {{ $attendances->links() }}
    </div>
</div>
