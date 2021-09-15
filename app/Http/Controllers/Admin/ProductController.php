<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Validation\Rule;
use App\Mail\NewProductMail;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index');
    }

    public function getProductList(Request $request){
       
        $input = $request->all();
        $response = [];
        $code = 200;

        $take =15;

        $columns = [
            'products.id',
            'categories.name as category_name',
            'products.name as product_name',
            'products.description',
            'products.image'
        ];
        $orderBy = [
            'id',
            'category_name',
            'product_name',
            'description',
            'image'
        ];

        $products = Product::select($columns)
                            ->join('categories','categories.id','=','products.category_id');
        $total= $products->count("products.id");

        // search logic
        if(array_key_exists("search", $input) && isset($input["search"]))
        {
            $search = trim($input['search']['value']);
            $searchData = explode(' ', $search);

            $products->where(function ($where) use ($searchData){
                foreach ($searchData as $query){
                    $where->orWhere("categories.name", "like", "%" . $query . "%");
                    $where->orWhere("products.name", "like", "%" . $query . "%");
                    $where->orWhere("products.description", "like", "%" . $query . "%");
                }
            });
        }

        // orderby logic
        if (isset($input["order"])) {

            $columnName = $orderBy[$input["order"][0]["column"]];
            $sortOrder = $input["order"][0]["dir"];
            $categorys = $products->orderBy($columnName, $sortOrder);
        }
        
        //fitered data and count
        $filteredTotal = $products->count("products.id");
        $products = $products->skip($input["start"])->take($take)->get();
        $productsData = $products->toArray();

        //response    
        $data['data'] = $productsData;
        $data['recordsTotal'] = $total;
        $data['recordsFiltered'] = $filteredTotal;

        return response()->json($data, $code);
    }

    public function deleteProduct(Request $request){
        $response = [];
        $code = 500;

        //find record
        $product = Product::find($request->id)->delete();

        if ($product) {
           
            $response=[
               'message' => "Product Has Been Deleted Successfully."
            ];

        }else{
            $response=[
                'message' => "Product Record Not Found..!!!"
            ];
        }
        return $response ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::orderBy('name')->get();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validation
        $this->validate($request, 
            [
                'image'         => [
                    'required','image','mimes:jpeg,png,jpg','max:2048','dimensions:min_width=150,min_height=150,max_width=600,max_height=600'
                ],
                'description'         => [
                    'required'
                ],
                'name'          => [
                    'required',
                    'unique:products,name,NULL,id,category_id,'.$request->category_id.'',
                ]
            ]
        );

        $input=$request->all();
        if ($files = $request->file('image')) {
            $destinationPath = 'public/image/product'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $product = Product::create($input);

        // $product = Product::orderBy('id','desc')->first();

        // send mail to super admin
        Mail::to('applocumadmin@yopmail.com')
             ->send(new NewProductMail($product));

        return redirect()->route('products.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product= Product::find($id);
        $categories=Category::orderBy('name')->get();
        return view('admin.product.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input=$request->all();
        $product=Product::find($id);
        $validateReq = [
            'name'          => [
                'string',
                'required',
                Rule::unique('products')->where(function ($query) use ($product) {
                    return $query->where('id',"!=",$product->id);
                })
            ],
            // 'image' => 'image|dimensions:min_width=150,min_height=150,max_width=600,max_height=600'
        ];
        $this->validate($request, $validateReq);
       
        if ($files = $request->file('image')) {
            $destinationPath = 'public/image/category'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $product->update($input);
        return redirect()->route('products.index')->with('success','Product Updated successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
