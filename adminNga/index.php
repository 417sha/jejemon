<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="/Assets/images/sndlogo.png" type="logo" />
    <title>S&D Fabrics</title>
  </head>
  <body class="vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div
        class="container-fluid d-flex justify-content-between align-items-center"
      >
        <!-- Logo -->
        <a class="navbar-brand fs-4" href="homepage.html">
          <img src="/Assets/images/sndlogo.png" width="70px" alt="Logo" />
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarTogglerDemo01"
          aria-controls="navbarTogglerDemo01"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <div class="mx-auto d-flex justify-content-center flex-grow-1">
            <form class="search-bar" role="search">
              <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                  <i class="bi bi-search search-icon"></i>
                </span>
                <input
                  class="form-control"
                  type="search"
                  placeholder="Search..."
                  aria-label="Search"
                  aria-describedby="basic-addon1"
                />
              </div>
            </form>
          </div>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
            <li class="nav-item">
              <a class="nav-link nav-link-black" href="#">
                <img src="/Assets/svg(icons)/notifications.svg" alt="notif" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-black" href="#">
                <img src="/Assets/svg(icons)/inbox.svg" alt="inbox" />
              </a>
            </li>
            <!-- Owner Dropdown with Admin Text Below -->
            <li class="nav-item dropdown d-flex align-items-center">
              <a
                class="nav-link nav-link-black"
                href="#"
                id="accountDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <img
                  src="/Assets/svg(icons)/account_circle.svg"
                  alt="account"
                  class="me-2"
                />
              </a>
              <div class="text-center">
                <a
                  class="nav-link nav-link-black"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <div>OWNER</div>
                  <div class="text-muted" style="font-size: 0.85em">Admin</div>
                </a>
              </div>
              <!-- Hamburger Icon for Dropdown -->
              <a
                class="nav-link nav-link-black ms-2"
                href="#"
                id="accountDropdownToggle"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="bi bi-list"></i>
              </a>
              <!-- Dropdown Menu -->
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="accountDropdown"
              >
                <li>
                  <a
                    class="dropdown-item"
                    href="/pages/myAccountPage/myPurchase.html"
                    >My Account</a
                  >
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item text-danger" href="#">Logout</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row vh-100">
        <!-- Main Content Area -->
        <div class="col-10 p-4" style="margin-left: auto">
          <!-- Dashboard Cards -->
          <div class="row g-3">
            <div class="col-md-3">
              <div class="card p-3">Total Sales</div>
            </div>
            <div class="col-md-3">
              <div class="card p-3">Total Income</div>
            </div>
            <div class="col-md-3">
              <div class="card p-3">Orders Paid</div>
            </div>
            <div class="col-md-3">
              <div class="card p-3">Pending Orders</div>
            </div>
          </div>

          <!-- Larger Cards for Main Content -->
          <div class="row mt-3">
            <div class="col-md-6">
              <div class="card p-4">Recent Orders</div>
            </div>
            <div class="col-md-6">
              <div class="card p-4">Top Products</div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="card p-4">Product Overview</div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-12">
              <div class="card p-4">Orders</div>
            </div>
          </div>
        </div>

        <div class="col-2 sidebar p-3">
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active">
              <!-- SVG Icon for Dashboard -->
              <img
                src="/Assets/svg(icons)/speedometer.svg"
                alt="Dashboard Icon"
                class="sidebar-icon"
              />
              Dashboard
            </a>
            <a></a>
            <a
              href="product_list.php"
              class="list-group-item list-group-item-action"
            >
              <!-- SVG Icon for Product -->
              <img
                src="/Assets/svg(icons)/basket.svg"
                alt="Product Icon"
                class="sidebar-icon"
              />
              Product
            </a>
            <a></a>
            <a
              href="orders.php"
              class="list-group-item list-group-item-action"
            >
              <!-- SVG Icon for Order -->
              <img
                src="/Assets/svg(icons)/bag-fill.svg"
                alt="Order Icon"
                class="sidebar-icon"
              />
              Order
            </a>
            <a></a>
            <a
              href="user_list.php"
              class="list-group-item list-group-item-action"
            >
              <!-- SVG Icon for User -->
              <img
                src="/Assets/svg(icons)/person-fill.svg"
                alt="User Icon"
                class="sidebar-icon"
              />
              User
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>