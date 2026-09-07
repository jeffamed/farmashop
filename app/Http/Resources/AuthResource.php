<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'name' => $this->name,
          'last_name' => $this->last_name,
          'email' => $this->email,
          'role' => $this->roles->first()?->name,
          'permissions' => PermissionResource::collection($this->getAllPermissions())
        ];
    }
}
