<?php

namespace App\Enums\Permissions;

enum UserPermission: string
{
    case CREATE = "create-user";
    case UPDATE = "update-user";
    case DELETE = "delete-user";
    case VIEW = "view-user";

    private function metadata(): array
    {
        return match ($this) {
            self::CREATE => [
                "label" => "Create User",
                "description" => "Allows user to create new users",
                "feature_group" => "User Management",
            ],
            self::UPDATE => [
                "label" => "Update User",
                "description" => "Allows user to update existing users",
                "feature_group" => "User Management",
            ],
            self::DELETE => [
                "label" => "Delete User",
                "description" => "Allows user to delete users",
                "feature_group" => "User Management",
            ],
            self::VIEW => [
                "label" => "View User",
                "description" => "Allows user to view users",
                "feature_group" => "User Management",
            ],
        };
    }

    public function label(): string { 
        return $this->metadata()["label"]; 
    }

    public function description(): string 
    {
        return $this->metadata()["description"];
    }

    public function featureGroup(): string
    {
        return $this->metadata()["feature_group"];
    }
}
