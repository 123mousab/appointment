<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start_time' => $this->start_time->format('Y-m-d H:i'),
            'finish_time' => $this->finish_time->format('Y-m-d H:i'),
            'user_id' => $this->user->id,
            'person_number' => $this->person_number,
            'transaction_number' => $this->transaction_number,
            'user' => $this->getUser(),
            'comments' => $this->comments,
            'status' => $this->status_text,
            'services' => collect($this->services)->map(function ($service){
                return [
                    'id' => $service['id'],
                    'name' => $service['name'],
                ];
            }),
        ];
    }

    private function getUser()
    {
        return [
            'id' => $this->user->id,
            'name' => $this->user->name,
        ];
    }
}
