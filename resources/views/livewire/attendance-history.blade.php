<div>
<div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="p-4 pe-5 ps-5" style="background-color:#003366">
                <ul class="list-unstyled d-flex">
                    <li><a href="{{ route('employee.dashboard') }}" class="text-white ps-3 mt-3 pe-3 ms-3"><div class="ps-4">Home</div></a></li>
                    <li><a href="#" class="text-white ps-3 pe-3">@livewire('leave-request-form')</a></li>
                    <li><a href="#" class="text-white ps-3 pe-3">@livewire("reset-password-modal")</a></li>
                    <li><a href="{{ route('employee.history') }}" class="text-white ps-3 mt-3 pe-3 ms-3"><div class="ps-4">Attendance History</div></a></li>   
                    <li><a href="#" class="text-white ps-3 pe-3">@livewire('logout-button')</a></li>
                </ul>
            </div>
        </div>
        <nav class="navbar" style="background-color:#003366">
            <button class="navbar-toggler bg-white ms-4" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon " style="color:white"></span>
            </button>
            <a class="navbar-brand text-semi-bold text-white" href="#" style="font-size:27px">Attendify</a>
        </nav>
    </div>
<div class="container">
    <h3 class="mb-3 mt-3" style="color:#003366">Attendance History</h3>

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
</div>