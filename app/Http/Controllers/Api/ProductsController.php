<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
	private $product;

	public function __construct(Product $product)
	{
		$this->product = $product;
	}

	//retorna uma lista com todos os produtos cadastrados
    public function index()
    {
    	
    	//return Product::all();

    	//$data = ['data'=> $this->product->all()];
    	$data = ['data'=>$this->product->paginate(4)];
    	return response()->json($data);
    }

    //retorna um produto pelo id
    public function show(Product $id)
    {

    	//return $id;

    	$product = $this->product->find($id);
    	if(! $product) return response()->json(ApiError::errorMessage('Produto não encontrado!', 4040), 404);
    	$data = ['data' => $product];
	    return response()->json($data);
    }

    //Inserção de um produto
    public function store(Request $request)
    {
    	try{
    	$productData = $request->all(); 
    	$this->product->create($productData);

    	return response()->json(['msg'=>'Produto criado com sucesso!',201]);

    	}catch(\Execption $e){

    	   if(config('app.debug')){

    	   	return response()->json(apierror::errorMessage($e->getMessage(),1010));

    		}
    			return response()->json(apierror::errorMessage("Ocorreu um erro!",1010));
  		  }

  	  }
  	public function update(Request $request, $id)
	{
		try {
			$productData = $request->all();
			$product     = $this->product->find($id);
			$product->update($productData);
			$return = ['data' => ['msg' => 'Produto atualizado com sucesso!']];
			return response()->json($return, 201);
		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011), 500);
		}
	}

	public function delete(Product $id){

		try{
			$id->delete();
			$return = response()->json(['data' => ['msg' => 'Produto ' . $id->name . ' deletado com sucesso!']],200);
		
		}catch(\Exception $e){
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011),  500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao realizar operação de atualizar', 1011), 500);
		}

		}
}
