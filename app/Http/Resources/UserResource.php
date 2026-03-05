<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'document' => $this->document,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password,
            'phone' => $this->phone,
            'remember_token' => $this->remember_token,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'notifications_count' => $this->notifications_count,
            'permissions_count' => $this->permissions_count,
            'read_notifications_count' => $this->read_notifications_count,
            'roles_count' => $this->roles_count,
            'unread_notifications_count' => $this->unread_notifications_count,
        ];
    }
}
