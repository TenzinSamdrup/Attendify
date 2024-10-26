<div class="d-flex">
    <!-- Sidebar -->
    <div class="text-white p-3 d-flex flex-column" id="sidebar" style="width: 250px; min-height: 100vh;position: fixed;background-color:#003366">
        <h2 class="text-center">Attendify</h2>

        <div class="text-center my-4">
        <i class="fas fa-user-tie fa-10x" size=></i>
            <p class="mt-2">Admin</p>
        </div>

        <ul class="nav flex-column flex-grow-1">
            <li class="nav-item">
                <a href="#" class="nav-link rounded p-3 {{ $activeTab === 'dashboard' ? 'active bg-white text-dark' : 'text-white' }}" 
                   wire:click="switchTab('dashboard')">Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link rounded p-3 {{ $activeTab === 'addEmployee' ? 'active bg-white text-dark' : 'text-white' }}" 
                   wire:click="switchTab('addEmployee')">Add Employee</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link rounded p-3 {{ $activeTab === 'leaveManagement' ? 'active bg-white text-dark' : 'text-white' }}" 
                   wire:click="switchTab('leaveManagement')">
                   @livewire('admin-notification')
                </a>
            </li>
        </ul>

        <!-- Logout Button at the Bottom -->
        @livewire('logout-button')
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4" id='content' style="margin-left: 250px;">
        <button class="btn btn-dark mb-3 d-md-none" onclick="toggleSidebar()">
            <i class="fa fa-bars"></i>
        </button>

        @if ($activeTab === 'dashboard')
        <div class="container">
        <div >
            @livewire('attendance-stats')
        </div>    
            @livewire('employee-list')
        </div>

        @elseif ($activeTab === 'addEmployee')
        <div class="container align-items-center">
            @livewire('register-form')
        </div>

        @elseif ($activeTab === 'leaveManagement')
        <div class="container">
        <h2 class="mb-3" style="color:#003366">Leave Management</h2>
            @livewire('leave-requests')
        </div>
            
        @endif
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('d-none');

        const content=document.getElementById('content')
        content.style.marginLeft='-25px';
    }
</script>
