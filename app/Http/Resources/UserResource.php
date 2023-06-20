<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile_number' => $this->mobile_number,
            'alternate_mobile_number' => $this->alternate_mobile_number,
            'address' => $this->address,
            'licences' => $this->licences,
            'country_id' => $this->country_id,
            'status' => $this->status,
            'role_id' => $this->roles->pluck('id')->first(),
            'token' => $this->createToken("Token")->plainTextToken,
            'roles' => $this->roles->pluck('name'),
            'roles.permissions' => $this->getPermissionsViaRoles()->pluck(['name']) ?? [],
            'permissions' => $this->permissions->pluck('name') ?? [],
        ];
    }
}
