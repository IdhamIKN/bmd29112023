<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class DependantDropdownController extends Controller
{
    public function provinces()
    {
        $provinces = \Indonesia::allProvinces();

        return response()->json($provinces);
    }

    public function cities(Request $request)
    {
        $province = \Indonesia::findProvince($request->id, ['cities']);
        $cities = $province->cities->pluck('name', 'id');

        return response()->json($cities);
    }

    public function districts(Request $request)
    {
        $city = \Indonesia::findCity($request->id, ['districts']);
        $districts = $city->districts->pluck('name', 'id');

        return response()->json($districts);
    }

    public function villages(Request $request)
    {
        $district = \Indonesia::findDistrict($request->id, ['villages']);
        $villages = $district->villages->pluck('name', 'id');

        return response()->json($villages);
    }
}

