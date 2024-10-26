<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResetPasswordModal extends Component
{
    public $oldPassword;
    public $newPassword;
    public $confirmNewPassword;
    public $showModal = false;

    protected $rules = [
        'oldPassword' => 'required',
        'newPassword' => 'required|min:6|same:confirmNewPassword',
        'confirmNewPassword' => 'required',
    ];

    // Show the reset modal
    public function showResetModal()
    {
        $this->showModal = true;
    }

    // Reset the password
    public function resetPassword()
    {
        $this->validate();

        // Check if the old password is correct
        if (!Hash::check($this->oldPassword, Auth::user()->password)) {
            session()->flash('error', 'Old password is incorrect.');
            return;
        }

        // Update the user's password
        Auth::user()->update([
            'password' => Hash::make($this->newPassword),
        ]);

        session()->flash('success', 'Password reset successfully.');
        $this->closeModal();
    }

    // Close modal
    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.reset-password-modal');
    }
}
