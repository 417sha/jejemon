// Function to handle image preview without affecting the design
function previewImages(event) {
    const files = event.target.files;
    const imageBoxes = document.querySelectorAll('.image-box');
  
    // Clear existing images from the boxes
    imageBoxes.forEach((box) => (box.innerHTML = ''));
  
    // Loop through each file and display it
    Array.from(files).forEach((file, index) => {
      if (index < imageBoxes.length) {
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = document.createElement('img');
          img.src = e.target.result;
          img.classList.add('img-fluid');
          img.style.maxWidth = '100%';
          imageBoxes[index].appendChild(img);
        };
        reader.readAsDataURL(file);
      }
    });
  }
  
  
  // Product List
    document.addEventListener("DOMContentLoaded", () => {
      // Handle Edit Button Click
      document.querySelectorAll(".btn-success").forEach((editBtn) => {
        editBtn.addEventListener("click", (e) => {
          const row = e.target.closest("tr");
          const product = row.children[0].textContent;
          const productId = row.children[1].textContent;
          alert(`Editing Product: ${product} (ID: ${productId})`);
          // Add your edit logic here (e.g., open a modal or inline editing)
        });
      });
  
      // Handle Delete Button Click
      document.querySelectorAll(".btn-danger").forEach((deleteBtn) => {
        deleteBtn.addEventListener("click", (e) => {
          const row = e.target.closest("tr");
          const product = row.children[0].textContent;
          if (confirm(`Are you sure you want to delete ${product}?`)) {
            row.remove(); // Removes the row from the table
          }
        });
      });
    });