//product
document
    .getElementById("search-products")
    .addEventListener("keyup", function (event) {
        let query = this.value;

        if (query.length > 2) {
            // Trigger search after 3 characters
            fetch("{{ route('search.products') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    query: query,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    let results = "";

                    // Show suggestions
                    if (data.length > 0) {
                        data.forEach((product) => {
                            results += `
                    <div class="suggestion-item">
                        <p>
                            <strong>${product.product_name}</strong> - ${product.regular_price} USD
                        </p>
                    </div>
                `;
                        });
                    } else {
                        results = "<p>No products found.</p>";
                    }

                    // Display the suggestions in the container
                    document.getElementById("product-results").innerHTML =
                        results;
                    document.getElementById("product-results").style.display =
                        "block"; // Show results
                });
        } else {
            document.getElementById("product-results").innerHTML = ""; // Clear suggestions if less than 3 characters
            document.getElementById("product-results").style.display = "none"; // Hide results
        }
    });

//brand
document
    .getElementById("search-brands")
    .addEventListener("keyup", function (event) {
        let query = this.value;

        if (query.length > 2) {
            fetch("{{ route('search.brands') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    query: query,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    let resultsDiv = document.getElementById("brand-results");
                    resultsDiv.innerHTML = "";

                    if (data.length > 0) {
                        data.forEach((brand) => {
                            let resultItem = `
                                <div class="result-item" style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    <strong>${brand.brand_name}</strong><br>
                                    <span>${brand.describe}</span>
                                </div>
                            `;
                            resultsDiv.innerHTML += resultItem;
                        });
                        resultsDiv.style.display = "block";
                    } else {
                        resultsDiv.innerHTML = "<div>No brands found.</div>";
                        resultsDiv.style.display = "block";
                    }
                });
        } else {
            document.getElementById("brand-results").style.display = "none";
        }
    });

//category
document
    .getElementById("search-products")
    .addEventListener("keyup", function (event) {
        let query = this.value;

        if (query.length > 2) {
            // Trigger search after 3 characters
            fetch("{{ route('search.categories') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    query: query,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    let results = "";

                    // Show suggestions
                    if (data.length > 0) {
                        data.forEach((category) => {
                            results += `
                        <div class="suggestion-item">
                            <p>
                                <strong>${category.category_name}</strong> - ${category.products.length} Products
                            </p>
                        </div>
                    `;
                        });
                    } else {
                        results = "<p>No categories found.</p>";
                    }

                    // Display the suggestions in the container
                    document.getElementById("category-results").innerHTML =
                        results;
                    document.getElementById("category-results").style.display =
                        "block"; // Show results
                });
        } else {
            document.getElementById("category-results").innerHTML = ""; // Clear suggestions if less than 3 characters
            document.getElementById("category-results").style.display = "none"; // Hide results
        }
    });

//order
document
    .getElementById("search-orders")
    .addEventListener("keyup", function (event) {
        let query = this.value;

        if (query.length > 2) {
            // Trigger search after 3 characters
            fetch("{{ route('search.orders') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    query: query,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    let results = "";

                    // Show suggestions
                    if (data.length > 0) {
                        data.forEach((order) => {
                            results += `
                  <div class="suggestion-item">
                        <p>
                            <strong>${order.order_code}</strong> - ${order.user.name} - ${order.payment_method} - ${order.status} - ${order.total_price}
                        </p>
                    </div>
                `;
                        });
                    } else {
                        results = "<p>No orders found.</p>";
                    }

                    // Display the suggestions in the container
                    document.getElementById("product-results").innerHTML =
                        results;
                    document.getElementById("product-results").style.display =
                        "block"; // Show results
                });
        } else {
            document.getElementById("product-results").innerHTML = ""; // Clear suggestions if less than 3 characters
            document.getElementById("product-results").style.display = "none"; // Hide results
        }
    });

//user
document
    .getElementById("search-users")
    .addEventListener("keyup", function (event) {
        let query = this.value;

        if (query.length > 2) {
            // Trigger search after 3 characters
            fetch("{{ route('search.users') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({
                    query: query,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    let results = "";

                    // Show suggestions
                    if (data.length > 0) {
                        data.forEach((user) => {
                            results += `
                            <div class="suggestion-item">
                                <p>
                                    <strong>${user.name}</strong> - ${user.email} - ${user.phone_number}
                                </p>
                            </div>
                        `;
                        });
                    } else {
                        results = "<p>No users found.</p>";
                    }

                    // Display the suggestions in the container
                    document.getElementById("user-results").innerHTML = results;
                    document.getElementById("user-results").style.display =
                        "block"; // Show results
                });
        } else {
            document.getElementById("user-results").innerHTML = ""; // Clear suggestions if less than 3 characters
            document.getElementById("user-results").style.display = "none"; // Hide results
        }
    });
