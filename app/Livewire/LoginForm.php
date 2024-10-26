<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginForm extends Component
{
    public $employeeId;
    public $password;
    public $showPassword = false; // Property to toggle password visibility

    protected $rules = [
        'employeeId' => 'required',
        'password' => 'required|min:6',
    ];

    // Toggle password visibility
    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function login()
    {
        $this->validate();

        // Check if employee ID exists in the database
        $user = User::where('employeeId', $this->employeeId)->first();

        if (!$user) {
            // Employee ID not found
            $this->addError('employeeId', 'Employee ID is not registered.');
            return;
        }

        // Attempt to login with employee ID and password
        if (Auth::attempt(['employeeId' => $this->employeeId, 'password' => $this->password])) {
            // Successful login, redirect based on user type
            if ($user->usertype === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->usertype === 'employee') {
                return redirect()->route('employee.dashboard');
            }
        } else {
            // Password is incorrect
            $this->addError('password', 'Incorrect password.');
        }
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}

