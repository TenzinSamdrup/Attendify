<div wire:poll.1s>
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
                            <a href="#" wire:click.prevent="showEmployeeHistory({{ $employee->id }})" style="color:#003366">
                                View Attendance Details
                            </a>
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
    <div x-data="{ show: @entangle('showAttendanceModal') }" x-show="show" class="modal fade show" style="display: block;" aria-modal="true" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $selectedEmployeeName }}'s Attendance History</h5>
                    <button type="button" class="btn-close" aria-label="Close" wire:click="closeAttendanceModal"></button>
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
</div>

<script>
    document.addEventListener('livewire:load', function () {
        window.addEventListener('close-modal', event => {
            var attendanceModal = new bootstrap.Modal(document.getElementById('attendanceModal'));
            attendanceModal.hide();
        });
    });
</script>
