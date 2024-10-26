<div wire:poll.1s>
<div class="mb-3">
    <button 
        wire:click="$set('status', 'pending')" 
        class="btn" 
        style="background-color: {{ $status === 'pending' ? '#003366' : '#f8f9fa' }}; color: {{ $status === 'pending' ? '#ffffff' : '#000000' }};">
        Pending
    </button>
    <button 
        wire:click="$set('status', 'approved')" 
        class="btn" 
        style="background-color: {{ $status === 'approved' ? '#003366' : '#f8f9fa' }}; color: {{ $status === 'approved' ? '#ffffff' : '#000000' }};">
        Approved
    </button>
    <button 
        wire:click="$set('status', 'rejected')" 
        class="btn" 
        style="background-color: {{ $status === 'rejected' ? '#003366' : '#f8f9fa' }}; color: {{ $status === 'rejected' ? '#ffffff' : '#000000' }}">
        Rejected
    </button>
</div>
@if ($leaves->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    @if ($status === 'pending')
                        <th>Actions</th> <!-- Show Actions column only for pending status -->
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->user->name }}</td>
                        <td>{{ $leave->start_date }}</td>
                        <td>{{ $leave->end_date }}</td>
                        <td>{{ $leave->purpose }}</td>
                        <td>{{ ucfirst($leave->status) }}</td>
                        @if ($status === 'pending')
                            <td>
                                <button wire:click="updateStatus({{ $leave->id }}, 'approved')" class="btn btn-success">Approve</button>
                                <button wire:click="updateStatus({{ $leave->id }}, 'rejected')" class="btn btn-danger">Reject</button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination Links --}}
        <div class="mt-4">
            {{ $leaves->links() }} <!-- This will render the pagination links -->
        </div>
    @else
        <div class="alert alert-danger  z-index-0">
            No <strong>{{ ucfirst($status) }}</strong> leave requests found.
        </div>
    @endif
</div>
