<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Update Product</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="updatepro.css">

</head>

@auth
@if(!auth()->user()->is_admin)
<script>
    window.location = "/dashboard";
</script>
@endif
@endauth

@auth
@if(auth()->user()->is_admin)

<body id="blacklay">

    <div class="container">
        <h2>Update Product</h2>

        <div id="card">
            <div class="mb-3">
                <p class="text-danger">* Required fields</p>
                <label for="productId" class="">Product ID*</label>
                <input type="text" id="productId" placeholder="Enter Product ID" class="form-control">
            </div>

            <div class="mb-3">
                <label>
                    <input type="checkbox" id="kode_barangCheckbox" onclick="toggleInput('kode_barang')" class="form-label">
                    Update Kode Barang
                    <input type="text" id="kode_barangInput" class="form-control" disabled>
                </label>
            </div>

            <label>
                <input type="checkbox" id="nama_barangCheckbox" onclick="toggleInput('nama_barang')">
                Update Nama Barang
                <input type="text" id="nama_barangInput" class="form-control" disabled>
            </label>

            <label>
                <input type="checkbox" id="jumlah_barangCheckbox" onclick="toggleInput('jumlah_barang')">
                Update Jumlah Barang
                <input type="number" id="jumlah_barangInput" class="form-control" disabled>
            </label>

            <label>
                <input type="checkbox" id="satuan_barangCheckbox" onclick="toggleInput('satuan_barang')">
                Update Satuan Barang
                <input type="text" id="satuan_barangInput" class="form-control" disabled>
            </label>

            <label>
                <input type="checkbox" id="harga_beliCheckbox" onclick="toggleInput('harga_beli')">
                Update Harga Beli
                <input type="number" id="harga_beliInput" class="form-control" disabled>
            </label>

            <label>
                <input type="checkbox" id="status_barangCheckbox" onclick="toggleInput('status_barang')">
                Update Status Barang
                <input type="checkbox" id="status_barangInput" class="form-control" disabled>
            </label>

            <label>
                <input type="checkbox" id="user_idCheckbox" onclick="toggleInput('user_id')">
                Update User ID
                <input type="number" id="user_idInput" class="form-control" disabled>
            </label>

            <button onclick="updateProduct()" class="btn btn-primary" id="btn">Update Product</button>

            <a href="/getpro" class="btn btn-secondary" id="btn">Cancel</a>
        </div>
    </div>



    <script>
        function toggleInput(inputId) {
            const checkbox = document.getElementById(inputId + 'Checkbox');
            const inputField = document.getElementById(inputId + 'Input');

            inputField.disabled = !checkbox.checked;
        }



        async function updateProduct() {
            const productId = document.getElementById('productId').value;
            const kode_barang = document.getElementById('kode_barangCheckbox').checked ? document.getElementById('kode_barangInput').value : null;
            const nama_barang = document.getElementById('nama_barangCheckbox').checked ? document.getElementById('nama_barangInput').value : null;
            const jumlah_barang = document.getElementById('jumlah_barangCheckbox').checked ? document.getElementById('jumlah_barangInput').value : null;
            const satuan_barang = document.getElementById('satuan_barangCheckbox').checked ? document.getElementById('satuan_barangInput').value : null;
            const harga_beli = document.getElementById('harga_beliCheckbox').checked ? document.getElementById('harga_beliInput').value : null;
            const status_barang = document.getElementById('status_barangCheckbox').checked ? document.getElementById('status_barangInput').checked : null;
            const user_id = document.getElementById('user_idCheckbox').checked ? document.getElementById('user_idInput').value : null;

            const apiUrl = `http://127.0.0.1:8000/api/products/update/${productId}`;

            // Fetch the CSRF token from the meta tag in your HTML
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            const data = {
                _token: csrfToken
            }; // Include the CSRF token

            if (kode_barang !== null) {
                data.kode_barang = kode_barang;
            }

            if (nama_barang !== null) {
                data.nama_barang = nama_barang;
            }

            if (jumlah_barang !== null) {
                data.jumlah_barang = jumlah_barang;
            }

            if (satuan_barang !== null) {
                data.satuan_barang = satuan_barang;
            }

            if (harga_beli !== null) {
                data.harga_beli = harga_beli;
            }

            if (status_barang !== null) {
                data.status_barang = status_barang;
            }

            if (user_id !== null) {
                data.user_id = user_id;
            }

            try {
                const response = await fetch(apiUrl, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                console.log('Response Status:', response.status);

                if (response.ok) {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        const responseData = await response.json();
                        alert('Product updated successfully');
                    } else {
                        const text = await response.text();
                        alert('Product updated successfully. Response: ' + text);
                    }
                    // Redirect to inventory screen
                    window.location.href = '/getpro';
                } else {
                    const text = await response.text();
                    alert('Error: ' + text);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while updating the product.');
            }
        }
    </script>


    @endif
    @endauth


</body>

</html>
