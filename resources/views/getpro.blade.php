<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="getpro.css">
  <title>Inventory Management System</title>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
</head>

<body>

<div class="container">

<h2 id="headingfir">View Inventory Product</h2>
  <header>
    
  <hr>
    <nav>
      <ul>
        <li>
          <button>
          <a href="/createpro">
              Create Product
            </a>
          </button>
        </li>

        @auth
       @if(auth()->user()->is_admin)
        <li>
          <button>
          <a href="/updatepro">
              Update Product
            </a>
          </button>
        </li>

        <li>
          <button>
          <a href="/deletepro">
              Delete Product
            </a>
          </button>
        </li>
      @endif
      @endauth
  
        <li>
          <button>
          <a href="/dashboard">
              Dashboard
            </a>
          </button>
        </li>
      </ul>
    </nav>
    <hr>
  </header>

  <section>
    <h2>Product Inventory Table</h2>
    <table id="inventoryTable">
      <thead>
        <tr>
          <th scope="col">ID Barang</th>
          <th scope="col" style="width: 6%;">Kode Barang</th>
          <th scope="col" style="width: 6%;">Nama Barang</th>
          <th scope="col" style="width: 10%;">Jumlah Barang</th>
          <th scope="col">Satuan Barang</th>
          <th scope="col" style="width: 10%;">Harga Beli</th>
          <th scope="col" style="width: 10%;">Status Barang</th>
          <th scope="col" style="width: 10%;">User ID</th>
          <th scope="col" style="width: 10%;">Created At</th>
          <th scope="col" style="width: 10%;">Updated At</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>{{ $product['id_barang'] }} </td>
          <td>{{ $product['kode_barang'] }} </td>
          <td>{{ $product['nama_barang'] }} </td>
          <td>{{ $product['jumlah_barang'] }} </td>
          <td>{{ $product['satuan_barang'] }} </td>
          <td>{{ $product['harga_beli'] }} </td>
          <td>{{ $product['status_barang'] ? 'Aktif' : 'Nonaktif' }} </td>
          <td>{{ $product['user_id'] }} </td>
          <td> {{ $product['created_at'] }} </td>
          <td> {{ $product['updated_at'] }} </td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </section>

<span  id="pag">
{{ $products->links() }}
</span>

</div>

</body>

</html>
