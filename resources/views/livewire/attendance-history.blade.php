<div wire:poll.1s>
    <h3 class="mb-3">Attendance History</h3>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Check In Time</th>
                    <th>Check Out Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->check_in ? $attendance->check_in->format('Y-m-d h:i A') : 'N/A' }}</td>
                        <td>{{ $attendance->check_out ? $attendance->check_out->format('Y-m-d h:i A') : 'Ongoing' }}</td>
                        <td>{{ $attendance->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No attendance records found.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- Pagination Controls -->
    <div class="d-flex justify-content-center mt-3">
        {{ $attendances->links() }}
    </div>
</div>
