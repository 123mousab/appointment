<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user =  User::query()->paginate(10);

        return Response::success($user)->mapInto(UserResource::class)->withPagination()->send();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable',
            'password' => 'required',
        ]);

        User::query()->create($request->all());

        return Response::success()->withMessage('تم العملية بنجاح')->send();
    }

    public function find($id){
        $user = new UserResource(User::query()->find($id));

        return Response::success($user)->withMessage('تم العملية بنجاح')->send();
    }


    public function update(Request $request, $id)
    {
        $user = User::query()->find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'nullable',
            'password' => 'required',
        ]);

        $user->update($request->all());

        return Response::success()->withMessage('تم العملية بنجاح')->send();
    }

    public function destroy($id)
    {
        User::query()->find($id)->delete();

        return Response::success()->withMessage('تم العملية بنجاح')->send();
    }
}
