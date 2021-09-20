 <style>
     .aside.main-sidebar.sidebar-dark-primary.elevation-4 {
    background: #154540 !important;

}

</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset ('backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Hello</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('backend')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Pappu</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Website Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link :to="{name: 'all-users'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>Users</router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
               Manage Blogs
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link :to="{name: 'post-create'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i> Add Post</router-link>
              </li>
              <li class="nav-item">
              <router-link :to="{name: 'create-category'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i> Add Category</router-link>
              </li>
              <li class="nav-item">
              <router-link :to="{name: 'all-category'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i> All Category</router-link>
              </li>
              <li class="nav-item">
              <router-link :to="{name: 'all-post'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>All Post</router-link>
              </li>
            </ul>
          </li>

            <li class="nav-item">
              <router-link :to="{name: 'post-comments'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>Comments</router-link>
              </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                POS Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link :to="{name: 'product-sale'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>Sale Now</router-link>
              </li>
              <li class="nav-item">
              <router-link :to="{name: 'product-list'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>All Product</router-link>
              </li>
              <li class="nav-item">
              <router-link :to="{name: 'pos-sales'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>Sales Detail</router-link>
              </li>
              <li class="nav-item">
              <router-link :to="{name: 'product-create'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>Add Product</router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Elements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Task Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link :to="{name: 'admin-task'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>General</router-link>
              </li>

              <li class="nav-item">
              <router-link :to="{name: 'task-draggable'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>Task-Draggable</router-link>
              </li>

              <li class="nav-item">
              <router-link :to="{name: 'admin-task-add'}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>Add New Task</router-link>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
