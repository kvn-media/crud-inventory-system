<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    // Pagination for products

    // public function paginate 

    // Get all products

    public function index()
    {
        $products = Product::all();
        // $products = Product::paginate(4);
        // return view('getpro', compact('products'));
        if ($products->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => $products
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No products found'
            ], 404);
        }
    }


    // Get a single product

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No product found'
            ], 404);
        }
    }

    // Post a new product

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|max:20|unique:products',
            'jumlah_barang' => 'required|integer',
            'nama_barang' => 'required|max:50',
            'satuan_barang' => 'required|max:20',
            'harga_beli' => 'required|numeric',
            'status_barang' => 'required|boolean',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422, // Invalid data
                'errors' => $validator->messages()
            ], 422);
        } else {
            $product = Product::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'satuan_barang' => $request->satuan_barang,
                'harga_beli' => $request->harga_beli,
                'status_barang' => $request->status_barang,
                'user_id' => $request->user_id,
            ]);
        }

        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => 'Product created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Error creating product'
            ], 500);
        }
    }

    // Put a specific product

    public function update(Request $request, int $id)
    {
        // Only the admin can update the products
        if(!auth()->user()->is_admin){
            return response()->json([
                'status'=>403,
                'message'=>'You are not authorized to perform this action'
            ], 403);
        }
        else{
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'status' => 404,
                    'message' => "No product with ID $id found"
                ], 404);
            }
    
            // Get the data
            $requestData = $request->only([
                'kode_barang', 
                'jumlah_barang', 
                'nama_barang', 
                'satuan_barang',
                'harga_beli',
                'status_barang',
                'user_id'
            ]);
    
            // Define Validation rules based on the provided fields
            $validationRules =[];
            foreach ($requestData as $field => $value) {
                $validationRules[$field] = "required|max:200";
            }
    
            $validator = Validator::make($requestData, $validationRules);
    
            if($validator->fails()){
                return response()->json([
                    'status'=>422,
                    'message'=>$validator->messages()
                ], 422);
            }
    
            foreach ($requestData as $field => $value) {
                $product->$field = $value;
            }
    
            $product->save();
    
            return response()->json([
                'status'=>200,
                'message'=>'Product updated successfully',
                'Product'=> $product
            ], 200);
        }
        
    }

    // Delete a specific product

    public function destroy($id){

        // Only the admin can delete the products
        if(!auth()->user()->is_admin){
            return response()->json([
                'status'=>403,
                'message'=>'You are not authorized to perform this action'
            ], 403);
        }
        else {
            $product = Product::find($id);
        
            if ($product) {
                $kode_barang = $product->kode_barang;
                $nama_barang = $product->nama_barang;
        
                $product->delete();
        
                return response()->json([
                    'status' => 200,
                    'message' => "Product Kode Barang:$kode_barang & Nama Barang: $nama_barang is deleted successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Product with ID $id not found"
                ], 404);
            }
        }


        
    }


}
