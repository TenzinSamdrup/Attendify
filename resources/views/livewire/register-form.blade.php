<form wire:submit.prevent="register" class="bg-white p-4 rounded shadow-sm">
    <!-- Name Input -->
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" wire:model="name" required 
               class="form-control @error('name') is-invalid @enderror" 
               placeholder="Enter employee's name">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email Input -->
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" wire:model="email" required 
               class="form-control @error('email') is-invalid @enderror" 
               placeholder="Enter employee's email">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Time Select Inputs -->
    <div class="mb-3">
        <label for="start_time" class="form-label">Start Time:</label>
        <select id="start_time" wire:model="start_time" required class="form-select">
            <option value="">Select Start Time</option>
            @foreach(range(0, 23) as $hour)
                <option value="{{ sprintf('%02d:00', $hour) }}">
                    {{ sprintf('%02d:00', $hour) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="end_time" class="form-label">End Time:</label>
        <select id="end_time" wire:model="end_time" required class="form-select">
            <option value="">Select End Time</option>
            @foreach(range(0, 23) as $hour)
                <option value="{{ sprintf('%02d:00', $hour) }}">
                    {{ sprintf('%02d:00', $hour) }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Working Days -->
    <div class="mb-3">
        <label class="form-label">Working Days:</label>
        <div class="d-flex flex-wrap gap-2">
            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="working_days" value="{{ $day }}" id="{{ $day }}">
                    <label class="form-check-label" for="{{ $day }}">{{ $day }}</label>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary w-100 mt-3">
        Register Employee
    </button>

    <!-- Loading Indicator -->
    <div wire:loading wire:target="register" class="text-primary mt-2 text-center">
        Registering employee... Please wait.
    </div>

    <!-- Success and Error Messages -->
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
</form>
