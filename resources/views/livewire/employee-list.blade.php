<div>
    <h2 class="mb-3" style="color:#003366">Employee List</h2>

    <!-- Search Input -->
    <div class="row mb-3">
        <div class="col-md-12">
            <input 
                type="text" 
                class="form-control" 
                placeholder="Search by name or email..." 
                wire:model="search" 
                wire:keydown.debounce.300ms="searchChanged"
            >
        </div>
    </div>

    <!-- Employee Table -->
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td>{{ $employee->employeeId }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>
                            <button 
                                class="btn btn-danger btn-sm" 
                                wire:click="deleteEmployee({{ $employee->id }})"
                                onclick="confirm('Are you sure you want to delete this employee?') || event.stopImmediatePropagation();"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    {{ $employees->links() }}
</div>
