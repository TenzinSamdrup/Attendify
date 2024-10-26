<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class RegisterForm extends Component
{
    public $name, $email, $employeeId, $department, $start_time, $end_time, $working_days = [];

    public function register()
{
    try {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'working_days' => 'required|array|min:1',
            'employeeId' => 'required|unique:users,employeeId', // Assuming employeeId should be unique
            'department' => 'required',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        if ($e->validator->errors()->has('email')) {
            session()->flash('error', 'This email is already registered.');
            return;
        }
        throw $e; // Rethrow other validation exceptions if needed
    }

    $password = $this->generateRandomPassword();

    // Save the new employee
    User::create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($password),
        'usertype' => 'employee',
        'employeeId' => $this->employeeId,
        'department' => $this->department,
        'start_time' => $this->start_time,
        'end_time' => $this->end_time,
        'working_days' => json_encode($this->working_days),
    ]);

    $this->sendPasswordEmail($password,$this->employeeId);

    session()->flash('success', 'Employee registered successfully, and password sent via email.');
}


    private function generateRandomPassword()
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
    }

    private function sendPasswordEmail($password,$employeeId)
{
    $data = [
        'empID' => $employeeId,
        'password' => $password,
        'email' => $this->email, // Add the email here
    ];

    Mail::send('emails.password-email', $data, function ($message) {
        $message->to($this->email)
                ->subject('Your Employee Account Password');
    });
}

    public function render()
    {
        return view('livewire.register-form');
    }
}
