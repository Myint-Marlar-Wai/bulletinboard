<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use App\Models\Post;
use Auth;
use Hash;

class UserController extends Controller
{

    /**
     * Users List
     */
    public function index()
    {   
        $countPerPage = config('constants.paginate_per_page');
        $users = User::sortable()->paginate($countPerPage);
        return view('users/index', compact('users'),['name'=> 'Users List']);
    }

    /**
     * User Creation
     */
    public function create()
    {
        return view('users/create',['name'=> 'Create User Form']);
    }

    /**
     * User Confirmation
     */
    public function confirm(UserCreateRequest $request)
    {   

        $validatedData = $request->validated();

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $path =('image/');
            $file_name = time() . "." . $profile->getClientOriginalName();
            $profile->move($path, $file_name);
        }

        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'type' => $request->type,
            'dob' => $request->dob,
            'address' => $request->address,
            'profile' => $file_name,
          ];

        return view('users.confirm', compact('user'));

    }

    /**
     * User Data Store
     */
    public function store(Request $request)
    {   
        
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $path =('image/');
            $file_name = time() . "." . $profile->getClientOriginalName();
            $profile->move($path, $file_name);
        }
        $user = new User();
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile =  $request->profile;
        $user->type = $request->type;
        $user->phone = $request->phone;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->create_user_id = Auth::user()->name;
        
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Edit User Data
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users/edit', ['name'=> 'Edit User Data'], compact('user'));
    }


    /**
     * Update User Confirmation
     */
    public function updateConfirm(Request $request,User $user)
    {    
      
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'type' => 'required',
        ]);

        if ($request->file('profile')) {
            $profile = $request->file('profile');
            $path =('image/');
            $file_name = time() . "." . $profile->getClientOriginalName();
            $profile->move($path, $file_name);
            $profile_name = $file_name; 
        }
        
        $user = [
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'dob' => $request->dob,
            'address' => $request->address,
            'profile' => $profile_name,
            'updated_user_id' => $request->updated_user_id,
        ];
        
        return view('users/update_confirm', compact('user'));
    }


    /**
     * User Data Update Store
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'profile' => 'required',
            'type' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required|max:255',
            'dob' => 'required',
            'updated_user_id' => 'required'
        ]);


           User::whereId($id)->update($validatedData);
           return redirect()->route('user.index'); 
    }

    /**
     * User Profile
     */
    public function show()
    {
        return view('users/index');
    }

    /**
     * User Profile
     */
    public function userProfile($id)
    {
        $user = User::findOrFail($id);

        return view('users/user_profile', ['name'=> 'User Profile'], compact('user'));
    }

    /**
     * Display Password Change Screen
     */
    public function passwordScreen($id)
    {
        $user = User::findOrFail($id);

        return view('users/change_password',['name'=> 'Change Password'], compact('user'));
    }

    /**
     * Change Password Process
     */
    public function changePassword(Request $request)
    {
        $request->validate([
          'current_password' => 'required',
          'password' => 'required|min:8|confirmed',
          'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password successfully changed!');
    }

    /**
     * Search Function
     */
    public function search()
    {   
        $countPerPage = config('constants.paginate_per_page');
        $search_name = $_GET['name'];
        $search_email = $_GET['email'];
        $users = User::where("name","LIKE","%{$search_name}%")
                      ->Where("email","LIKE","%{$search_email}%")
                      ->paginate($countPerPage);

        return view('users/search',compact('users'));
    }

    /**
     * Delete Action
     */
    public function destroy(Request $request, User $user)
    {   
        $delete = $user->delete();
        if ($delete){
            $user->deleted_user_id = Auth::user()->id;
            $user->save();
          }
        return redirect()->route('user.index')->with('success', 'User has been Deleted');
    }
}
