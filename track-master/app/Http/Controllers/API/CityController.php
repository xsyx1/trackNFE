<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class CityController extends BaseController
{
    public function index(Request $request)
    {
        $query = City::select(
            'cities.id',
            'cities.title',
            'states.letter',
            'cities.lat',
            'cities.long'
        )
            ->join('states', 'states.id', '=', 'cities.state_id')
            ->orderBy('title', 'asc')
            ->when($request->has('state'), function ($query) use ($request) {
                return $query->where('state_id', $request->state);
            });

        if ($request->has('search')) {
            $query = $query->where('cities.title', 'like', '%' . $request->search . '%');
        }

        ($request->has('page'))  ? $data = $query->paginate(10) : $data = $query->get();

        return $this->sendResponse($data);
    }

    public function show($id)
    {
        $item = City::findOrFail($id);

        return $this->sendResponse($item);
    }
}
