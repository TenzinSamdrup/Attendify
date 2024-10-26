@extends('components.layouts.app') <!-- If you still want to use a layout -->

@section('content')
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
    <div  class="container flex items-start justify-start min-h-screen bg-gray-100 p-5">
        <div class="row"> 
            <div class="col-md-6">
                <h1 class="">Employee Dashboard</h1>
            </div >
        </div>
        
        <div class="row mb-4">
            @livewire('check')
        </div>

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
