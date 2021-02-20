<div class="sidebar" data-color="orange">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
      <a href="/dashboard" class="simple-text logo-mini">
          DS
      </a>
      <a href="/dashboard" class="simple-text logo-normal">
          Desa Simo
      </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
        <a href="/dashboard">
            <i class="now-ui-icons design_app"></i>
            <p>Dashboard</p>
        </a>
        </li>

        @if ( auth()->user()->level == 'masyarakat' )
          <li class="{{ request()->is('pengaduan/create') ? 'active' : '' }}">
              <a href="/pengaduan/create">
                  <i class="far fa-edit"></i>
                  <p>Form Pengaduan</p>
              </a>
          </li>
          <li>
              <a data-toggle="collapse" href="#laravelExamples">
                  <i class="fas fa-database"></i>
                <p>
                  Kiriman Saya
                  <b class="caret"></b>
                </p>
              </a>
              <div class="collapse show" id="laravelExamples">
                <ul class="nav">
                  <li class="{{ request()->is('pengaduan') ? 'active' : '' }}">
                    <a href="/pengaduan">
                      <i class="fab fa-wpforms"></i>
                      <p> Pengaduan </p>
                    </a>
                  </li>
                  <li class="{{ request()->is('aspirasi') ? 'active' : '' }}">
                    <a href="/aspirasi">
                      <i class="fab fa-wpforms"></i>
                      <p> Aspirasi </p>
                    </a>
                  </li>
                </ul>
              </div>
          </li>
        @elseif ( auth()->user()->level == 'petugas' or 'admin')
          <li>
            <a data-toggle="collapse" href="#laravelExamples">
                <i class="fas fa-server"></i>
              <p>
                Data
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse show" id="laravelExamples">
              <ul class="nav">
                <li class="{{ request()->is('masyarakat/pengaduan') ? 'active' : '' }}">
                  <a href="/masyarakat/pengaduan">
                    <i class="fab fa-wpforms"></i>
                    <p> Pengaduan </p>
                  </a>
                </li>
                <li class="{{ request()->is('masyarakat/aspirasi') ? 'active' : '' }}">
                  <a href="/masyarakat/aspirasi">
                    <i class="fab fa-wpforms"></i>
                    <p> Aspirasi </p>
                  </a>
                </li>
                <li class="{{ request()->is('masyarakat') ? 'active' : '' }}">
                  <a href="/masyarakat">
                    <i class="fas fa-users"></i>
                    <p> Masyarakat </p>
                  </a>
                </li>
                
              </ul>
            </div>
          </li>
          <li class="{{ request()->is('kegiatan') ? 'active' : '' }}">
            <a href="/kegiatan">
              <i class="far fa-calendar-alt"></i>
              <p> Kegiatan </p>
            </a>
          </li>
          @if ( auth()->user()->level == 'admin' )
            <li class="{{ request()->is('petugas') ? 'active' : '' }}">
                <a href="/petugas">
                    <i class="fas fa-user-tie"></i>
                    <p>Petugas</p>
                </a>
            </li>
          @endif
        @endif
    </ul>
    </div>
</div>