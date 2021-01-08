
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=templates()?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$session->get("nm_pengguna")?> [<?=$session->get("level")?>]</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Tìm kiếm...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">ỨNG DỤNG</li>
        <li>
          <a href="<?=url('trangchu')?>">
            <i class="fa fa-dashboard"></i> <span>Trang chủ</span>
          </a>
        </li>
        <?php if ($session->get('level')=='Admin'): ?>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Quản lý vật liệu</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=url('vatlieu')?>"><i class="fa fa-circle-o"></i> Danh sách vật liệu</a></li>
            <li><a href="<?=url('vatlieu&them')?>"><i class="fa fa-circle-o"></i> Thêm vật liệu</a></li>
          </ul>
        </li>
               
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Quản lý loại kiến trúc</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=url('loaikientruc')?>"><i class="fa fa-circle-o"></i> Danh sách loại kiến trúc</a></li>
            <li><a href="<?=url('loaikientruc&them')?>"><i class="fa fa-circle-o"></i> Thêm loại kiến trúc</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Quản lý kiến trúc</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=url('kientruc')?>"><i class="fa fa-circle-o"></i> Danh sách kiến trúc</a></li>
            <li><a href="<?=url('kientruc&them')?>"><i class="fa fa-circle-o"></i> Thêm kiến trúc</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Quản lý bảo trì kiến trúc</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=url('baotri')?>"><i class="fa fa-circle-o"></i> Danh sách bảo trì</a></li>
          </ul>
        </li>
        
        <?php endif ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-map"></i>
            <span>ArcGIS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="<?=url('arcgis-3dbuilding')?>"><i class="fa fa-circle-o"></i> 3D Building</a></li>
          <li><a href="<?=url('arcgis-baotri-3dbuilding')?>"><i class="fa fa-circle-o"></i> 3D Building Maintenance</a></li>
          <!-- <li><a href="<-?=url('arcgis-timkiem-3dbuilding')?>"><i class="fa fa-circle-o"></i> 3D Building Search</a></li> -->
           
          </ul>
        </li>
        <li>
          <a href="<?=url('logout')?>">
            <i class="fa fa-sign-out"></i> <span>Đăng xuất</span>
          </a>
        </li>
        <li class="header">TÁC GIẢ</li>
        <li>
          <a href="<?=url('aboutus')?>">
            <i class="fa fa-address-card"></i> <span>Về chúng tôi</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
