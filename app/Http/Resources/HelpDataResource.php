<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HelpDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone_number' => $this->tel,
            'need' => [
                'type' => $this->ihtiyac_turu,
                'detail' => $this->ihtiyac_turu_detail,
            ],
            'how_many_person' => $this->kac_kisilik,
            'address' => $this->adres,
            'for directions' => $this->adres_tarifi,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'status' => $this->help_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
