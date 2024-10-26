<div>
    <h2 class="mb-3" style="color:#003366">Employee List</h2>

    <div class="row mb-3">
        <div class="col-md-12">
            <input 
                type="text" 
                class="form-control" 
                placeholder="Search by name or email..." 
                wire:model.debounce.300ms="search"
            >
        </div>
    </div>

    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Leaves</th>
                    <th>Late</th>
                    <th>On Time</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->leaves_count }}</td>
                        <td>{{ $employee->late_count }}</td>
                        <td>{{ $employee->on_time_count }}</td>
                        <td>
                            <button wire:click="showEmployeeHistory({{ $employee->id }})" style="color:#003366" class="btn btn-link">
                                View Attendance Details
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $employees->links() }}

    <!-- Attendance Details Modal -->
<div class="modal fade @if($showAttendanceModal) show @endif" style="display: @if($showAttendanceModal) block @else none @endif;" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addEmployeeModalLabel">Attendance Details for {{ $employee->name }}</h5>
            <button type="button" class="btn btn-primary" wire:click="exportAttendance({{ $employee->id }})">Export to PDF</button>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendanceHistory as $attendance)
                            <tr>
                                <td>{{ $attendance->check_in->format('Y-m-d') }}</td>
                                <td>{{ $attendance->check_in->format('H:i:s') }}</td>
                                <td>{{ $attendance->check_out ? $attendance->check_out->format('H:i:s') : 'N/A' }}</td>
                                <td>{{ $attendance->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No attendance records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('livewire:load', function () {
        // Hide the modal when the Livewire component reloads
        window.livewire.on('modalClosed', () => {
            // Reset any data if necessary
        });
    });
</script>
