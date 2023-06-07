  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="{{ Request::segment(1) === 'admin' ? 'active' : null }} nav-link site-logo" href="{{ url('admin') }}">
      <img src="{{ asset('/images/logo.png') }}" alt="AdminLTE Logo" class="">
      <span class="brand-text font-weight-light" hidden>AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <!-- <div class="sidebar"> -->
      <!-- Sidebar user panel (optional) -->
     <!--  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
     <!--  <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a class="{{ Request::segment(1) === 'admin' ? 'active' : null }} nav-link" href="{{ url('admin') }}">
              <svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3384 2.5L2.33301 10H5.03462V16.6667H10.4378V11.6667H12.2389V16.6667H17.6421V10H20.3438L11.3384 2.5ZM15.8414 15H14.0403V10H8.63712V15H6.83605V8.4917L11.3387 4.7417L15.8414 8.4917V15Z" fill="white"/>
</svg>

              <p>
                Dashboard
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
        
          </li>
        <!--   <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-house-user"></i>
              <p>
                Student Management -->
              <!--   <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-house-user"></i>
              <p>
                Student Management
                <i class="fas fa-angle-left right"></i>
           <!--      <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="{{ Request::segment(1) === 'student-list' ? 'active' : null }} nav-link" href="{{ url('student-list') }}">
                  -
                  <p>Student List</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="{{ Request::segment(1) === 'student-registration' ? 'active' : null }} nav-link" href="{{ url('/student-registration') }}" >
                  -
                  <p>Student Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="{{ Request::segment(1) === 'qr' ? 'active' : null }} nav-link" href="{{ url('qr') }}" >
                  -
                  <p>Qr Codes</p>
                </a>
              </li>
              <li class="nav-item">
               <!--  <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a> -->
              </li>
              <li class="nav-item">
               <!--  <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar <small>+ Custom Area</small></p>
                </a> -->
              </li>
              <li class="nav-item">
                <!-- <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a> -->
              </li>
              <li class="nav-item">
                <!-- <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a> -->
              </li>
              <li class="nav-item">
               <!--  <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a> -->
              </li>
            </ul>
          </li>

             <li class="nav-item">
            <a class="{{ Request::segment(1) === 'category-list' ? 'active' : null }} nav-link" href="{{ url('category-list') }}" >
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.375 1.25H5.625C5.12772 1.25 4.65081 1.44754 4.29917 1.79917C3.94754 2.15081 3.75 2.62772 3.75 3.125V16.875C3.75 17.3723 3.94754 17.8492 4.29917 18.2008C4.65081 18.5525 5.12772 18.75 5.625 18.75H14.375C14.8723 18.75 15.3492 18.5525 15.7008 18.2008C16.0525 17.8492 16.25 17.3723 16.25 16.875V3.125C16.25 2.62772 16.0525 2.15081 15.7008 1.79917C15.3492 1.44754 14.8723 1.25 14.375 1.25ZM15 16.875C15 17.0408 14.9342 17.1997 14.8169 17.3169C14.6997 17.4342 14.5408 17.5 14.375 17.5H5.625C5.45924 17.5 5.30027 17.4342 5.18306 17.3169C5.06585 17.1997 5 17.0408 5 16.875V3.125C5 2.95924 5.06585 2.80027 5.18306 2.68306C5.30027 2.56585 5.45924 2.5 5.625 2.5H14.375C14.5408 2.5 14.6997 2.56585 14.8169 2.68306C14.9342 2.80027 15 2.95924 15 3.125V16.875Z" fill="white"/>
<path d="M11.7062 7.2875C12.015 6.90504 12.1847 6.42903 12.1875 5.9375C12.1875 5.35734 11.957 4.80094 11.5468 4.3907C11.1366 3.98047 10.5802 3.75 10 3.75C9.41984 3.75 8.86344 3.98047 8.4532 4.3907C8.04297 4.80094 7.8125 5.35734 7.8125 5.9375C7.81529 6.42903 7.98498 6.90504 8.29375 7.2875C7.67882 7.6017 7.16259 8.07959 6.80197 8.6685C6.44135 9.25741 6.25034 9.93445 6.25 10.625C6.25 10.7908 6.31585 10.9497 6.43306 11.0669C6.55027 11.1842 6.70924 11.25 6.875 11.25H13.125C13.2908 11.25 13.4497 11.1842 13.5669 11.0669C13.6842 10.9497 13.75 10.7908 13.75 10.625C13.7497 9.93445 13.5587 9.25741 13.198 8.6685C12.8374 8.07959 12.3212 7.6017 11.7062 7.2875ZM9.0625 5.9375C9.0625 5.75208 9.11748 5.57082 9.2205 5.41665C9.32351 5.26248 9.46993 5.14232 9.64123 5.07136C9.81254 5.00041 10.001 4.98184 10.1829 5.01801C10.3648 5.05419 10.5318 5.14348 10.6629 5.27459C10.794 5.4057 10.8833 5.57275 10.9195 5.7546C10.9557 5.93646 10.9371 6.12496 10.8661 6.29627C10.7952 6.46757 10.675 6.61399 10.5208 6.717C10.3667 6.82002 10.1854 6.875 10 6.875C9.75136 6.875 9.5129 6.77623 9.33709 6.60041C9.16127 6.4246 9.0625 6.18614 9.0625 5.9375ZM10 8.125C10.5528 8.1268 11.0895 8.31179 11.526 8.65106C11.9625 8.99032 12.2743 9.4647 12.4125 10H7.5875C7.72571 9.4647 8.03746 8.99032 8.47397 8.65106C8.91049 8.31179 9.44715 8.1268 10 8.125Z" fill="white"/>
<path d="M6.875 13.75H8.125C8.29076 13.75 8.44973 13.6842 8.56694 13.5669C8.68415 13.4497 8.75 13.2908 8.75 13.125C8.75 12.9592 8.68415 12.8003 8.56694 12.6831C8.44973 12.5658 8.29076 12.5 8.125 12.5H6.875C6.70924 12.5 6.55027 12.5658 6.43306 12.6831C6.31585 12.8003 6.25 12.9592 6.25 13.125C6.25 13.2908 6.31585 13.4497 6.43306 13.5669C6.55027 13.6842 6.70924 13.75 6.875 13.75Z" fill="white"/>
<path d="M13.125 12.5H10.625C10.4592 12.5 10.3003 12.5658 10.1831 12.6831C10.0658 12.8003 10 12.9592 10 13.125C10 13.2908 10.0658 13.4497 10.1831 13.5669C10.3003 13.6842 10.4592 13.75 10.625 13.75H13.125C13.2908 13.75 13.4497 13.6842 13.5669 13.5669C13.6842 13.4497 13.75 13.2908 13.75 13.125C13.75 12.9592 13.6842 12.8003 13.5669 12.6831C13.4497 12.5658 13.2908 12.5 13.125 12.5Z" fill="white"/>
<path d="M13.125 15H6.875C6.70924 15 6.55027 15.0658 6.43306 15.1831C6.31585 15.3003 6.25 15.4592 6.25 15.625C6.25 15.7908 6.31585 15.9497 6.43306 16.0669C6.55027 16.1842 6.70924 16.25 6.875 16.25H13.125C13.2908 16.25 13.4497 16.1842 13.5669 16.0669C13.6842 15.9497 13.75 15.7908 13.75 15.625C13.75 15.4592 13.6842 15.3003 13.5669 15.1831C13.4497 15.0658 13.2908 15 13.125 15Z" fill="white"/>
</svg>

              <p>
                Category Management
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
             <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_102_13492)">
