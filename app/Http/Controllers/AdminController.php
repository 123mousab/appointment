<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Admin::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user['token'] = $user->createToken('web')->plainTextToken;

        return Response::success($user)->withMessage('تم عملية تسيجل الدخول بنجاح')->send();
    }

    public function logout()
    {
        \request()->user('admin')->tokens()->delete();

        return Response::success()->withMessage('تم عملية تسيجل الخروج بنجاح')->send();
    }
}
