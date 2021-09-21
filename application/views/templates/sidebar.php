 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Sisfo_akademik <sup></sup></div>
     </a>
     <?php foreach ($role_check->result() as $result) : ?>
         <?php $role = $result->role_id ?>
     <?php endforeach; ?>
     <?php if ($role == 1) : ?>
         <!-- Divider -->
         <hr class="sidebar-divider mt-3">

         <!-- Heading -->
         <div class="sidebar-heading">
             Administrator
         </div>
         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
                 <i class="fas fa-fw fa-tachometer-alt"></i>
                 <span>Dashboard</span></a>
         </li>

         <!-- Nav Item - Dashboard -->
         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('data_siswa'); ?>">
                 <i class="fas fa-fw fa-id-card"></i>
                 <span>Data Siswa</span></a>
         </li>
     <?php endif; ?>

     <?php if ($role == 2) : ?>
         <!-- Heading -->
         <div class="sidebar-heading">
             User
         </div>

         <!-- Nav Item - Charts -->
         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('user'); ?>">
                 <i class="fas fa-fw fa-user"></i>
                 <span>My Profile</span></a>
         </li>

         <!-- Nav Item - Charts -->
         <li class="nav-item">
             <a class="nav-link pb-0" href="<?= base_url('formsiswa'); ?>">
                 <i class="fas fa-fw fa-id-card"></i>
                 <span>Data Siswa</span></a>
         </li>
     <?php endif; ?>
     <!-- Divider -->
     <hr class="sidebar-divider mt-3">

     <li class="nav-item ">
         <a class="nav-link pb-0 mb-4" href="<?= base_url('auth/logout'); ?>">
             <i class="fas fa-fw fa-sign-out-alt"></i>
             <span>Logout</span></a>
     </li>




     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->