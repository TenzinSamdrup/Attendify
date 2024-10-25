<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginForm extends Component
{
    public $email;
    public $password;
    public $showPassword = false; // Property to toggle password visibility

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    // Toggle password visibility
    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }

    // Inside your login component or controller logic
public function login()
{
    $this->validate();

    if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
        $user = Auth::user();

        // Redirect based on role
        if ($user->usertype === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->usertype === 'employee') {
            return redirect()->route('employee.dashboard');
        }
    } else {
        session()->flash('error', 'Invalid email or password');
    }
}


    public function render()
    {
        return view('livewire.login-form');
    }
}
