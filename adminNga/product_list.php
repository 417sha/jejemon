<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "db_sdshoppe");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT product_id, product_name, price, quantity, status FROM products";

$result = $conn->query($sql);

?>

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
    <title>ADMIN | Product List</title>
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

    <!-- Sidebar and Content Area -->
    <div class="container-fluid">
      <div class="row vh-100">
        <!-- Main Content Area -->
        <div class="col-10 p-4">
          <h1>Product List</h1>
          <!-- Product Search and Add Button -->
          <div class="d-flex justify-content-between mb-4">
          <div class="search-bar">
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1">
                <i class="bi bi-search search-icon"></i>
              </span>
              <input type="search" 
              class="form-control" 
              placeholder="Search..." 
              id="searchInput" 
              onkeyup="filterProducts()" />
            </div>
          </div>
          <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="stockFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Filter by Stock
          </button>
          <ul class="dropdown-menu" aria-labelledby="stockFilterDropdown">
            <li><a class="dropdown-item" href="#" onclick="filterStockStatus('All')">All</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterStockStatus('In Stock')">In Stock</a></li>
            <li><a class="dropdown-item" href="#" onclick="filterStockStatus('Out of Stock')">Out of Stock</a></li>
          </ul>
        </div>


            <button
              class="btn btn-primary"
              onclick="window.location.href='add_product.php'"
            >
              + ADD NEW
            </button>
          </div>

          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">Available Products</h5>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>PRODUCT</th>
                    <th>PRODUCT ID</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>STOCK</th>
                    
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                // Dynamically populate product rows
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Determine stock status based on quantity
                        $status = $row['quantity'] > 0 ? 'In Stock' : 'Out of Stock';

                        echo "<tr>
                                <td>" . htmlspecialchars($row['product_name']) . "</td>
                                <td>{$row['product_id']}</td>
                                <td>₱" . number_format($row['price'], 2) . "</td>
                                <td>{$row['quantity']}</td>
                                <td>{$status}</td>
                                <td>
                                    <a href='edit_product.php?id={$row['product_id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_product.php?id={$row['product_id']}' class='btn btn-danger btn-sm'
                                      onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No products found</td></tr>";
                }
                ?>
              </tbody>

              </table>
            </div>
          </div>
        </div>
        <!-- Sidebar -->
        <div class="col-2 sidebar p-3">
          <div class="list-group">
            <a href="index.php" class="list-group-item">
              <img
                src="/Assets/svg(icons)/speedometer.svg"
                alt="Dashboard Icon"
                class="sidebar-icon"
              />
              Dashboard
            </a>
            <a></a>
            <a href="product_list.php" class="list-group-item">
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
              class="list-group-item list-group-item-action active"
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

          <script>
      function filterProducts() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let products = document.querySelectorAll('tbody tr');
        
        products.forEach((product) => {
          let productName = product.querySelector('td').textContent.toLowerCase();
          
          if (productName.includes(input)) {
            product.style.display = '';
            product.style.backgroundColor = 'yellow'; // Highlight the matching products
          } else {
            product.style.display = 'none';
            product.style.backgroundColor = ''; // Remove highlight from non-matching products
          }
        });
      }
      </script>
<script>
function filterStockStatus(status) {
  let products = document.querySelectorAll('tbody tr');

  products.forEach((product) => {
    let stockStatus = product.querySelector('td:nth-child(5)').textContent;

    if (status === 'All' || stockStatus === status) {
      product.style.display = '';
    } else {
      product.style.display = 'none';
    }
  });
}
</script>

         
  </body>
</html>
