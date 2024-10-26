<div>
<div class="row">
    <div class="col-md-3">
        <div class="rounded p-4 text-white bg-opacity-50 bg-success mb-3" data-bs-toggle="modal" data-bs-target="#onTimeModal">
            <div class="card-body">
                <h5 class="card-title">On Time</h5>
                <p class="card-text display-4">{{ $onTimeCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="rounded p-4 text-white bg-opacity-50 bg-warning mb-3" data-bs-toggle="modal" data-bs-target="#lateModal">
            <div class="card-body">
                <h5 class="card-title">Late</h5>
                <p class="card-text display-4">{{ $lateCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class=" rounded p-4 text-white bg-opacity-50 bg-info mb-3" data-bs-toggle="modal" data-bs-target="#leaveModal">
            <div class="card-body">
                <h5 class="card-title">On Leave</h5>
                <p class="card-text display-4">{{ $onLeaveCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="rounded p-4 text-white bg-opacity-50 bg-danger mb-3" data-bs-toggle="modal" data-bs-target="#absentModal">
            <div class="card-body">
                <h5 class="card-title">Absent</h5>
                <p class="card-text display-4">{{ $absentCount }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Leave Modal -->
<div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leaveModalLabel">Employees on Leave Today</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @forelse ($leavesToday as $leave)
                        <li class="list-group-item">
                            {{ $leave->user->name }} ({{ $leave->purpose }})
                        </li>
                    @empty
                        <li class="list-group-item">No employees on leave today.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
</div>