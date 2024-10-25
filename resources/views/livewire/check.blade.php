<div class="col-md-6" wire:poll.5s> <!-- Poll every seconds -->
    <div class="card text-center">
        <div class="card-header">
            Check In / Check Out
        </div>
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (!$isCheckedIn)
                <button class="btn btn-success mb-2" wire:click="checkIn">Check In</button>
            @else
                <p class="text-info">
                    @if ($statusMessage)
                        Status: <strong>{{ $statusMessage }}</strong>
                    @endif
                    <br />
                    You can check out at {{ $checkOutTime->format('h:i A') }}.
                </p>

                @if ($canCheckOut)
                    <button class="btn btn-danger" wire:click="checkOut">Check Out</button>
                @else
                    <button class="btn btn-secondary" disabled>Check Out</button>
                @endif
            @endif
        </div>
    </div>
</div>