<path d="M14.9188 14.9999C14.8788 14.7711 14.8224 14.5456 14.75 14.3249C14.75 14.2937 14.75 14.2624 14.7188 14.2312C14.6473 14.0174 14.5617 13.8086 14.4625 13.6062L14.425 13.5312C14.3163 13.3247 14.1931 13.1263 14.0563 12.9374C14.0339 12.9115 14.0131 12.8844 13.9938 12.8562C13.7019 12.4828 13.359 12.1525 12.975 11.8749L12.925 11.8374C12.7265 11.6931 12.5176 11.5636 12.3 11.4499C12.0705 11.3319 11.8323 11.2316 11.5875 11.1499C11.7194 11.0431 11.8427 10.9261 11.9563 10.7999L12.0313 10.7124C12.1411 10.5838 12.2394 10.4458 12.325 10.2999C12.342 10.2742 12.3566 10.247 12.3688 10.2187C12.4512 10.0797 12.5202 9.93318 12.575 9.78115L12.6125 9.6999C12.6728 9.5264 12.7208 9.34888 12.7563 9.16865V9.0499C12.7887 8.85573 12.8054 8.65926 12.8063 8.4624C12.8063 7.71648 12.5099 7.00111 11.9825 6.47366C11.455 5.94622 10.7397 5.6499 9.99375 5.6499C9.24783 5.6499 8.53246 5.94622 8.00501 6.47366C7.47757 7.00111 7.18125 7.71648 7.18125 8.4624C7.1821 8.65926 7.19882 8.85573 7.23125 9.0499V9.16865C7.26668 9.34888 7.31471 9.5264 7.375 9.6999L7.4125 9.78115C7.46727 9.93318 7.53633 10.0797 7.61875 10.2187C7.63089 10.247 7.64553 10.2742 7.6625 10.2999C7.74809 10.4458 7.84639 10.5838 7.95625 10.7124L8.03125 10.7999C8.14477 10.9261 8.26806 11.0431 8.4 11.1499C8.1552 11.2316 7.91701 11.3319 7.6875 11.4499C7.46994 11.5636 7.26104 11.6931 7.0625 11.8374L7.0125 11.8749C6.62635 12.1621 6.28329 12.503 5.99375 12.8874C5.97445 12.9156 5.95358 12.9428 5.93125 12.9687C5.79441 13.1576 5.67118 13.356 5.5625 13.5624L5.525 13.6374C5.42585 13.8398 5.34024 14.0486 5.26875 14.2624C5.26875 14.2937 5.26875 14.3249 5.26875 14.3562C5.19146 14.5661 5.12881 14.7812 5.08125 14.9999C5.08425 15.0499 5.08425 15.0999 5.08125 15.1499C5.03872 15.3833 5.01158 15.6192 5 15.8562V17.4999H6.25V15.8562C6.25058 15.6634 6.2673 15.4711 6.3 15.2812C6.3 15.2437 6.3 15.2124 6.3 15.1812C6.33549 15.0036 6.3814 14.8283 6.4375 14.6562V14.5687C6.56989 14.2136 6.75533 13.8806 6.9875 13.5812C6.98485 13.5709 6.98485 13.5602 6.9875 13.5499C7.10333 13.3966 7.23304 13.2544 7.375 13.1249C7.8224 12.7141 8.3629 12.4181 8.95 12.2624C8.9734 12.3064 9.00058 12.3482 9.03125 12.3874L9.25625 12.6062L8.85625 16.1374C8.84512 16.2305 8.85507 16.3249 8.88536 16.4136C8.91565 16.5023 8.96551 16.5831 9.03125 16.6499L9.46875 17.0874C9.52685 17.146 9.59598 17.1925 9.67214 17.2242C9.7483 17.2559 9.82999 17.2723 9.9125 17.2723C9.99501 17.2723 10.0767 17.2559 10.1529 17.2242C10.229 17.1925 10.2981 17.146 10.3563 17.0874L10.7938 16.6499C10.8595 16.5831 10.9093 16.5023 10.9396 16.4136C10.9699 16.3249 10.9799 16.2305 10.9688 16.1374L10.5688 12.6062L10.7938 12.3874C10.8244 12.3482 10.8516 12.3064 10.875 12.2624C11.4932 12.4047 12.0652 12.7014 12.5375 13.1249C12.6795 13.2544 12.8092 13.3966 12.925 13.5499C12.9276 13.5602 12.9276 13.5709 12.925 13.5812C13.1572 13.8806 13.3426 14.2136 13.475 14.5687L13.5063 14.6562C13.5623 14.8283 13.6083 15.0036 13.6438 15.1812C13.6438 15.2124 13.6438 15.2437 13.6438 15.2812C13.6764 15.4711 13.6932 15.6634 13.6938 15.8562V17.4999H14.9438V15.8562C14.9413 15.6135 14.9225 15.3713 14.8875 15.1312C14.8955 15.0869 14.906 15.0431 14.9188 14.9999ZM10 6.8749C10.4133 6.8749 10.8098 7.03866 11.1027 7.33034C11.3955 7.62201 11.5608 8.01784 11.5625 8.43115C11.5625 9.53115 10.8625 10.4249 10 10.4249C9.1375 10.4249 8.4375 9.53115 8.4375 8.43115C8.43915 8.01784 8.6045 7.62201 8.89735 7.33034C9.1902 7.03866 9.58668 6.8749 10 6.8749Z" fill="white"/>
<path d="M5.65625 9.46875L5.88125 9.25C5.91192 9.21077 5.9391 9.16895 5.9625 9.125C6.20286 9.1862 6.43558 9.27425 6.65625 9.3875C6.58594 9.07572 6.55031 8.75711 6.55 8.4375C6.54775 8.29311 6.55821 8.14881 6.58125 8.00625C6.5915 8.0089 6.60225 8.0089 6.6125 8.00625C6.72102 7.1677 7.14034 6.40043 7.7875 5.85625C7.81286 5.6866 7.8254 5.51528 7.825 5.34375C7.825 4.59783 7.52868 3.88246 7.00124 3.35501C6.47379 2.82757 5.75842 2.53125 5.0125 2.53125C4.26658 2.53125 3.55121 2.82757 3.02376 3.35501C2.49632 3.88246 2.2 4.59783 2.2 5.34375C2.19242 5.85694 2.30091 6.36521 2.51736 6.83059C2.73381 7.29596 3.05263 7.70641 3.45 8.03125C2.45562 8.35541 1.58793 8.98323 0.969049 9.82635C0.350166 10.6695 0.0112489 11.6854 0 12.7312L0 14.375H1.25V12.7312C1.25187 11.908 1.52461 11.1082 2.02612 10.4554C2.52763 9.80249 3.23005 9.3328 4.025 9.11875C4.0484 9.1627 4.07558 9.20452 4.10625 9.24375L4.33125 9.4625H4.375L3.975 12.9875C3.96387 13.0806 3.97382 13.175 4.00411 13.2637C4.0344 13.3524 4.08426 13.4332 4.15 13.5L4.5875 13.9375C4.62268 13.974 4.66263 14.0055 4.70625 14.0313C4.96988 13.2601 5.39617 12.5546 5.95625 11.9625L5.65625 9.46875ZM5 3.75C5.41332 3.75 5.8098 3.91376 6.10265 4.20543C6.3955 4.49711 6.56085 4.89293 6.5625 5.30625C6.5625 6.40625 5.8625 7.3 5 7.3C4.1375 7.3 3.4375 6.40625 3.4375 5.30625C3.43915 4.89293 3.6045 4.49711 3.89735 4.20543C4.1902 3.91376 4.58668 3.75 5 3.75Z" fill="white"/>
<path d="M20.0002 12.7312C19.9985 11.682 19.6669 10.6599 19.0522 9.80971C18.4375 8.95947 17.571 8.32414 16.5752 7.99365C16.9726 7.66881 17.2914 7.25836 17.5078 6.79299C17.7243 6.32762 17.8328 5.81935 17.8252 5.30615C17.8252 4.56023 17.5289 3.84486 17.0014 3.31741C16.474 2.78997 15.7586 2.49365 15.0127 2.49365C14.2668 2.49365 13.5514 2.78997 13.024 3.31741C12.4965 3.84486 12.2002 4.56023 12.2002 5.30615C12.1998 5.47769 12.2123 5.649 12.2377 5.81865C12.8849 6.36283 13.3042 7.1301 13.4127 7.96865C13.4357 8.11121 13.4462 8.25551 13.444 8.3999C13.4435 8.72811 13.4057 9.05521 13.3315 9.3749C13.5521 9.26166 13.7848 9.1736 14.0252 9.1124C14.0486 9.15635 14.0758 9.19818 14.1065 9.2374L14.3315 9.45615L14.0502 11.9562C14.6103 12.5482 15.0366 13.2537 15.3002 14.0249C15.3438 13.9991 15.3838 13.9676 15.419 13.9312L15.8565 13.4937C15.9222 13.4268 15.9721 13.3461 16.0023 13.2573C16.0326 13.1686 16.0426 13.0742 16.0315 12.9812L15.6315 9.45615L15.8565 9.2374C15.8871 9.19818 15.9143 9.15635 15.9377 9.1124C16.7406 9.31972 17.4522 9.78734 17.9611 10.4421C18.47 11.0969 18.7475 11.9019 18.7502 12.7312V14.3749H20.0002V12.7312ZM15.0002 3.7499C15.4135 3.7499 15.81 3.91366 16.1029 4.20534C16.3957 4.49701 16.5611 4.89284 16.5627 5.30615C16.5627 6.40615 15.8627 7.2999 15.0002 7.2999C14.1377 7.2999 13.4377 6.40615 13.4377 5.30615C13.4394 4.89284 13.6047 4.49701 13.8976 4.20534C14.1904 3.91366 14.5869 3.7499 15.0002 3.7499Z" fill="white"/>
</g>
<defs>
<clipPath id="clip0_102_13492">
<rect width="20" height="20" fill="white"/>
</clipPath>
</defs>
</svg>

              <p>
                Vendor Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="{{ Request::segment(1) === 'vendor-list' ? 'active' : null }} nav-link" href="{{ url('vendor-list') }}">
                 
                   -
                  <p>Vendor List</p>
                </a> 
              </li>
              <!--<li class="nav-item">-->
              <!--  <a href="{{ url('/vendor-registration') }}" class="nav-link">-->
              <!--    --->
              <!--    <p>Vendor Registration</p>-->
              <!--  </a>-->
              <!--</li>-->
              <li class="nav-item">
              <!--   <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a> -->
              </li>
              <li class="nav-item">
               <!--  <a href="pages/charts/uplot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>uPlot</p>
                </a> -->
              </li>
            </ul>
          </li>
            <li class="nav-item">
            <a class="{{ Request::segment(1) === 'vouchersold' ? 'active' : null }} nav-link" href="{{ url('vouchersold') }}" >
              <svg width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3384 2.5L2.33301 10H5.03462V16.6667H10.4378V11.6667H12.2389V16.6667H17.6421V10H20.3438L11.3384 2.5ZM15.8414 15H14.0403V10H8.63712V15H6.83605V8.4917L11.3387 4.7417L15.8414 8.4917V15Z" fill="white"/>
