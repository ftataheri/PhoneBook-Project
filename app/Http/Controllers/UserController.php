<?php

namespace App\Http\Controllers;

use App\Models\QueryModel;
use App\Models\UsersModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\UserInfo;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


class UserController extends Controller
{
    public function viewAllUser()
    {
        $model = new UsersModel();
        $users = $model->viewAllUser();
        //    return view('home', ['users' => $users]);
        return view('home', compact('users'));
    }

    public function query()
    {
        $model = new QueryModel();
        $x = $model->queryTest();
        dd($x);
    }

    public function services()
    {
        $model = new UsersModel();
        $category = $model->services();
        return view('services', compact('category'));
    }

    public function more(Request $id)
    {
        $model = new UsersModel();
        $category = $model->more($id->id);
//        $service = $model->selectedService($id->id);


//        if ($id->parent_id != 0) {
//
//            return view('details', compact('service'));
//
//        } else {
//
//            return view('services', compact('category'));
//
//        }
        return view('services', compact('category'));
    }

    public function selectedService(Request $id)
    {
        $model = new UsersModel();
        $service = $model->selectedService($id->id);
//        dd($service);
        return view('details', compact('service'));
    }

    public function receipt(Request $request)
    {
        $model = new UsersModel();
        $category = $model->receipt($request->id);
        return view('receipt', compact('category'));
    }

    public function insert(Request $request)
    {
        $model = new UsersModel();
        $fileName = time() . '.' . $request->pic->extension();
        $request->pic->move(public_path('uploads'), $fileName);
        $data = $model->insert($request, $fileName);

        return $data;
    }

    public function infoUser(Request $request)
    {
        $model = new UsersModel();
        $user = $model->getUser($request->id);
        return $user;

    }

    public function updateUserView(Request $id)
    {
        $model = new UsersModel();
        $updateUserView = $model->getUser($id->id);
        return $updateUserView;

    }

    public function updateUser(Request $request)
    {
        $model = new UsersModel();
        $fileName = time() . '.' . $request->pic->extension();
        $request->pic->move(public_path('uploads'), $fileName);
        $model->updateUser($request, $fileName);
        return redirect('home');

    }

    public function deleteUser(Request $user)
    {
        $model = new UsersModel();
        $model->deleteUser($user->id);
        return redirect('home');
    }

    public function login(Request $request)
    {
        $model = new UsersModel();
        $admin = $model->login($request);

//        dd(Carbon::now()->timestamp);
        if (!is_null($admin)){
            Session::put('adminID', $admin->id);
            $model->updateActiveTime($admin->id);





            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
                'captcha' => 'required|captcha'
            ]);

            return view('profile', compact('admin'));

//        if ($validUser)
//        {
////            return redirect('/home');
//            echo 'EXIST';
//
//        } else {
////            return redirect('/login');
//            echo 'DOESNT EXIST';
//
//        }
//
        }
    }

    public function profile()
    {
        $isUserLogged = false;
        if (Auth::check()){
            $isUserLogged = true;
        }
        return view('profile',compact('isUserLogged'));

    }

    public function signin(Request $request)
    {
        $model = new UsersModel();
        $data = $model->insert($request);
        return $data;
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('math')]);
    }

    public function getRequest(Request $request)
    {

//        $client = new Client();
        $response = Http::withHeaders([
            'Api-Key' => 'service.1a7e3138b2214ad697d32df9049955ce',
        ])->get('https://api.neshan.org/v4/direction/no-traffic',[
            'Type' => 'car',
            'origin' => '35.7871605,51.4382651',
            'destination' => '35.7896408,51.4523843',
            'waypoints' => '35.790869,51.4549377',
            'avoideTrafficZone' => 'true',
            'alternative' => 'true',
            'bearing' => '180',
        ]);

        $headers = [
//            'Content-Type' => 'application/json',
            'Api-Key' => 'service.1a7e3138b2214ad697d32df9049955ce',
        ];
        $result = json_decode($response->body());
//        dd($result);
//        dd($result->routes[0]->legs[1]->summary);
//        dd($result->routes[0]->legs[1]->steps[2]->instruction);

        return response();
    }

    public function curlgetRequest()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.neshan.org/v4/direction/no-traffic?Type=car&origin=35.7871605,51.4382651&destination=35.7896408,51.4523843&waypoints=35.790869,51.4549377&avoideTrafficZone=true&alternative=true&bearing=180");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Api-Key: service.1a7e3138b2214ad697d32df9049955ce"));

        $response = curl_exec($ch);

        curl_close($ch);

        dd(json_decode($response));

        return $response;
    }
}
