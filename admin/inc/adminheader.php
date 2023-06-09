

  <!-- Side Nav Bar -->
  <div class="bg-dark border-top border-3 border-secondary h-100 " id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-white">ADMIN PANEL</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown"> -->
            <div>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks">
                            <span>Bookings</span>
                            <span><i class="bi bi-caret-down-fill"></i></span>
                        </button>
                        <div class="collapse show px-3 small mb-1" id="bookingLinks">
                            <ul class="nav nav-pills flex-column rounded border border-secondary">
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="new_bookings.php">New Bookings</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="user_queries.php">User Queries</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="rooms.php">Rooms</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="features_facilities.php">Features and Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="carousel.php">Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="settings.php">Settings</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
</div>