  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/dashboard" class="brand-link">
          <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="brand-image img-circle elevation-3"
              style="opacity: 1">
          <span class="brand-text font-weight-light">TashiCell</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="/dashboard" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-sitemap"></i>
                          <p>
                              Master
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="../search/simple.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Master 1</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../search/enhanced.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Master 2</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-cogs"></i>
                          <p>
                              System Settings
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @foreach (config()->get('settings.system_settings') as $item)
                              <li class="nav-item">
                                  <a href="{{ route($item['route']) }}"
                                      class="nav-link {{ 'setting/' . $item['name'] == Request::segment(1) . '/' . Request::segment(2) ? 'active' : '' }}">
                                      <i class="nav-icon fas fa-minus"></i>
                                      {{ $item['menu'] }}
                                  </a>
                              </li>
                          @endforeach
                      </ul>
                  </li>
                  <li class="nav-header">EXAMPLES</li>
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
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>
                                      Login & Register v1
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>
                                      Login & Register v2
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="../examples/login-v2.html" class="nav-link">
                                          <i class="nav-icon fas fa-minus"></i>
                                          <p>Login v2</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="../examples/register-v2.html" class="nav-link">
                                          <i class="nav-icon fas fa-minus"></i>

                                          <p>Register v2</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="../examples/forgot-password-v2.html" class="nav-link">
                                          <i class="nav-icon fas fa-minus"></i>

                                          <p>Forgot Password v2</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="../examples/recover-password-v2.html" class="nav-link">
                                          <i class="nav-icon fas fa-minus"></i>

                                          <p>Recover Password v2</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="../examples/lockscreen.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Lockscreen</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../examples/legacy-user-menu.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Legacy User Menu</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../examples/language-menu.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Language Menu</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../examples/404.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Error 404</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../examples/500.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Error 500</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../examples/pace.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Pace</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../examples/blank.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Blank Page</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../../starter.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
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
                              <a href="../search/simple.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Simple Search</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="../search/enhanced.html" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Enhanced</p>
                              </a>
                          </li>
                      </ul>
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
                                  <i class="nav-icon fas fa-minus"></i>
                                  <p>Level 2</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-minus"></i>
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
                                  <i class="nav-icon fas fa-minus"></i>
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
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>

  <script>
      $(document).ready(function() {
          $(".nav-link").click(function(e) {
              $(".nav-link").removeClass("active");
              $(this).addClass("active");
          });
      });
  </script>
