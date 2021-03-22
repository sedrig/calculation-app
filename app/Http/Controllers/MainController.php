<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Calc;
use App\Models\Calculation;
use App\Models\Family;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use mysqli;

class MainController extends Controller
{
    public function index()
    {
        $families = Family::get();
        $types = Type::get();

        return view('index', compact('families', 'types'));
    }

    public function login()
    {
        return view('authorizate.signin');
    }

    public function register()
    {
        return view('authorizate.signup');
    }

    public function create(CreateRequest $request)
    {


        $query = DB::table('users')
            ->insert([
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], true);
        if ($query) {
            return redirect('login');
        } else {
            return back();
        }
    }

    public function check(LoginRequest $request)
    {

        $user = DB::table('users')
            ->where('phone', $request->phone)
            ->first();
        //dd($user);
        if ($user) {
            if ($user->is_admin == 1) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('LoggedAdmin', $user->id);
                    return redirect()->route('admin');
                } else {
                    return back()->with('fail', 'Не правильний логін або пароль');
                }
            } else if ($user->is_admin == 0) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('LoggedUser', $user->id);
                    return redirect()->route('profile');
                } else {
                    return back()->with('fail', 'Не правильний логін або пароль');
                }
            }
        } else {
            return back()->with('fail', 'Не правильний логін або пароль');
        }
    }

    public function adminpanel()
    {
        $verify = 1;
        $types = Type::get();
        $families = Family::get();
        return view('admin.adminpanel', compact('types', 'families', 'verify'));
    }

    public function user()
    {
        $return = Calc::get()->where('user_id', '=', session('LoggedUser'));
        return view('users.account', compact('return'));
    }

    public function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
        }

        if (session()->has('LoggedAdmin')) {
            session()->pull('LoggedAdmin');
        }

        return redirect()->route('home');
    }

    public function save_home(Request $request)
    {

        if (isset($request->id_delete)) {



            $one = DB::table('calcs')
                ->where('id', '=', $request->id_delete)
                ->delete();


            $two = DB::table('calculations')
                ->where('calc_id', '=', $request->id_delete)
                ->delete();



            $k = 0;
            foreach ($request->name as $key => $value) {
                if ($value === null || $request->units[$key] === null) {
                    // dump('Не записуэмо в БД' . $key);
                    $k++;
                }
            }
            //dd(count($request->name));
            if ($k < count($request->name)) {
                $kol = DB::table('calcs')->insertGetId(
                    [
                        'user_id' => session('LoggedUser'),
                        'name' => $request->comment,
                        'detail' => $request->descriprion

                    ]
                );
            }
            foreach ($request->name as $key => $value) {
                if ($value === null || $request->units[$key] === null) { } else {
                    $calc = DB::table('calculations')
                        ->insert([
                            'units' => $request->units[$key],
                            'price' => $value,
                            'service_id' => $key,
                            'calc_id' => $kol,
                        ]);
                }
            }
            //route('home_show', $item->id)
            return redirect()->route('home_show', $kol);
            // return back()->with('succsess', 'Добавлено в бд');
        } else {
            $k = 0;
            foreach ($request->name as $key => $value) {
                if ($value === null || $request->units[$key] === null) {
                    // dump('Не записуэмо в БД' . $key);
                    $k++;
                }
            }
            //dd(count($request->name));
            if ($k < count($request->name)) {
                $kol = DB::table('calcs')->insertGetId(
                    [
                        'user_id' => session('LoggedUser'),
                        'name' => $request->comment,
                        'detail' => $request->descriprion

                    ]
                );
            }
            foreach ($request->name as $key => $value) {
                if ($value === null || $request->units[$key] === null) { } else {
                    $calc = DB::table('calculations')
                        ->insert([
                            'units' => $request->units[$key],
                            'price' => $value,
                            'service_id' => $key,
                            'calc_id' => $kol,
                        ]);
                }
            }
            return back()->with('succsess', 'Добавлено в бд');
        }
    }

    public function index_show($index)
    {
        $sos = Calc::get()->where('id', '=', $index);


        foreach ($sos as $sobaka) {
            $calc = Calculation::get()->where('calc_id', '=', $sobaka->id);

            foreach ($calc as $serv) {
                $servi = Service::withTrashed()
                    ->where('id', '=', $serv->service_id)
                    ->first();
                if ($servi->deleted_at != null) {
                    $k = 0;
                    $l = 0;
                    $controll = 0;
                    $controll_calc = 0;
                    $types = Type::withTrashed()->get();
                    $service = Service::withTrashed()->get();
                    return view('another', compact('service', 'calc', 'k', 'sobaka', 'types', 'controll', 'l', 'controll_calc'));
                    //break;
                }
            }
            $families = Family::get();
            $types = Type::get();

            return view('index', compact('families', 'types',  'sobaka'));
            //dd('123');
        }
    }

    public function see_home(Request $request)
    {


        $types = Type::get();
        $service = Service::get();

        $k = 0;
        $l = 0;
        $controll = 0;

        return view('test', compact('request', 'service', 'types', 'k', 'l', 'controll'));
    }
}
