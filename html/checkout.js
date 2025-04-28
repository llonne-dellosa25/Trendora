  function renderCheckoutItems() {
    // Get cart data from localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const checkoutItemsContainer = document.getElementById('checkoutProductsContainer');
    checkoutItemsContainer.innerHTML = ''; // Clear previous content

    // If cart is empty, notify the user
    if (cart.length === 0) {
      checkoutItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
      return; // Stop execution if the cart is empty
    }

    let subtotal = 0;

    // Loop through cart and render items
    cart.forEach(item => {
      const totalPrice = item.price * item.quantity;
      subtotal += totalPrice;

      const row = document.createElement('div');
      row.classList.add('checkout-item');
      row.innerHTML = `
        <div class="product-image">
          <img src="${item.image}" alt="${item.name}" />
        </div>
        <p>${item.name}</p>
        <div class="flex justify-between">
          <span>₱${item.price}</span>
          <span>x${item.quantity}</span>
          <span>₱${totalPrice.toFixed(2)}</span>
        </div>
      `;

      checkoutItemsContainer.appendChild(row);
    });

    // Update the totals
    updateCheckoutTotal(subtotal);
  }

  function updateCheckoutTotal(subtotal) {
    const shipping = 30; // Fixed shipping cost
    const discount = 0; // Example, you can calculate discounts if needed
    const total = subtotal + shipping - discount;

    // Update the subtotal and total in the checkout summary
    document.getElementById('subtotal').innerText = `₱${subtotal.toFixed(2)}`;
    document.getElementById('total').innerText = `₱${total.toFixed(2)}`;
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Render cart items once DOM is loaded
    renderCheckoutItems();
  
    // Handle checkout button click (clear the cart after checkout)
    document.querySelector('.checkout-btn').addEventListener('click', function () {
      // Checkout logic here, e.g., form submission or payment process
      localStorage.removeItem('cart'); // Optionally clear the cart after checkout
    });
  });
  
  function renderCheckoutItems() {
    // Get cart data from localStorage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const checkoutItemsContainer = document.getElementById('checkoutProductsContainer');
    checkoutItemsContainer.innerHTML = ''; // Clear previous content
  
    // If cart is empty, notify the user
    if (cart.length === 0) {
      checkoutItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
      updateCheckoutTotal(0); // Ensure totals show zero when cart is empty
      return; // Stop execution if the cart is empty
    }
  
    let subtotal = 0;
  
    // Loop through cart and render items
    cart.forEach(item => {
      const totalPrice = item.price * item.quantity;
      subtotal += totalPrice;
  
      const row = document.createElement('div');
      row.classList.add('checkout-item');
      row.innerHTML = `
        <div class="product-image">
          <img src="${item.image}" alt="${item.name}" />
        </div>
        <p>${item.name}</p>
        <div class="flex justify-between">
          <span>₱${item.price}</span>
          <span>x${item.quantity}</span>
          <span>₱${totalPrice.toFixed(2)}</span>
        </div>
      `;
  
      checkoutItemsContainer.appendChild(row);
    });
  
    // Update the totals after rendering the items
    updateCheckoutTotal(subtotal);
  }
  
  function updateCheckoutTotal(subtotal) {
    const shipping = 30; // Fixed shipping cost
    const discount = 0; // Example, you can calculate discounts if needed
    const total = subtotal + shipping - discount;
  
    // Update the subtotal and total in the checkout summary
    document.getElementById('subtotal').innerText = `₱${subtotal.toFixed(2)}`;
    document.getElementById('total').innerText = `₱${total.toFixed(2)}`;
  }
  
  // If cart is empty on page load, remove cart from localStorage and show the empty message
  (function checkEmptyCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length === 0) {
      localStorage.removeItem('cart'); // Clear the cart from localStorage
      document.getElementById('checkoutProductsContainer').innerHTML = '<p>Your cart is empty.</p>';
    }
  })();
  

  // Example: Clearing cart when user completes checkout (you can adjust this for the actual checkout process)
  document.querySelector('.checkout-btn').addEventListener('click', function () {
    // Add your checkout logic here (e.g., form submission or final payment process)

    // Optionally, clear the cart once checkout is complete
    localStorage.removeItem('cart');
  });

  document.getElementById('checkoutButton').addEventListener('click', function () {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    console.log(cart); // Proceed with checkout logic
  });