</svg>

              <p>
                Discount Voucher List
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
        
          </li>
<!--          <li class="nav-item">-->
              
<!--            <a href="{{ url('/discount-voucher-list') }}" class="nav-link">-->
<!--              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--<path d="M17.3337 7.66675C17.0003 7.33341 16.8337 6.91675 16.8337 6.50008C16.8337 4.66675 15.3337 3.16675 13.5003 3.16675C13.0837 3.16675 12.667 3.00008 12.3337 2.66675C11.0003 1.33341 8.91699 1.33341 7.58366 2.66675C7.33366 3.00008 6.91699 3.16675 6.50033 3.16675C4.66699 3.16675 3.16699 4.66675 3.16699 6.50008C3.16699 6.91675 3.00033 7.33341 2.66699 7.66675C1.33366 9.00008 1.33366 11.0834 2.66699 12.4167C3.00033 12.7501 3.16699 13.1667 3.16699 13.5834C3.16699 15.4167 4.66699 16.9167 6.50033 16.9167C6.91699 16.9167 7.33366 17.0834 7.66699 17.4167C8.33366 18.0001 9.16699 18.3334 10.0003 18.3334C10.8337 18.3334 11.7503 18.0001 12.3337 17.3334C12.667 17.0001 13.0837 16.8334 13.5003 16.8334C15.3337 16.8334 16.8337 15.3334 16.8337 13.5001C16.8337 13.0834 17.0003 12.6667 17.2503 12.3334C18.667 11.0834 18.667 8.91675 17.3337 7.66675ZM16.167 11.1667C15.5003 11.8334 15.167 12.6667 15.167 13.5001C15.167 14.4167 14.417 15.1667 13.5003 15.1667C12.5837 15.1667 11.7503 15.5001 11.167 16.1667C10.5003 16.8334 9.50033 16.8334 8.83366 16.1667C8.16699 15.5001 7.33366 15.1667 6.50033 15.1667C5.58366 15.1667 4.83366 14.4167 4.83366 13.5001C4.83366 12.5834 4.50033 11.7501 3.83366 11.1667C3.16699 10.5001 3.16699 9.50008 3.83366 8.83341C4.50033 8.16675 4.83366 7.33341 4.83366 6.50008C4.83366 5.58341 5.58366 4.83341 6.50033 4.83341C7.41699 4.83341 8.25033 4.50008 8.83366 3.83341C9.16699 3.50008 9.58366 3.33341 10.0003 3.33341C10.417 3.33341 10.8337 3.50008 11.167 3.83341C11.8337 4.50008 12.667 4.83341 13.5003 4.83341C14.417 4.83341 15.167 5.58341 15.167 6.50008C15.167 7.41675 15.5003 8.25008 16.167 8.83341C16.8337 9.50008 16.8337 10.5001 16.167 11.1667Z" fill="white"/> -->
<!--<path d="M11.6673 12.5002C12.1276 12.5002 12.5007 12.1271 12.5007 11.6668C12.5007 11.2066 12.1276 10.8335 11.6673 10.8335C11.2071 10.8335 10.834 11.2066 10.834 11.6668C10.834 12.1271 11.2071 12.5002 11.6673 12.5002Z" fill="white"/>-->
<!--<path d="M8.33333 9.16667C8.79357 9.16667 9.16667 8.79357 9.16667 8.33333C9.16667 7.8731 8.79357 7.5 8.33333 7.5C7.8731 7.5 7.5 7.8731 7.5 8.33333C7.5 8.79357 7.8731 9.16667 8.33333 9.16667Z" fill="white"/>-->
<!--<path d="M11.0833 7.75L7.75 11.0833C7.41667 11.4167 7.41667 11.9167 7.75 12.25C7.91667 12.4167 8.08333 12.5 8.33333 12.5C8.58333 12.5 8.75 12.4167 8.91667 12.25L12.25 8.91667C12.5833 8.58333 12.5833 8.08333 12.25 7.75C11.9167 7.41667 11.4167 7.41667 11.0833 7.75Z" fill="white"/>-->
<!--</svg>-->
<!--               <p>-->
<!--                Discount Voucher Management-->
<!--                <i class="right fas fa-angle-left"></i>-->
<!--              </p>-->
<!--            </a>-->
<!--            <ul class="nav nav-treeview">-->
<!--               <li class="nav-item">
<!--                <a href="#" class="nav-link">-->
                 
