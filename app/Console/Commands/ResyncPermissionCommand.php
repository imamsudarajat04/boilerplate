<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Enums\Permission;

#[Signature('resync:permission')]
#[Description('Use to resync data permission from seeder to database')]
class ResyncPermissionCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $countBeforeResync = \App\Models\Permission::query()->count();
        $this->info("Current permission in Database : $countBeforeResync");

        $permissionsFromEnum = Permission::toSeederArray();
        $permissionsNameFromEnum = array_column($permissionsFromEnum, 'name');
        $permissionsNameFromDB = \App\Models\Permission::query()->pluck('name')->toArray();

        $permissionsNameFromDB = \App\Models\Permission::query()->get()->pluck('name')->toArray();

        $toDelete = array_diff($permissionsNameFromDB, $permissionsNameFromEnum);

        if (!empty($toDelete)) {
            $deleted = \App\Models\Permission::query()->whereIn('name', $toDelete)->delete();
            $this->warn("Deleted $deleted permission(s): " . implode(', ', $toDelete));
        } else {
            $this->info("No Permission to delete");
        }

        foreach ($permissionsFromEnum as $permission) {
            \App\Models\Permission::query()->updateOrCreate([
                'name' => $permission['name'],
                'guard_name' => 'web'
            ], [
                'label' => $permission['label'],
                'description' => $permission['description'],
                'feature_group' => $permission['feature_group'],
            ]);
        }

        $countAfterResync = \App\Models\Permission::query()->count();
        $this->info("Current permission in Database : $countAfterResync");

        $this->info("Permission synced successfully");
    }
}
