<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    function user(){
        $users = UserModel::latest()->get();
        return view('backend.user.user',compact('users'));
    }

    function add_user(Request $request){
        $manager = new ImageManager(new Driver());

        $request->validate([
            'name'=>'required',
            'phone'=>'required|regex:/(01)[0-9]{9}/|max:14',
            'email'=>'required|email',
            'address'=>'required',
            'nid'=>'required|min:10|max:10',
            'dob'=>'required',
        ]);


        

        if($request->photo == ''){
            UserModel::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'nid'=>$request->nid,
                'dob'=>$request->dob,
                'password'=>bcrypt('12345'),
            ]); 
        }
        else{
            $name = str_replace(' ', '', $request->name);
            $photo_extension = $request->photo->extension();
            $photo_name = $name.'_'. random_int('00','99') .'.'. $photo_extension;
            $photo = $manager->read($request->photo);
            $photo->save(public_path('uploads/user/'.$photo_name));

            UserModel::create([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->address,
                'nid'=>$request->nid,
                'dob'=>$request->dob,
                'password'=>bcrypt('12345'),
                'photo'=> $photo_name,
            ]); 


        }

        return back()->with('created', 'New User Created Successfully');
        
    }

    function user_delete($id){
        $user = UserModel::find($id);

        if($user->photo != null){
            unlink(public_path('uploads/user/'.$user->photo));
            UserModel::find($id)->delete();
        }
        else{
            UserModel::find($id)->delete();
            
        }
        return back()->with('delete', 'User Deleted Successfully');
    }


    function user_info($id){
        $user = UserModel::find($id);
        return view('backend.user.user_info',[
            'user'=>$user,
        ]);
    }
}
