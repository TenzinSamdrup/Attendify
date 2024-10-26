<div class="position-relative" wire:poll.1s="refreshPendingCount">
            Leave Management
            @if ($pendingCount > 0)
                <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle">
                    {{ $pendingCount }}
                </span>
            @endif
        
</div>
