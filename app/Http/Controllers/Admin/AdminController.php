<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function update()
    {
        $first = true;
        $families = Family::get();
        $types = Type::get();
        $controllers = 1;
        return view('admin.adminpanel', compact('families', 'types', 'controllers', 'first'));
    }

    public function service_destroy($id)
    {

        $service_del = Service::where('id', '=', $id)->delete();

        $families = Family::get();
        $types = Type::get();
        $controllers = 1;
        return view('admin.adminpanel', compact('families', 'types', 'controllers'));
    }

    public function type_destroy($id)
    {

        $type_del = Type::where('id', '=', $id)->delete();

        $services = Service::get();

        foreach ($services as $service) {
            $service_del = Service::where('type_id', '=', $id)->delete();
        }

        $families = Family::get();
        $types = Type::get();
        $controllers = 1;
        return view('admin.adminpanel', compact('families', 'types', 'controllers'));
    }

    public function family_destroy($id)
    {


        $service_type = Type::where('family_id', '=', $id)->get();

        foreach ($service_type as $servic_id) {
            $service = Service::where('type_id', '=', $servic_id->id)->delete();
        }


        $types = Type::get();

        foreach ($types as $type) {
            $type_del = Type::where('family_id', '=', $id)->delete();
        }



        $family_del = Family::where('id', '=', $id)->delete();

        $families = Family::get();
        $types = Type::get();
        $controllers = 1;
        return view('admin.adminpanel', compact('families', 'types', 'controllers'));
    }
}
