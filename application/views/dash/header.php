<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Code360</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- DataTables CSS (Plain/Tailwind friendly) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        
        /* DataTables Customization for Tailwind */
        .dataTables_wrapper .dataTables_length select {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 0.25rem 2rem 0.25rem 0.5rem;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            margin-left: 0.5rem;
        }
        
        table.dataTable thead th, table.dataTable thead td {
            border-bottom: 2px solid #e2e8f0 !important;
        }
        
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0 !important;
        }

        /* Dropdown Hover Logic */
        .group:hover .group-hover\:block {
            display: block;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

    <nav class="bg-slate-900 border-b border-white/10 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo & Main Nav -->
                <div class="flex items-center">
                    <a class="flex-shrink-0 font-bold text-xl tracking-wider text-indigo-400" href="<?= site_url('dashboard') ?>">
                        MyApp
                    </a>
                    
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="<?= site_url('dashboard') ?>" class="bg-indigo-600/20 text-indigo-300 px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-600/30 transition-colors">Home</a>
                            <a href="#" class="text-slate-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Users</a>
                            <a href="#" class="text-slate-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Reports</a>
                            <a href="<?= site_url('payment'); ?>" class="text-slate-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">Payment</a>
                            
                            <!-- Dropdown -->
                            <?php $user_id = $this->session->userdata('user_id'); ?>
                            <div class="relative group">
                                <button class="text-slate-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium inline-flex items-center transition-colors">
                                    <span>Transactions</span>
                                    <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                
                                <div class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block transform transition-all duration-200 z-50">
                                    <div class="py-1" role="menu" aria-orientation="vertical">
                                        <?php if ($user_id == -1): ?>
                                            <a href="<?= site_url('transaction/add_class') ?>" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-indigo-600">Add Class</a>
                                            <a href="<?= site_url('transaction/add_subclass') ?>" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-indigo-600">Add Subclass</a>
                                            <a href="<?= site_url('transaction/add_product') ?>" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-indigo-600">Add Product</a>
                                        <?php else: ?>
                                            <a href="<?= site_url('transaction/add_product') ?>" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-indigo-600">Add Product</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side Profile -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6 space-x-4">
                        <span class="text-slate-400 text-sm">
                            Logged in as: <span class="text-white font-medium"><?= $this->session->userdata('username') ?></span>
                        </span>
                        <a href="<?= site_url('auth/logout') ?>" class="border border-red-500/50 text-red-400 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-md text-sm font-medium transition-all duration-200">
                            Logout
                        </a>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button" class="bg-slate-800 inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-700 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden md:hidden bg-slate-800" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="<?= site_url('dashboard') ?>" class="bg-slate-900 text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
                <a href="#" class="text-slate-300 hover:bg-slate-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Users</a>
                <a href="#" class="text-slate-300 hover:bg-slate-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Reports</a>
                <a href="<?= site_url('payment'); ?>" class="text-slate-300 hover:bg-slate-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Payment</a>
                
                <div class="border-t border-slate-700 pt-2 pb-2">
                    <div class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Transactions</div>
                    <?php if ($user_id == -1): ?>
                        <a href="<?= site_url('transaction/add_class') ?>" class="text-slate-300 hover:bg-slate-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium pl-6">Add Class</a>
                        <a href="<?= site_url('transaction/add_subclass') ?>" class="text-slate-300 hover:bg-slate-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium pl-6">Add Subclass</a>
                    <?php endif; ?>
                    <a href="<?= site_url('transaction/add_product') ?>" class="text-slate-300 hover:bg-slate-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium pl-6">Add Product</a>
                </div>

                 <div class="border-t border-slate-700 pt-4 pb-3">
                    <div class="flex items-center px-5">
                       <div class="ml-3">
                            <div class="text-base font-medium leading-none text-white"><?= $this->session->userdata('username') ?></div>
                        </div>
                    </div>
                    <div class="mt-3 px-2 space-y-1">
                        <a href="<?= site_url('auth/logout') ?>" class="block px-3 py-2 rounded-md text-base font-medium text-slate-400 hover:text-white hover:bg-slate-700">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
