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
    <link rel="stylesheet" href="order_d.css" />
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
          <div class="container my-4">
            <h1>ORDER #123783</h1>

            <!-- Order List Search Bar (Matching Navbar Search Bar) -->
            <div class="d-flex justify-content-between mb-3">
              <div class="input-group w-25">
                <span class="input-group-text" id="basic-addon1">
                  <i class="bi bi-search search-icon"></i>
                </span>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Search..."
                  aria-label="Search"
                  aria-describedby="basic-addon1"
                />
              </div>
              <button id="exportPdf" class="btn btn-warning">
                Export to PDF
              </button>
            </div>

            <div class="row">
              <!-- Left Side: Order Items -->
              <div class="col-md-8">
                <h4 class="mb-3">All Items</h4>

                <!-- Order Items -->
                <div class="card mb-3">
                  <div class="row g-0 align-items-center">
                    <div class="col-md-3">
                      <img
                        src="/Assets/images/sample_image1.jpg"
                        class="img-fluid rounded-start"
                        alt="Product Image"
                      />
                    </div>
                    <div class="col-md-9">
                      <div class="card-body">
                        <h5 class="card-title">Product Name</h5>
                        <p class="mb-1">BUYER: Danica</p>
                        <p class="mb-1">Quantity: 5</p>
                        <p class="fw-bold">Price: P 3,250.00</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card mb-3">
                  <div class="row g-0 align-items-center">
                    <div class="col-md-3">
                      <img
                        src="/Assets/images/sample_image2.jpg"
                        class="img-fluid rounded-start"
                        alt="Product Image"
                      />
                    </div>
                    <div class="col-md-9">
                      <div class="card-body">
                        <h5 class="card-title">Product Name</h5>
                        <p class="mb-1">BUYER: Danica</p>
                        <p class="mb-1">Quantity: 5</p>
                        <p class="fw-bold">Price: P 2,750.00</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Cart Totals -->
                <div class="mt-4 p-3 rounded">
                  <h5>Cart Totals</h5>
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                      <span>Subtotal:</span><span>P 6,000.00</span>
                    </li>
                    <a></a>
                    <li class="list-group-item d-flex justify-content-between">
                      <span>Shipping Fee:</span><span>P 150.00</span>
                    </li>
                    <a></a>
                    <li
                      class="list-group-item d-flex justify-content-between fw-bold"
                    >
                      <span>Total:</span><span>P 6,150.00</span>
                    </li>
                  </ul>
                </div>
              </div>

              <!-- Right Side: Order Summary -->
              <div class="col-md-4">
                <div class="p-3 rounded mb-4">
                  <h5>Summary</h5>
                  <ul class="list-group">
                    <li class="list-group-item">
                      Order ID: <span class="fw-bold">#123783</span>
                    </li>
                    <a></a>
                    <li class="list-group-item">
                      Date: <span>Nov-01-2024</span>
                    </li>
                    <a></a>
                    <li class="list-group-item">
                      Total: <span class="fw-bold text-danger">P 6,150.00</span>
                    </li>
                  </ul>
                </div>

                <div class="col-md-11">
                  <!-- Shipping Address -->
                  <div
                    class="p-3 rounded mb-4"
                    style="background-color: #f1e8d9; border: 2px solid #d9b65d"
                  >
                    <h5 class="mb-3">Shipping Address</h5>
                    <p class="m-0">1234 Makati Jan sa tabi</p>
                  </div>

                  <!-- Payment Method -->
                  <div
                    class="p-3 rounded"
                    style="background-color: #f1e8d9; border: 2px solid #d9b65d"
                  >
                    <h5 class="mb-3">Payment Method</h5>
                    <p class="m-0">E-Wallet (GCash)</p>
                    <p class="m-0">09123456789</p>
                    <span class="badge bg-success mt-2">PAID</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-2 sidebar p-3">
          <div class="list-group">
            <a href="#" class="list-group-item">
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
              class="list-group-item list-group-item-action list-group-item-action active"
            >
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
              <img
                src="/Assets/svg(icons)/person-fill.svg"
                alt="User Icon"
                class="sidebar-icon"
              />
              User List
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>