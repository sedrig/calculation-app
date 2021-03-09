<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $query = DB::table('services')
            ->insert([
                'name' => $request->services,
                'type_id' => $request->type_id,
                'unit' => $request->ov,
                'price' => $request->price_service
            ]);
        if ($query) {
            return back()->with('Запис було додано до БД');
        } else {
            return back()->with('Запис не було додано по якимось причинам');
        }
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
        //dd($id);
        $types = Type::get();
        $service = DB::table('services')
            ->where('id', '=', $id)
            ->first();
        $identify = 3;
        return view('admin.adminpanel', compact('service', 'identify', 'types'));
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
        /*dump($request);
        dd($id);*/
        $update_type = DB::table('services')
            ->where('id', '=', $id)
            ->update([
                'name' => $request->services,
                'type_id' => $request->type_id,
                'price' => $request->price,
                'unit' => $request->ov
            ]);

        if ($update_type) {
            return redirect()->route('edit_service');
        } else {
            dd('Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        //
    }
}
