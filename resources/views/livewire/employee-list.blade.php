<div  wire:poll.1s>
    <h2 class="mb-3">Employee List</h2>

    <div class="row mb-3">
        <div class="col-md-10">
            <input 
                type="text" 
                class="form-control" 
                placeholder="Search by name or email..." 
                wire:model.debounce.300ms="search"
            >
        </div>
        <div class="col-md-2 text-end">
            <button 
                class="btn btn-primary" 
                data-bs-toggle="modal" 
                data-bs-target="#addEmployeeModal"
            >
                Add Employee
            </button>
        </div>
    </div>
    <div >
    <table class="table table-striped" >
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Leaves</th>
                <th>Late</th>
                <th>On Time</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->leaves_count }}</td>
                    <td>{{ $employee->late_count }}</td>
                    <td>{{ $employee->on_time_count }}</td>
                    <td>
                        <button class="btn btn-info" wire:click="$emit('showEmployeeHistory', {{ $employee->id }})">
                            View Details
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    {{ $employees->links() }}
        <!-- Add Employee Modal -->
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true" wire:ignore.self >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('register-form')
                </div>
            </div>
        </div>
    </div>

</div>
