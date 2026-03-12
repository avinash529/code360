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
            animation: slideDown 0.2s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Fixed Nav & Scroll Effects */
        nav {
            transition: all 0.3s ease-in-out;
        }
        
        nav.nav-scrolled {
            background-color: rgba(15, 23, 42, 0.8) !important;
            backdrop-filter: blur(12px);
            padding-top: 0.1rem;
            padding-bottom: 0.1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        body {
            padding-top: 4rem;
        }

        /* Premium Form Select styling */
        .premium-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            transition: all 0.2s ease;
        }
        
        .premium-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            background-color: #fff;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

    <nav id="mainNav" class="bg-slate-900 border-b border-white/10 text-white shadow-lg fixed top-0 left-0 right-0 z-50">
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
                                
                                <div class="absolute left-0 mt-2 w-56 rounded-xl shadow-2xl bg-white/95 backdrop-blur-xl ring-1 ring-black ring-opacity-5 hidden group-hover:block transform transition-all duration-300 z-50 overflow-hidden">
                                    <div class="py-2" role="menu" aria-orientation="vertical">
                                        <?php if ($user_id == -1): ?>
                                            <a href="<?= site_url('transaction/add_class') ?>" class="flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                                <i class="fas fa-layer-group mr-3 text-indigo-400"></i> Manage Class
                                            </a>
                                            <a href="<?= site_url('transaction/add_subclass') ?>" class="flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                                <i class="fas fa-tags mr-3 text-indigo-400"></i> Manage Subclass
                                            </a>
                                            <a href="<?= site_url('transaction/add_product') ?>" class="flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors border-t border-slate-50">
                                                <i class="fas fa-box-open mr-3 text-indigo-400"></i> Manage Products
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= site_url('transaction/add_product') ?>" class="flex items-center px-4 py-2.5 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                                <i class="fas fa-box-open mr-3 text-indigo-400"></i> Add Product
                                            </a>
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
    
    <!-- Flash messages (Global) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline"><?= $this->session->flashdata('success') ?></span>
        </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline"><?= $this->session->flashdata('error') ?></span>
        </div>
        <?php endif; ?>

        <?php if (validation_errors()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Validation Error!</strong>
            <span class="block sm:inline"><?= validation_errors() ?></span>
        </div>
        <?php endif; ?>
    </div>

    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 10) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        });
    </script>
