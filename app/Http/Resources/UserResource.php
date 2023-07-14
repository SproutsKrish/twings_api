<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\User;

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
            'country_name' => $this->country_name,
            'timezone_name' => $this->timezone_name,
            'timezone_minutes' => $this->timezone_minutes,
            'status' => $this->status,
            'role_id' => $this->roles->pluck('id')->first(),
            'token' => $this->createToken("Token")->plainTextToken,
            'roles' => $this->roles->pluck('name'),
            'roles.permissions' => $this->getPermissionsViaRoles()->pluck(['name']) ?? [],
            'permissions' => $this->permissions->pluck('name') ?? [],
        ];
    }

    public function loginRequest()
    {
        return [
            'token' => $this->createToken("Token")->plainTextToken,
        ];
    }

    public function getUsersInfoByID($id)
    {
        // Retrieve the users' information based on the token name
        $users = User::where('id', $id)->get();

        // Transform the users' information into the desired format
        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'password' => $user->password,
                'mobile_number' => $user->mobile_number,
                'alternate_mobile_number' => $user->alternate_mobile_number,
                'address' => $user->address,
                'licences' => $user->licences,
                'country_id' => $user->country_id,
                'country_name' => $user->country_name,
                'timezone_name' => $user->timezone_name,
                'timezone_minutes' => $user->timezone_minutes,
                'status' => $user->status,
                'remember_token' => $user->remember_token
            ];
        }

        return $userArray;
    }
}
