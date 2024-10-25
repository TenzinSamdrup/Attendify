<div>
    @if (Auth::check())
        <button wire:click="confirmLogout" class="btn btn-danger">Logout</button>

        <!-- Modal -->
        <div class="modal fade @if($confirmingLogout) show @endif" style="display: @if($confirmingLogout) block @else none @endif;" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="@if(!$confirmingLogout) true @else false @endif">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                        <button type="button" class="close" wire:click="$set('confirmingLogout', false)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to log out?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('confirmingLogout', false)">Cancel</button>
                        <button type="button" class="btn btn-danger" wire:click="logout">Yes, log out</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal backdrop -->
        @if($confirmingLogout)
            <div class="modal-backdrop fade show"></div>
        @endif
    @endif
</div>
