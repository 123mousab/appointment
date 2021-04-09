<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $service =  Service::query()->paginate(10);

        return Response::success($service)->mapInto(ServiceResource::class)->withPagination()->send();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Service::query()->create($request->all());

        return Response::success()->withMessage('تم العملية بنجاح')->send();
    }

    public function find($id){
        $service = new ServiceResource(Service::query()->find($id));

        return Response::success($service)->withMessage('تم العملية بنجاح')->send();
    }


    public function update(Request $request, $id)
    {
        $service = Service::query()->find($id);

        $request->validate([
            'name' => 'required'
        ]);

        $service->update([
            'name' => @$request->name
        ]);

        return Response::success()->withMessage('تم العملية بنجاح')->send();
    }

    public function destroy($id)
    {
        Service::query()->find($id)->delete();

        return Response::success()->withMessage('تم العملية بنجاح')->send();
    }
}
