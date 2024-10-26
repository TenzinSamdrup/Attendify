<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AddAdmin extends Command
{
    protected $signature = 'add:admin';
    protected $description = 'Create an admin user';

    public function handle()
    {
        // Admin user details
        $email = 'tenzinsamdrup6@gmail.com.com';
        $password = 'password123'; // Change this to a secure password
        $usertype = 'admin'; // Assuming you want to set this as an admin
        $name = 'Admin User'; // The name for the admin user
        $employeeId = 'EMP001'; // Example employee ID (you can change it)
        $department = 'Administration'; // Example department name

        try {
            // Create the admin user
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'usertype' => $usertype,
                'employeeId' => $employeeId, // Include the employeeId
                'department' => $department,   // Include the department
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->info('Admin user created successfully.');

        } catch (\Exception $e) {
            $this->error('Error creating admin user: ' . $e->getMessage());
        }
    }
}
