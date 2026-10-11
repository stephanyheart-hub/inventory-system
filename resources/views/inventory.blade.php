<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f0ff;
            color: #302044;
        }

        header {
            background: #512783;
            color: white;
            padding: 25px 8%;
        }

        header h1 {
            margin: 0 0 8px;
        }

        header p {
            margin: 0;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .intro {
            background: #7042a0;
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000012;
            overflow-x: auto;
        }

        label {
            display: block;
            margin-top: 14px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #d5c4e8;
            border-radius: 6px;
        }

        button {
            border: none;
            padding: 10px 14px;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            margin: 3px;
        }

        .add {
            background: #67359a;
            width: 100%;
            margin-top: 18px;
        }

        .edit {
            background: #d17a19;
        }

        .delete {
            background: #c93657;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border-bottom: 1px solid #eadff5;
            padding: 12px 8px;
            text-align: left;
        }

        th {
            background: #eee3fa;
        }

        .message {
            padding: 12px;
            margin-bottom: 15px;
            background: #e1f7e6;
            color: #17652a;
            border-radius: 6px;
        }

        .error {
            color: #c93657;
            font-size: 14px;
        }

        @media (max-width: 700px) {
            .layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Product Inventory</h1>
        <p>Simple Inventory Management System</p>

        <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" 
              formnonvalidate
              
                style="background: #c93657; padding: 8px 12px; border-radius: 6px; color: white; border: none; cursor: pointer;">
                    Logout
        
            </button>
        </form>
    </header>

    <main class="container">
        <section class="intro">
            <h2>Welcome to Your Dashboard</h2>
            <p>Add, view, edit, and delete your products in one place.</p>
        </section>

        @if (session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="message" style="background:#ffe4e8;color:#a21b35;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="layout">
            <section class="card">
                <h2>Add Product</h2>

                <form action="{{ url('/products') }}" method="POST">
                    @csrf

                    <label for="name">Product Name</label>
                    <input id="name" type="text" name="name"
                           value="{{ old('name') }}" required>

                    <label for="price">Price (₱)</label>
                    <input id="price" type="number" name="price"
                           min="0" step="0.01"
                           value="{{ old('price') }}" required>

                    <label for="quantity">Quantity</label>
                    <input id="quantity" type="number" name="quantity"
                           min="0" value="{{ old('quantity') }}" required>

                    <button class="add" type="submit">Add Product</button>
                </form>
            </section>

            <section class="card">
                <h2>Registered Products</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>₱{{ number_format((float) $product->price, 2) }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <form
                                        id="product-form-{{ $product->id }}"
                                        action="{{ url('/products/edit/' . $product->id) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <input type="hidden" name="name"
                                               value="{{ $product->name }}">

                                        <input type="hidden" name="price"
                                               value="{{ $product->price }}">

                                        <input type="hidden" name="quantity"
                                               value="{{ $product->quantity }}">

                                        <button type="button" class="edit"
                                            onclick="editProduct({{ $product->id }})">
                                            Edit
                                        </button>

                                        <button type="submit" class="delete"
                                            formaction="{{ url('/products/delete/' . $product->id) }}"
                                            onclick="return confirm('Delete this product?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No products yet. Add your first product!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </div>
    </main>

    <script>
        function editProduct(id) {
            const form = document.getElementById('product-form-' + id);

            const name = prompt(
                'Enter product name:',
                form.querySelector('[name="name"]').value
            );

            if (name === null || name.trim() === '') return;

            const price = prompt(
                'Enter product price:',
                form.querySelector('[name="price"]').value
            );

            if (price === null || price.trim() === '' ||
                !Number.isFinite(Number(price)) || Number(price) < 0) {
                alert('Please enter a valid price.');
                return;
            }

            const quantity = prompt(
                'Enter quantity:',
                form.querySelector('[name="quantity"]').value
            );

            if (quantity === null || quantity.trim() === '' ||
                !Number.isInteger(Number(quantity)) || Number(quantity) < 0) {
                alert('Please enter a valid whole-number quantity.');
                return;
            }

            form.querySelector('[name="name"]').value = name.trim();
            form.querySelector('[name="price"]').value = price;
            form.querySelector('[name="quantity"]').value = quantity;
            form.requestSubmit();
        }
    </script>
</body>
</html>
