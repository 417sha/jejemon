<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sdshoppe";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT product, order_id, date, price, quantity, status, tracking_number FROM confirmed_order";
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
    <link rel="stylesheet" href="orders_l.css" />
    <link rel="icon" href="/Assets/images/sndlogo.png" type="logo" />
    <title>ADMIN | Order List</title>
  </head>
  <body class="vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div
        class="container-fluid d-flex justify-content-between align-items-center"
      >
        <a class="navbar-brand fs-4" href="/pages/homepage.html">
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
              <ul
                class="dropdown-menu dropdown-menu-end"
                aria-labelledby="accountDropdown"
              >
                <li>
                  <a
                    class="dropdown-item"
                    href="/pages/myAccountPage/myPurchase.html"
                  >
                    My Account
                  </a>
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
        <div class="col-10 main-content p-4">
          <div class="container">
            <h1 class="mb-2">Order List</h1>
            <div class="d-flex justify-content-between mb-3">
            <div class="search-bar">
  <div class="input-group">
    <span class="input-group-text" id="basic-addon1">
      <i class="bi bi-search search-icon"></i>
    </span>
    <input type="search" 
      class="form-control" 
      placeholder="Search..." 
      id="orderSearchInput" 
      onkeyup="filterOrders()" />
  </div>
</div>

              <div class="dropdown">
                <button
                  class="btn btn-secondary dropdown-toggle"
                  type="button"
                  id="statusFilterDropdown"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Filter by Status
                </button>
                <ul class="dropdown-menu" aria-labelledby="statusFilterDropdown">
                  <li><a class="dropdown-item" href="#" onclick="filterStatus('All')">All</a></li>
                  <li><a class="dropdown-item" href="#" onclick="filterStatus('Pending')">Pending</a></li>
                  <li><a class="dropdown-item" href="#" onclick="filterStatus('Shipped')">Shipped</a></li>
                  <li><a class="dropdown-item" href="#" onclick="filterStatus('Delivered')">Delivered</a></li>
                </ul>
              </div>
              <button id="exportPdf" class="btn btn-warning">
                Export to PDF
              </button>
            </div>

            <!-- Order List Table -->
            <div class="table-responsive">
              <table class="table table-bordered text-center order-table">
                <thead class="table-light">
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tracking Number</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['product']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                            echo "<td>₱ " . number_format($row['price'], 2) . "</td>";
                            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";

                            // Format status with badges
                            $status_class = match ($row['status']) {
                                'Pending' => 'bg-warning',
                                'Shipped' => 'bg-success',
                                'Delivered' => 'bg-primary',
                                default => 'bg-secondary',
                            };
                            echo "<td><span class='badge $status_class'>" . htmlspecialchars($row['status']) . "</span></td>";

                            echo "<td>" . htmlspecialchars($row['tracking_number']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No orders found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
        </div>

        <!-- Sidebar on the Right -->
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

    <!-- Include jsPDF for PDF export 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
      // Code for Export to PDF functionality
      const { jsPDF } = window.jspdf;
      document.getElementById("exportPdf").addEventListener("click", () => {
        const doc = new jsPDF();
        doc.html(document.querySelector(".table-responsive"), {
          callback: function (doc) {
            doc.save("order-list.pdf");
          },
        });
      });
    </script>-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script>
  document.getElementById("exportPdf").addEventListener("click", () => {
    // Initialize jsPDF
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Define the HTML table to export
    const table = document.querySelector(".order-table");

    // Use autoTable plugin to export the table
    doc.autoTable({
      html: table, // Target the HTML table
      theme: 'grid', // Choose a theme (default, grid, strip, plain)
      styles: {
        fontSize: 10, // Adjust font size if needed
        cellPadding: 4, // Adjust cell padding
      },
      headStyles: {
        fillColor: [220, 220, 220], // Light gray background for headers
      },
    });

    // Save the PDF
    doc.save("order-list.pdf");
  });
</script>
<script>
function filterOrders() {
  let input = document.getElementById('orderSearchInput').value.toLowerCase();
  let orders = document.querySelectorAll('tbody tr');

  orders.forEach((order) => {
    let orderName = order.querySelector('td').textContent.toLowerCase();
    
    if (orderName.includes(input)) {
      order.style.display = '';
      order.style.backgroundColor = 'yellow'; // Highlight the matching orders
    } else {
      order.style.display = 'none';
      order.style.backgroundColor = ''; // Remove highlight from non-matching orders
    }
  });
}
</script>

  </body>
</html>