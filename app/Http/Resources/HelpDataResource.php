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
            'name' => $request->has('iced') ? (mb_substr($this->name, 0, 2) . str_repeat('*', strlen($this->name) - 2)) : $this->name,
            'phone_number' => $request->filled('id') ? $this->tel : null,
            'need' => [
                'type' => $this->ihtiyac_turu,
                'detail' => $this->ihtiyac_turu_detayi,
            ],
            'how_many_person' => $this->kac_kisilik,
            'address' => $this->adres,
            'for_directions' => $this->adres_tarifi,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'status' => $this->help_status,
            'created_at' => $this->created_at->format('d-m-Y H:i'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i')
        ];
    }
}
