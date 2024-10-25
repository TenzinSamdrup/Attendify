<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LogoutButton extends Component
{
    public $confirmingLogout = false; // Property to toggle logout confirmation

    public function confirmLogout()
    {
        $this->confirmingLogout = true; // Show the confirmation dialog
    }

    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect('/'); // Redirect to the login page
    }

    public function render()
    {
        return view('livewire.logout-button');
    }
}
