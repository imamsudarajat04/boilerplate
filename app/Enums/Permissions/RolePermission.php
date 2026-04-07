<?php

namespace App\Enums\Permissions;

enum RolePermission: string
{
    case CREATE = "create-role";
    case UPDATE = "update-role";
    case DELETE = "delete-role";
    case VIEW = "view-role";

    private function metadata(): array
    {
        return match ($this) {
            self::CREATE => [
                "label" => "Create Role",
                "description" => "Allows user to create new roles",
                "feature_group" => "Role Management",
            ],
            self::UPDATE => [
                "label" => "Update Role",
                "description" => "Allows user to update existing roles",
                "feature_group" => "Role Management",
            ],
            self::DELETE => [
                "label" => "Delete Role",
                "description" => "Allows user to delete roles",
                "feature_group" => "Role Management",
            ],
            self::VIEW => [
                "label" => "View Role",
                "description" => "Allows user to view roles",
                "feature_group" => "Role Management",
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
