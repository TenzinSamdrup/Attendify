<div>
    <!-- Trigger to open modal -->
    <a wire:click="showResetModal" class="text-white" style="cursor: pointer;">
        Reset Password
    </a>

    <!-- Modal -->
    @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password</h5>
                        <button type="button" class="close" wire:click="closeModal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Reset Password Form -->
                        <form wire:submit.prevent="resetPassword">
                            <!-- Old Password -->
                            <div class="form-group">
                                <label for="oldPassword">Old Password:</label>
                                <input type="password" id="oldPassword" wire:model="oldPassword" class="form-control @error('oldPassword') is-invalid @enderror">
                                @error('oldPassword') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- New Password -->
                            <div class="form-group mt-2">
                                <label for="newPassword">New Password:</label>
                                <input type="password" id="newPassword" wire:model="newPassword" class="form-control @error('newPassword') is-invalid @enderror">
                                @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="form-group mt-2">
                                <label for="confirmNewPassword">Confirm New Password:</label>
                                <input type="password" id="confirmNewPassword" wire:model="confirmNewPassword" class="form-control @error('confirmNewPassword') is-invalid @enderror">
                                @error('confirmNewPassword') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-success mt-3">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Success/Error Messages -->
    @if(session()->has('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
    @endif
</div>
