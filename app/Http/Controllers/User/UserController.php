<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function delete_calc($id)
    {


        $one = DB::table('calcs')
            ->where('id', '=', $id)
            ->delete();


        $two = DB::table('calculations')
            ->where('calc_id', '=', $id)
            ->delete();

        return redirect()->route('profile');
    }

    public function settings()
    {
        $dot = 0;
        //dd(session('LoggedUser'));
        $user = DB::table('users')
            ->where('id', '=', session('LoggedUser'))
            ->get();

        //dd($user->name());
        return view('users.account', compact('dot', 'user'));
    }

    public function update_login(UpdateRequest $request)
    {

        if ($request->phone === null && $request->name === null && $request->password === null) {
            return back()->with('fail', 'не вийшло');
        } else if ($request->phone === null && $request->name === null) {
            dd($request->all());
            $user = DB::table('users')
                ->where('id', '=', session('LoggedUser'))
                ->update([
                    'password' => Hash::make($request->password)
                ]);
            return back()->with('fail', 'Ви не ввели значення в поля');
            //dd($user);
        } else if ($request->password === null && $request->name === null) {
            $user = DB::table('users')
                ->where('id', '=', session('LoggedUser'))
                ->update([
                    'phone' => $request->phone
                ]);
            return back()->with('fail', 'Ви не ввели значення в поля');
        } else if ($request->phone === null && $request->password === null) {
            $user = DB::table('users')
                ->where('id', '=', session('LoggedUser'))
                ->update([
                    'name' => $request->name
                ]);
            return back()->with('fail', 'Ви не ввели значення в поля');
        } else if ($request->password === null) {
            $user = DB::table('users')
                ->where('id', '=', session('LoggedUser'))
                ->update([
                    'name' => $request->name,
                    'phone' => $request->phone
                ]);
            return back()->with('fail', 'Ви не ввели значення в поля');
        } else if ($request->phone === null) {
            $user = DB::table('users')
                ->where('id', '=', session('LoggedUser'))
                ->update([
                    'name' => $request->name,
                    'password' => Hash::make($request->password)
                ]);
            return back()->with('fail', 'Ви не ввели значення в поля');
        } else if ($request->name === null) {
            $user = DB::table('users')
                ->where('id', '=', session('LoggedUser'))
                ->update([
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password)
                ]);
            return back()->with('fail', 'Ви не ввели значення в поля');
        } else if (!($request->phone === null && $request->name === null && $request->password === null)) {
            $user = DB::table('users')
                ->where('id', '=', session('LoggedUser'))
                ->update([
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'name' => $request->name
                ]);
            return back()->with('fail', 'Ви не ввели значення в поля');
        }
    }
}
