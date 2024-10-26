<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use App\Http\Controllers\UserController;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Session;

class UsersModel extends Model
{
    use HasFactory;

    public function viewAllUser()
    {
        $users = DB::table('information')->where('is_deleted', 0)->get();
        return $users;
    }

    public function services()
    {
        $category = DB::table('service')->where('parent_id', 0)->get();
        return $category;
    }

    public function more($id)
    {
        $name = DB::table('service')->where('parent_id', $id)->get();

        return $name;
    }

    public function selectedService($id)
    {
        $infoServices = DB::table('service')->where('id', $id)->first();

        return $infoServices;
    }

    public function receipt($request)
    {
        $users = DB::table('receipt')
            ->leftJoin('employee', 'receipt.employee_id', '=', 'employee.id')
            ->leftJoin('service', 'receipt.service_id', '=', 'service.id')
            ->where('receipt.service_id', $request)
            ->select('service.id','service.parent_id','service.service_name','receipt.id','employee.first_name','employee.last_name','employee.phone_number','employee.address')
            ->get();

//        dd($users);
        return $users;
    }

    public function insert($request, $fileName)
    {
        $data = array(
            'name' => $request->input('name'),
            'last_name' => $request->input('lastname'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
//            'admin_id'=>$request->input('admin_id'),
            'create_time' => Carbon::now()->timestamp,
            'pic' => $fileName,
            'birth_date' => $request->input('birth_date')
        );
        DB::table('information')->insert($data);
        return redirect('home');
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = Carbon::createFromFormat('m/d/Y',$value)->format('Y-m-d');
    }

    public function updateUserView(Request $id)
    {
        $updateUserView = DB::table('information')->where('id', $id)->get();
        dd($updateUserView);
    }

    public function updateUser($request, $fileName)
    {
        $updateUser = DB::table('information')->where('id', $request->id)->update([
            'name' => $request->name,
            'last_name' => $request->lastname,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'description' => $request->description,
            'pic' => $fileName,
            'update_time' => Carbon::now()->timestamp]);
        return true;
    }

    public function infoUser(Request $request)
    {
        DB::table('information')->where('id', $request)->first();
    }



    public function getUser($id)
    {
        $user = DB::table('information')->where('id', $id)->first();
        return $user;
    }

    public function render()
    {
        $users = DB::table('information')->all();
        return view('home', ['users' => $users]);
    }

    public function login($request)
    {
        $admin = DB::table('admin')->where('username', '=', $request->input('email'))->where('password', '=', $request->input('password'))->first();
        return $admin;
    }
    public function deleteUser($user)
    {
        DB::table('information')->where('id', $user)->where('is_deleted', 0)->update(['is_deleted' => 1]);
    }

    public function updateActiveTime($id)
    {
          DB::table('admin')->where('id',$id)->update(['active_time' => Carbon::now()->timestamp]);
//        return $userLogin;
    }

    public function profile($id)
    {
        $admin = DB::table('admin')->where('id', $id)->get();
//    return view('home', ['users' => $users]);
        return view('profile', compact('admin'));
    }

    public function signin($request)
    {
        $dataSignin = array(
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        );

        DB::table('admin')->insert($dataSignin);
        return redirect('login');
    }

}
