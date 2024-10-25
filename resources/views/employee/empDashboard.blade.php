@extends('components.layouts.app') <!-- If you still want to use a layout -->

@section('content')
<div class="flex items-start justify-start min-h-screen bg-gray-100 p-5">
    
    <div class="container">
        <div class="row"> 
            <div class="col-md-6">
                <h1 class="mb-4">Employee Dashboard</h1>
            </div >
            <div class="col-md-6 text-end">
                @livewire('logout-button')
            </div>
        </div>
        
        <div class="row mb-4">
            @livewire('check')
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-header">
                        Leave Request
                    </div>
                    <div class="card-body">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#leaveRequestModal">
                            Request Leave
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance History Table -->
        @livewire("attendance-history")

    <!-- Leave Request Modal -->
    <div class="modal fade" id="leaveRequestModal" tabindex="-1" role="dialog" aria-labelledby="leaveRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="leaveRequestModalLabel">Request Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="leaveReason">Reason for Leave</label>
                            <textarea class="form-control" id="leaveReason" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="leaveDates">Leave Dates</label>
                            <input type="text" class="form-control" id="leaveDates" placeholder="e.g. 2024-10-05 to 2024-10-10" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit Request</button>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
