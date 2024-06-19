<!-- resources/views/dashboard.blade.php -->

@extends('layouts.product')

@section('title', 'Dashboard')

@section('content')
    <section id="dashboard" class="container">
        <h2>Gerenciar Produtos</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <button type="button" class="btn" onclick="showAddProductModal()">Adicionar Produto</button><br><br>

        <div class="product-list">
            @foreach ($products as $product)
                <div class="product-item">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    <div class="product-details">
                        <h3>{{ $product->name }}</h3>
                        <p>{{ $product->description }}</p>
                        <p>Preço: R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                        <button class="btn" onclick="showEditProductModal({{ $product->id }})">Editar</button>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn remove">Remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Add Product Modal -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddProductModal()">&times;</span>
            <h2>Adicionar Produto</h2>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <label for="name">Nome do Produto</label>
                <input type="text" id="name" name="name" required>

                <label for="description">Descrição</label>
                <textarea id="description" name="description" required></textarea>

                <label for="price">Preço</label>
                <input type="number" id="price" name="price" step="0.01" required>

                <label for="image">URL da Imagem</label>
                <input type="text" id="image" name="image" required>

                <button type="submit" class="btn">Adicionar</button>
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditProductModal()">&times;</span>
            <h2>Editar Produto</h2>
            <form id="editProductForm" action="#" method="POST">
                @csrf
                @method('PUT')
                <label for="edit-name">Nome do Produto</label>
                <input type="text" id="edit-name" name="name" required>

                <label for="edit-description">Descrição</label>
                <textarea id="edit-description" name="description" required></textarea>

                <label for="edit-price">Preço</label>
                <input type="number" id="edit-price" name="price" step="0.01" required>

                <label for="edit-image">URL da Imagem</label>
                <input type="text" id="edit-image" name="image" required>

                <button type="submit" class="btn">Atualizar</button>
            </form>
        </div>
    </div>

    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-item {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 300px;
        }

        .product-item img {
            width: 100%;
            height: auto;
        }

        .product-details {
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }

        .btn.remove {
            background-color: #e3342f;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 400px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <script>
        function showAddProductModal() {
            document.getElementById('addProductModal').style.display = 'block';
        }

        function closeAddProductModal() {
            document.getElementById('addProductModal').style.display = 'none';
        }

        function showEditProductModal(productId) {
            // Fetch product details and populate the form
            fetch(`/products/${productId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-name').value = data.name;
                    document.getElementById('edit-description').value = data.description;
                    document.getElementById('edit-price').value = data.price;
                    document.getElementById('edit-image').value = data.image;
                    document.getElementById('editProductForm').action = `/products/${productId}`;
                    document.getElementById('editProductModal').style.display = 'block';
                });
        }

        function closeEditProductModal() {
            document.getElementById('editProductModal').style.display = 'none';
        }
    </script>
@endsection
