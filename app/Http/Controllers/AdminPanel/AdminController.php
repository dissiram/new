<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function index (){
        return view('admin.dashboard');
    }


    public function getCustomer()
    {
        $data = User::where('role', 'customer')->get();
        $showForm = false; 
        return view('admin.customer.customer', compact('data', 'showForm'));
    }


    public function editCustomer($id)
    {
        $data= User::find($id);
        $showForm = true;
        return view("admin.customer.customer", compact('data','showForm'));
    }


    public function deleteCustomer($id)
    {
     $data=user::find($id);
     $data->delete();  
     Alert::success('Success','Client supprimé avec succès !');
     return redirect()->back(); 
    }


    public function updateCustomer(Request $request, $id){
        
        $data=user::find($id);

        $data->name=$request->input('nom');
        $data->email=$request->input('email');
        $data->status = $request->input('status');
        $data->role=$request->input('role');

        $data->save();

        $showForm = false;

        return redirect()->route('admin.customer'); 
    }


}
