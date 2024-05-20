<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Product</title>
    <!-- bootstrap cdn -->
    <link rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>

      <link rel="stylesheet" href="createpro.css">
    
</head>
<body>

<div class="container">
<h2 id="headingfir">Create Product</h2>
<div class="mb-3">


   <div id="proForm">
   <form id="productForm" action="http://127.0.0.1:8000/api/products" method="POST">
 
          
          @csrf
        <p class="text-danger">* Required fields</p>
      <label for="kode_barang">Kode Barang:*</label>
      <input type="text" id="kode_barang" name="kode_barang" required>

      <label for="nama_barang">Nama Barang:*</label>
      <input type="text" id="nama_barang" name="nama_barang" required>

      <label for="jumlah_barang">Jumlah Barang:*</label>
      <input type="number" id="jumlah_barang" name="jumlah_barang" required>

      <label for="satuan_barang">Satuan Barang:*</label>
      <input type="text" id="satuan_barang" name="satuan_barang" required>

      <label for="harga_beli">Harga Beli:*</label>
      <input type="number" id="harga_beli" name="harga_beli" required>

      <label class="checkbox-label" for="status_barang">Status Barang:*</label>
      <input type="checkbox" id="status_barang" name="status_barang">

      <label for="user_id">User ID:*</label>
      <input type="number" id="user_id" name="user_id" required>

      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="getpro" class="btn btn-secondary">Cancel</a>
  </form>
   </div>
</div> 
</div> 




<script>
    document.getElementById('productForm').addEventListener('submit', async function (event) {
        event.preventDefault();

        const apiUrl = 'http://127.0.0.1:8000/api/products';
        const formElement = document.getElementById('productForm');

        try {
            

            const formData = new FormData(formElement);
            const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData,  // Pass the form element to FormData
        });

            if (response.ok) {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    const responseData = await response.json();          
                } else {
                    const text = await response.text();
                }

                alert('Product added successfully. Redirecting to the Inventory...');
                window.location.href = '/getpro';
            } else {
                const text = await response.text();
                alert('Error: ' + text);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while adding the product.');
        }
    });
</script>

   

</body>
</html>
