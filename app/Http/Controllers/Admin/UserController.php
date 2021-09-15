<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    /**
     *  Disply user list and form view
     * 
     * @return \Illuminate\Http\Response
    */
    public function viewUsers(){

        return view('admin.user.user');
    }


    /**
     *  get user data and set with datatable
     *
     * @return \Illuminate\Http\Responce
     */
     public function getUserDataTable(Request $request)
     {
       
           $input = $request->all();
          
           $response = [];
           $code = 200;
   
           $take =15;

           $columns = [
               'id',
               'fullname',
               'email',
               'role'
           ];
           $orderBy = [
               'id',
               'fullname',
               'email'  ,
               'role'
           ];

           $users = User::select($columns);
           $total= $users->count("id");

           // search logic
           if(array_key_exists("search", $input) && isset($input["search"]))
           {
               $search = trim($input['search']['value']);
               $searchData = explode(' ', $search);

               $users->where(function ($where) use ($searchData){
                   foreach ($searchData as $query){
                       $where->orWhere("fullname", "like", "%" . $query . "%");
                       $where->orWhere("email", "like", "%" . $query . "%");
                       $where->orWhere("role", "like", "%" . $query . "%");
                   }
               });
           }

           // orderby logic
           if (isset($input["order"])) {

               $columnName = $orderBy[$input["order"][0]["column"]];
               $sortOrder = $input["order"][0]["dir"];
               $users = $users->orderBy($columnName, $sortOrder);
           }
           
           //fitered data and count
           $filteredTotal = $users->count("id");
           $users = $users->skip($input["start"])->take($take)->get();
           $userData = $users->toArray();

           //response    
           $data['data'] = $userData;
           $data['recordsTotal'] = $total;
           $data['recordsFiltered'] = $filteredTotal;

           return response()->json($data, $code);
     }
  
}
