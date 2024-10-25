@extends('components.layouts.app') <!-- If you still want to use a layout -->

@section('content')
<div class="flex items-start justify-start min-h-screen bg-gray-100 p-5">
    
    <div class="container">
        <div class="row"> 
            <div class="col-md-6">
                <h1 class="mb-4">Admin Dashboard</h1>
            </div >
            <div class="col-md-6 text-end">
                @livewire('logout-button')
            </div>
        </div>
        <!-- Attendance History Table -->
        @livewire("employee-list")
</div>



@endsection
