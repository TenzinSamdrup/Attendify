<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">
        <form wire:submit.prevent="login" class="p-4 border rounded shadow-sm">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" wire:model="email" placeholder="Enter your email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <div class="input-group">
                    <!-- Toggle password type between 'password' and 'text' -->
                    <input type="{{ $showPassword ? 'text' : 'password' }}" class="form-control" id="password" wire:model="password" placeholder="Enter your password">
                    <button type="button" class="btn btn-outline-secondary" wire:click="togglePasswordVisibility">
                        <i class="fa" :class="{'fa-eye-slash': showPassword, 'fa-eye': !showPassword}"></i>
                    </button>
                </div>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            @if (session()->has('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
        </form>
    </div>
</div>
