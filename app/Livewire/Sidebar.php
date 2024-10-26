<?php

namespace App\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $activeTab = 'dashboard'; // Default active tab
    public $isSidebarOpen = false;   // Sidebar visibility for small screens

    // Switch the active tab
    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    // Toggle sidebar for small screens
    public function toggleSidebar()
    {
        $this->isSidebarOpen = !$this->isSidebarOpen;
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
