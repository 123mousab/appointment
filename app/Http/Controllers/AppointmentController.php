<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointment =  Appointment::all();

        return Response::success($appointment)->mapInto(AppointmentResource::class)->withPagination()->send();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => [
                'required',
                'integer',
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

//        dd($request->all());
//        $appointment = Appointment::query()->create($request->all());
        $appointment = Appointment::query()->create([
            'user_id' => @$request->user_id,
            'person_number' => @$request->person_number,
            'transaction_number' => @$request->transaction_number,
            'start_time' => @$request->start_time,
            'finish_time' => @$request->finish_time,
        ]);

        $appointment->services()->sync($request->services);

        return Response::success(new AppointmentResource($appointment))->withMessage('تم العملية بنجاح')->send();
    }

    public function find($id){
        $appointment = new AppointmentResource(Appointment::query()->find($id));

        return Response::success($appointment)->withMessage('تم العملية بنجاح')->send();
    }


    public function update(Request $request, $id)
    {
        $appointment = Appointment::query()->find($id);

        $request->validate([
            'user_id'   => [
                'required',
                'integer',
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

        $appointment->update($request->all());

        $appointment->services()->sync($request->input('services', []));

        return Response::success(new AppointmentResource($appointment))->withMessage('تم العملية بنجاح')->send();
    }

    public function updateStatus(Request $request)
    {
        /**
         *  0 => الحجز قادمأ
         *  1 => الحجز بدأ
         *  2 => الحجز انتهي
         */

        $rules = [
            'id' => 'required',
            'status' => 'required|in:0,1,2',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }
        try {
            Appointment::query()->whereIn('id', $request->id)
                ->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return Response::error()->send();
        }
        return Response::success()->withMessage('تمت العملية بنجاح')->send();
    }

    public function destroy($id)
    {
        Appointment::query()->find($id)->delete();
        DB::table('appointment_service')->where('appointment_id', $id)->delete();

        return Response::success()->withMessage('تم العملية بنجاح')->send();
    }
}
