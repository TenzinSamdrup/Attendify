<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4 col-sm-10">
        
        <form wire:submit.prevent="login" class="p-5 border rounded shadow-sm">
            <div class="text-center pb-2">
            <h2 class="fw-bold" style="color:#003366">Attendify</h2>
            </div>
        
            @csrf
            <!-- Employee ID Field -->
            <div class="mb-4">
                <label for="employeeId" class="form-label " style="font-weight:500">Employee ID:</label>
                <input type="text" class=" p-2 form-control @error('employeeId') is-invalid @enderror" id="employeeId" wire:model="employeeId" placeholder="Enter your Employee ID">
                @error('employeeId') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label for="password" class="form-label" style="font-weight:500">Password:</label>
                <div class="input-group">
                    <input type="{{ $showPassword ? 'text' : 'password' }}" class="p-2 form-control @error('password') is-invalid @enderror" id="password" wire:model="password" placeholder="Enter your password">
                    <span class="input-group-text" wire:click="togglePasswordVisibility" style="cursor: pointer;">
                        <i class="fa {{ $showPassword ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                    </span>
                </div>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-grid mt-2">
                <button type="submit" class="btn text-white p-2 fw-bold mb-2" style="background-color:#003366">Login</button>
            </div>

            <!-- Error Message (General) -->
            @if (session()->has('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>
</div>
