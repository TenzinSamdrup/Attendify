<div class="container mt-5">
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-xl font-semibold mb-4">Attendance Information</h2>
        
        <div class="mb-4">
            <h3 class="font-semibold">Working Days:</h3>
            <ul class="list-group list-group-flush">
                @foreach (json_decode(Auth::user()->working_days, true) as $day)
                    <li class="list-group-item">{{ ucfirst($day) }}</li>
                @endforeach
            </ul>
        </div>
        
        <div class="mb-4">
            <h3 class="font-semibold">Working Hours:</h3>
            <p class="lead">{{ $startTime }} to {{ $endTime }}</p>
        </div>

        @if ($message)
            <div class="mb-4 p-3 alert alert-success">{{ $message }}</div>
        @endif

        <div class="mb-4 text-center">
            @if ($isWorkingDay)
                @if (!$attendance)
                    <button wire:click="checkIn" class="btn btn-success btn-md" aria-label="Check In">
                        Check In
                    </button>
                @else
                    <button wire:click="checkOut" class="btn btn-danger btn-md" aria-label="Check Out">
                        Check Out
                    </button>
                @endif
            @else
                <div class="alert alert-secondary text-center">
                    <strong>Notice:</strong> Today is not a working day.
                </div>
            @endif
        </div>

    </div>
</div>
