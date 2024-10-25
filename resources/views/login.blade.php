@extends('components.layouts.app') <!-- If you still want to use a layout -->

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        
        @livewire('login-form')
    </div>
@endsection
