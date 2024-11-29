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
            <label for="productName" class="form-label"><strong>Product Name</strong></label>
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
              <label for="category" class="form-label"><strong>Category</strong></label>
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
              <label for="price" class="form-label"><strong>Price</strong></label>
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

            <label><strong>Description</strong></label>
            <textarea
              class="form-control"
              rows="4"
              placeholder="Enter description"
            ></textarea>
            <label for="quantity" class="form-label"><strong>Quantity</strong></label>
          <input
            type="number"
            id="quantity"
            name="quantity"
            class="form-control"
            placeholder="Enter quantity"
            required
            />

            <div>
          </div>

          
          <div class="section">
            <!-- Images and Additional Details Section 
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
            </div> -->

            
            <div class="container">
              <label class="form-label"><strong>SELECT COLORS</strong></label>
              <div id="color-options" class="d-flex flex-column">
                      <label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Blush Pink" onchange="toggleColorImage(this)" />
                          Blush Pink
                      </div>
                      <div id="upload-Blush Pink" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Blush Pink]" class="form-control" accept="image/*" required>
                      </div>
                  </label>
                  <label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Champagne" onchange="toggleColorImage(this)" />
                          Champagne
                      </div>
                      <div id="upload-Champagne" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Champagne]" class="form-control" accept="image/*" required>
                      </div>
                  </label>
                  <label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Cyan" onchange="toggleColorImage(this)" />
                          Cyan
                      </div>
                      <div id="upload-Cyan" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Cyan]" class="form-control" accept="image/*" required>
                      </div>
                  </label>
                  <label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Dark Green" onchange="toggleColorImage(this)" />
                          Dark Green
                      </div>
                      <div id="upload-Dark Green" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Dark Green]" class="form-control" accept="image/*" required>
                      </div>
                  </label>
                  <label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Green" onchange="toggleColorImage(this)" />
                          Green
                      </div>
                      <div id="upload-Green" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Green]" class="form-control" accept="image/*" required>
                      </div>
                  </label><label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Fuchsia Pink" onchange="toggleColorImage(this)" />
                          Fuchsia Pink
                      </div>
                      <div id="upload-Fuchsia Pink" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Fuchsia Pink]" class="form-control" accept="image/*" required>
                      </div>
                  </label><label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Lavender" onchange="toggleColorImage(this)" />
                          Lavender
                      </div>
                      <div id="upload-Lavender" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Lavender]" class="form-control" accept="image/*" required>
                      </div>
                  </label><label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Magenta" onchange="toggleColorImage(this)" />
                          Magenta
                      </div>
                      <div id="upload-Magenta" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Magenta]" class="form-control" accept="image/*" required>
                      </div>
                  </label><label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Pink" onchange="toggleColorImage(this)" />
                          Pink
                      </div>
                      <div id="upload-Pink" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Pink]" class="form-control" accept="image/*" required>
                      </div>
                  </label><label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Red" onchange="toggleColorImage(this)" />
                          Red
                      </div>
                      <div id="upload-Red" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Red]" class="form-control" accept="image/*" required>
                      </div>
                  </label><label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Royal Blue" onchange="toggleColorImage(this)" />
                          Royal Blue
                      </div>
                      <div id="upload-Royal Blue" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Royal Blue]" class="form-control" accept="image/*" required>
                      </div>
                  </label><label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                          <input type="checkbox" name="colors[]" value="Silver" onchange="toggleColorImage(this)" />
                          Silver
                      </div>
                      <div id="upload-Silver" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[Silver]" class="form-control" accept="image/*" required>
                      </div>
                      </label><label class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                        </label>
                          <input type="checkbox" name="colors[]" value="White" onchange="toggleColorImage(this)" />
                          White
                      </div>
                      
                      <div id="upload-White" class="upload-input" style="display: none;">
                          <input type="file" name="color_images[White]" class="form-control" accept="image/*" required>
                      </div>
                      </div>

<!-- -->
                      <div id="custom-colors-section" class="mt-3">
              <label class="form-label"><strong>CUSTOM COLORS</strong></label>
              <!-- Placeholder for new colors -->
              <div id="new-colors-container"></div>
              <!-- Add New Color Button -->
              <button type="button" class="btn btn-outline-primary mt-2" onclick="addNewColor()">Add New Color</button>
          </div>

          <script>
              let colorIndex = 0; // To generate unique IDs for each custom color input

              function addNewColor() {
  const container = document.getElementById("new-colors-container");

  // Create a new div for the color input
  const colorDiv = document.createElement("div");
  colorDiv.className = "d-flex align-items-center justify-content-between mb-2";
  colorDiv.setAttribute("id", `custom-color-${colorIndex}`);

  colorDiv.innerHTML = `
      <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center">
          <input 
              type="text" 
              name="custom_colors[${colorIndex}][name]" 
              class="form-control me-md-3 mb-2 mb-md-0" 
              placeholder="Enter color name" 
              style="max-width: 200px;" 
              required
          />
      </div>
      <div class="ms-3">
          <input 
              type="file" 
              name="custom_colors[${colorIndex}][image]" 
              class="form-control" 
              accept="image/*" 
              style="max-width: 300px;" 
              required
          />
      </div>
      <button 
          type="button" 
          class="btn btn-danger ms-3" 
          onclick="removeColor(${colorIndex})">
          Remove
      </button>
  `;

  // Append the new color input to the container
  container.appendChild(colorDiv);

  // Attach event listener to the file input for previews
  const fileInput = colorDiv.querySelector("input[type='file']");
  fileInput.addEventListener("change", handleFileChange);

  // Increment the index for unique IDs
  colorIndex++;
}



function removeColor(index) { 
  const colorDiv = document.getElementById(`custom-color-${index}`); 
  if (colorDiv) { 
    const colorName = colorDiv.querySelector("input[type='text']").value.trim() || `Color ${index}`;
     colorDiv.remove(); 
     removePreview(colorName); } 
    }

                </script>
                        </label>
                    </div>
                </div>
                <div id="preview-container" class="mt-4">
                <h5>Image Previews:</h5>
                <div id="preview-images" class="d-flex flex-wrap gap-3"></div>
              </div>

                      <script>
                document.addEventListener("DOMContentLoaded", () => {
                  // Attach change event listeners to dynamically added file inputs
                  document.querySelectorAll("input[type='file']").forEach(input => {
                    input.addEventListener("change", handleFileChange);
                  });
                });

                function toggleColorImage(checkbox) { 
                  const uploadInput = document.getElementById(`upload-${checkbox.value}`);
                   if (checkbox.checked) { 
                    uploadInput.style.display = "block"; // Add event listener for new file input 
                    
                    const fileInput = uploadInput.querySelector("input[type='file']");
                    fileInput.addEventListener("change", handleFileChange); // Show the preview if the file was already uploaded 
                    
                    const file = fileInput.files[0]; 
                    if (file) { const reader = new FileReader(); 
                      reader.onload = (e) => { 
                        addPreview(checkbox.value, e.target.result);
                       }; 
                       reader.readAsDataURL(file);
                       } 
                    } else { 
                      uploadInput.style.display = "none"; // Remove preview for this color 
                      removePreview(checkbox.value); } }
         
         
           function handleFileChange(event) {
    const file = event.target.files[0]; // Get the uploaded file
    if (!file) return;
    const colorInputWrapper = event.target.closest(".d-flex");
    const nameInput = colorInputWrapper.querySelector("input[type='text']");
    const existingColorName = nameInput ? nameInput.value.trim() : ""; 
    const colorName = event.target.name.match(/\[([^\]]+)\]/)[1]; // Extract the color name from the input name attribute

   // if (file) {
     //   const reader = new FileReader();
       // reader.onload = (e) => {
         //   addPreview(colorName, e.target.result); // Use the extracted color name
        //};
 //       reader.readAsDataURL(file);
   // } else {
    //    removePreview(colorName); // If no file, remove the preview
    //}
    const reader = new FileReader(); reader.onload = (e) => { addPreview(existingColorName || colorName, e.target.result); // Use the existing or entered name
       }; reader.readAsDataURL(file); // Add an event listener to update the preview when the color name changes
        if (nameInput) { nameInput.addEventListener('input', () => { updatePreviewName(nameInput, nameInput.value.trim() || colorName); 

        });
       } 
      }



function addPreview(colorName, imageSrc) {
  // Check if a preview for this color already exists
  let existingPreview = document.querySelector(`#preview-images .preview-${colorName.replace(/\s+/g, '-')}`);
  if (existingPreview) {
    existingPreview.querySelector("img").src = imageSrc;
  } else {
    // Create a new preview
    const previewContainer = document.getElementById("preview-images");
    const previewDiv = document.createElement("div");
    previewDiv.className = `preview-${colorName.replace(/\s+/g, '-')} text-center`;
    previewDiv.style.width = "150px";

    previewDiv.innerHTML = `
      <h6>${colorName}</h6>
      <img src="${imageSrc}" alt="${colorName}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;" />
    `;

    previewContainer.appendChild(previewDiv);
  }
}


          function updatePreviewName(inputElement, newName) {
    const oldName = inputElement.getAttribute("data-previous-name") || `Color ${colorIndex}`;
    const previewElement = document.querySelector(`#preview-images .preview-${CSS.escape(oldName)}`);

    if (previewElement) {
        previewElement.querySelector("h6").textContent = newName;
        previewElement.classList.replace(`preview-${CSS.escape(oldName)}`, `preview-${CSS.escape(newName)}`);
    }

    inputElement.setAttribute("data-previous-name", newName);
}



function removePreview(colorName) { 
  // Convert spaces to hyphens for class name 
  const formattedColorName = colorName.replace(/\s+/g, '-'); 
  const previewElement = document.querySelector(`#preview-images .preview-${formattedColorName}`);
   if (previewElement) {
     previewElement.remove(); }
 }

document.addEventListener("DOMContentLoaded", () => { // Attach change event listeners to dynamically added file inputs 
  document.querySelectorAll("input[type='file']").forEach(input => { input.addEventListener("change", handleFileChange); }); });
        </script>

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
