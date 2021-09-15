<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Validation\Rule;
use App\SubCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 
       
        return view('admin.category.index');
    }

    public function getCategoryList(Request $request){
       
            $input = $request->all();
            $response = [];
            $code = 200;
    
            $take =15;
 
            $columns = [
                'id',
                'name',
                'image'
            ];
            $orderBy = [
                'id',
                'name',
                'image'
            ];
 
            $categorys = Category::select($columns)->with(['subCategories']);
            $total= $categorys->count("id");
 
            // search logic
            if(array_key_exists("search", $input) && isset($input["search"]))
            {
                $search = trim($input['search']['value']);
                $searchData = explode(' ', $search);
 
                $categorys->where(function ($where) use ($searchData){
                    foreach ($searchData as $query){
                        $where->orWhere("name", "like", "%" . $query . "%");
                    }
                });
            }
 
            // orderby logic
            if (isset($input["order"])) {
 
                $columnName = $orderBy[$input["order"][0]["column"]];
                $sortOrder = $input["order"][0]["dir"];
                $categorys = $categorys->orderBy($columnName, $sortOrder);
            }
            
            //fitered data and count
            $filteredTotal = $categorys->count("id");
            $categorys = $categorys->skip($input["start"])->take($take)->get();
            $categorysData = $categorys->toArray();
 
            //response    
            $data['data'] = $categorysData;
            $data['recordsTotal'] = $total;
            $data['recordsFiltered'] = $filteredTotal;
 
            return response()->json($data, $code);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
              'name'          => [
                  'required',
                  'unique:categories,name,NULL,id',
              ]
          ]
      );
       
        $input=$request->all();
        if ($files = $request->file('image')) {
            $destinationPath = 'public/image/category'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $category=Category::create($input);

        // sub category 
        if( isset($input['sub-category-name']) && count($input['sub-category-name'])  ){
            foreach ($input['sub-category-name'] as $key => $value) {
                SubCategory::create([
                    'category_id'=>$category->id,
                    'name'=>$value
                ]);
            }
        }

        return redirect()->route('category.index')->with('success','Category created successfully.');
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
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
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
        $category=Category::find($id);
        $validateReq = [
            'name'          => [
                'string',
                'required',
                Rule::unique('categories')->where(function ($query) use ($category) {
                    return $query->where('id',"!=",$category->id);
                })
            ],
            'image' => 'image|dimensions:min_width=150,min_height=150,max_width=600,max_height=600'
        ];
        $this->validate($request, $validateReq);
    
 
       
        if ($files = $request->file('image')) {
            $destinationPath = 'public/image/category'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $category->update($input);
        $category=Category::find($id);
         // sub category 
         if( isset($input['sub-category-name']) && count($input['sub-category-name'])  ){
            SubCategory::where('category_id','=',$category->id)->delete();
            foreach ($input['sub-category-name'] as $key => $value) {
                SubCategory::create([
                    'category_id'=>$category->id,
                    'name'=>$value
                ]);
            }
        }
        return redirect()->route('category.index')->with('success','Category Updated successfully.');
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
    public function deleteCategory(Request $request)
    {
        $response = [];
        $code = 500;

        //find record
        $category = Category::find($request->id)->delete();

        if ($category) {
           
            $response=[
               'message' => "Category Has Been Deleted Successfully."
            ];

        }else{
            $response=[
                'message' => "Category Record Not Found..!!!"
            ];
        }
        return $response ;
    }
}
