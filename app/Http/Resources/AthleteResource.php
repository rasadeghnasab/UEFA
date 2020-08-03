<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AthleteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $this->load([
            'user',
            'superior',
            'sport',
        ]);

        $athlete = parent::toArray($request);

        $athlete['user'] = $this->user;
        $athlete['superior'] = $this->superior;
        $athlete['sport'] = $this->sport;

        return $athlete;
    }
}
