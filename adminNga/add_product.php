<?php
$conn = new mysqli("localhost", "root", "", "db_sdshoppe");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from form inputs
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $colors = isset($_POST['colors']) ? $_POST['colors'] : []; // Check if colors are selected

    // Handle file uploads (if needed)
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        $upload_dir = "uploads/";
        foreach ($_FILES['images']['name'] as $key => $filename) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $file_path = $upload_dir . basename($filename);
            move_uploaded_file($tmp_name, $file_path);
        }
    }

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Step 1: Insert the product into the `product` table
        $sql_product = "INSERT INTO products (product_name, category, price, quantity) 
                        VALUES (?, ?, ?, ?)";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->bind_param("ssdi", $product_name, $category, $price, $quantity);
        $stmt_product->execute();

        // Get the ID of the newly inserted product
        $product_id = $conn->insert_id;

        // Step 2: Insert the selected colors into the `product_colors` table
        $sql_colors = "INSERT INTO product_colors (product_id, color_name) VALUES (?, ?)";
        $stmt_colors = $conn->prepare($sql_colors);

        foreach ($colors as $color) {
            $stmt_colors->bind_param("is", $product_id, $color);
            $stmt_colors->execute();
        }

        // Commit the transaction
        $conn->commit();

        echo "Product added successfully.";
        header("Location: product_list.php");
        exit;
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
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
    <link rel="stylesheet" href="add_p.css" />
    <link rel="icon" href="/Assets/images/sndlogo.png" type="logo" />
    <title>ADMIN | Add Product</title>
  </head>
  <body class="vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div
        class="container-fluid d-flex justify-content-between align-items-center"
      >
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
        <div class="col-10 p-4">
          <h1>ADD PRODUCT</h1>
          <form
          action="add_product.php"
          method="POST"
          enctype="multipart/form-data"
          class="mt-4"
          >

          <!-- Product Information Section -->
          <div class="section">
            <label for="productName" class="form-label">Product Name</label>
          <input
            type="text"
            id="productName"
            name="product_name"
            class="form-control"
            placeholder="Enter product name"
            required
          />
      
            <div class="row">
              <div class="col">
              <label for="category" class="form-label">Category</label>
              <select
                id="category"
                name="category"
                class="form-control"
                required
              >
              <option value="" disabled selected>Select a category</option>
              <option value="Beaded Lace">Beaded Lace</option>
              <option value="Corded Lace">Corded Lace</option>
              <option value="Caviar">Caviar</option>
              <option value="Candy Crush">Candy Crush</option>
            </select>
            </div>
              <div class="col">
              <label for="price" class="form-label">Price</label>
            <input
              type="number"
              id="price"
              name="price"
              class="form-control"
              placeholder="Enter price"
              step="1.00"
              required
                />
              </div>
            </div>

            <label>Description</label>
            <textarea
              class="form-control"
              rows="4"
              placeholder="Enter description"
            ></textarea>
          </div>

          <!-- Images and Additional Details Section -->
          <div class="section">
            <label>Upload Images</label>
            <input
              type="file"
              id="imageUpload"
              accept="image/*"
              multiple
              style="display: none"
              onchange="previewImages(event)"
            />
            <button
              type="button"
              class="btn btn-outline-secondary"
              onclick="document.getElementById('imageUpload').click()"
            >
              Upload Images
            </button>

            <div class="image-upload d-flex gap-3 mt-3">
              <div class="image-box"></div>
              <div class="image-box"></div>
              <div class="image-box"></div>
            </div>

            <label for="quantity" class="form-label">Quantity</label>
          <input
            type="number"
            id="quantity"
            name="quantity"
            class="form-control"
            placeholder="Enter quantity"
            required
            />

             <label class="form-label">Select Colors</label>
          <div>
            <label>
              <input type="checkbox" name="colors[]" value="blush pink" /> Blush Pink
            </label>
            <label>
              <input type="checkbox" name="colors[]" value="Blue" /> Champagne
            </label>
            <label>
              <input type="checkbox" name="colors[]" value="Green" /> Cyan
            </label>
            <label>
              <input type="checkbox" name="colors[]" value="Red" /> Dark Green
            </label>
            <label>
            </div>
            <div>
              <input type="checkbox" name="colors[]" value="Emerald Green" /> Emerald Green
            </label>
            <label>
              <input type="checkbox" name="colors[]" value="Fuchsia Pink" /> Fuchsia Pink
            </label>
            <label>
              <input type="checkbox" name="colors[]" value="Lavender" /> Lavender
            </label>
            <label>
              <input type="checkbox" name="colors[]" value="Magenta" /> Magenta
            </label>
            <label>
            </div>
            <div>
              <input type="checkbox" name="colors[]" value="Pink" /> Pink
            </label>
            <label>
              <input type="checkbox" name="colors[]" value="Red" /> Red
            </label><label>
              <input type="checkbox" name="colors[]" value="Royal Blue" /> Royal Blue
            </label><label>
              <input type="checkbox" name="colors[]" value="Silver" /> Silver
            </label>
            </label><label>
              <input type="checkbox" name="colors[]" value="White" /> White
            </label>
            <label>
              <input type="checkbox" name="colors[]" value="Others" /> Others:
              <input type="text" name="otherColor" placeholder="Specify other color" />
            </label>
          </div>

          <div class="buttons d-flex justify-content-between gap-3">
  <button type="button" class="btn btn-secondary" onclick="window.location.href='product_list.php'">Back</button>
  <div>
    <button type="submit" class="btn btn-outline-secondary">Save Product</button>
    <button type="submit" class="btn btn-primary">ADD PRODUCT</button>
  </div>
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
            <a href="#" class="list-group-item list-group-item-action active">
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
    <script src="script.js"></script>
  </body>
</html>