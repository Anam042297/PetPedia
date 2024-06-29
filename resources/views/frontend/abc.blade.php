

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Listing</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
.product-card {
border: 1px solid #ddd;
padding: 10px;
margin: 10px;
width: 200px;
}
</style>
</head>
<body>

<div class="container mt-5">
<div class="row">
<!-- Product 1 -->
<div class="col-md-4">
<div class="product-card">
<img src="path-to-your-product-image.jpg" alt="Product Name" class="product-image">
<h5 class="product-name">Product Name 1</h5>
<p class="product-price">$19.99</p>

<a href="#" class="btn btn-primary">Go somewhere</a>
</div>
</div>
<!-- Product 2 -->
<!-- Repeat the product card code for each product -->
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script> const products = [
    { name: 'Product 1', price: '$10.99', description: 'Description for product 1' },
    // ... other products
    ];

    // Function to create a product card
    function createProductCard(product) {
    const card = document.createElement('div');
    card.classList.add('product-card');

    const productName = document.createElement('h3');
    productName.textContent = product.name;

    const productPrice = document.createElement('p');
    productPrice.textContent = product.price;

    const productDescription = document.createElement('p');
    productDescription.textContent = product.description;

    card.appendChild(productName);
    card.appendChild(productPrice);
    card.appendChild(productDescription);

    return card;
    }

    // Function to render all product cards
    function renderProductCards() {
    const container = document.getElementById('product-container');
    products.forEach(product => {
    const card = createProductCard(product);
    container.appendChild(card);
    });
    }

    // Call the function to render cards
    renderProductCards();</script>
</body>
</html>



