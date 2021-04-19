<?php


namespace App\Http\Controllers;


use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class BookingUserController
{
    public function addAppointment(Request $request)
    {
        $request->validate([
            'name'   => [
                'required',
                'string',
            ],
            'email'   => [
                'required',
                'email',
            ],
            'mobile'   => [
                'nullable',
            ],
            'person_number'   => [
                'nullable',
                'integer',
            ],
            'transaction_number'   => [
                'nullable',
                'integer',
            ],
            'start_time'  => [
                'required',
                'date_format:' . config('format.date_format') . ' ' . config('format.time_format'),
            ],
            'finish_time' => [
                'required',
                'date_format:' . config('format.date_format') . ' ' . config('format.time_format'),
            ],
            'services.*'  => [
                'integer',
            ],
            'services'    => [
                'array',
            ],
        ]);

        $user = User::query()->create($request->all());

        $appointment = Appointment::query()->create(array_merge($request->all(), [
            'user_id' => $user->id
        ]));

        $appointment->services()->sync($request->input('services', []));

        return Response::success(new AppointmentResource($appointment))->withMessage('تم العملية بنجاح')->send();
    }
}