<!--                   --->
<!--                  <p>Voucher avals</p>-->
<!--                </a> -->
<!--              </li> -->
<!--              <li class="nav-item">-->
<!--                <a href="{{ url('/vouchersold') }}" class="nav-link">-->
<!--                  --->
<!--                  <p>Sold Vouchers</p>-->
<!--                </a>-->
<!--              </li>-->
<!--              <li class="nav-item">-->
<!--              <a href="{{ url('/discount-voucher-list') }}" class="nav-link">-->
<!--                --->
<!--                 <p>Available Vouchers</p>-->
<!--              </a>-->
<!--              </li>-->
<!--              <li class="nav-item">-->
               <!--  <a href="pages/charts/uplot.html" class="nav-link">
<!--                  <i class="far fa-circle nav-icon"></i>-->
<!--                  <p>uPlot</p>-->
<!--                </a> -->
<!--              </li>-->
<!--            </ul>-->
<!--          </li>-->
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
              <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/sliders.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/modals.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modals & Alerts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/navbar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Navbar & Tabs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/timeline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Timeline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/ribbons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ribbons</p>
                </a>
              </li>
            </ul>
         <!--  </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/validation.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul> -->
<!--           </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li> --> 
        <!--   <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Kanban Board
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/e-commerce.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-commerce</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/contacts.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/faq.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FAQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/contact-us.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact us</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v1
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/login.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/forgot-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/recover-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v1</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v2
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/examples/login-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/register-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/examples/recover-password-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v2</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="pages/examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Legacy User Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/language-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Language Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/404.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/500.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/pace.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pace</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/blank.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="starter.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/search/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Search</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/search/enhanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enhanced</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="iframe.html" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Tabbed IFrame Plugin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-header">MULTI LEVEL EXAMPLE</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Level 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Level 2
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>