<div>
    <!-- Leave Modal Button -->
    <a type="button" class="text-white" data-bs-toggle="modal" data-bs-target="#leaveModal">
        Request Leave
    </a>

    <!-- Leave Modal -->
    <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="leaveModalLabel">Request Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitLeaveRequest">
                        <div class="mb-3">
                            <label for="start_date text-dark" class="form-label">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" wire:model="start_date" required min="{{ $currentDate }}">
                        </div>
                        <div class="mb-3">
                            <label for="end_date text-dark" class="form-label">End Date:</label>
                            <input type="date" class="form-control" id="end_date" wire:model="end_date" required min="{{ $currentDate }}">
                        </div>
                        <div class="mb-3">
                            <label for="purpose text-dark" class="form-label">Purpose:</label>
                            <textarea class="form-control" id="purpose" wire:model="purpose" rows="3" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn text-white  mt-3" style="background-color:#003366" wire:loading.attr="disabled">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
