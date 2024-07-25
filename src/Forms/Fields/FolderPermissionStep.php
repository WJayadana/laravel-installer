<?php

namespace Jayadana\WebInstaller\Forms\Fields;

use Filament\Forms\Components\Wizard\Step;
use Jayadana\WebInstaller\Concerns\StepContract;
use Jayadana\WebInstaller\Forms\Components\ViewBorder;
use Jayadana\WebInstaller\Utilities\PermissionsChecker;

class FolderPermissionStep implements StepContract
{
    public static function form(): array
    {
        $fields = [];
        $permissionsChecker = (new PermissionsChecker());
        $filePermissions = $permissionsChecker->check(
            config('installer.permissions')
        );

        foreach ($filePermissions['permissions'] as $permission) {
            $fields[] = ViewBorder::make('permissions.'.$permission['folder']
                .'_view')
                ->label($permission['folder'])
                ->inlineLabel()
                ->required(! $permission['isSet'])
                ->default($permission['permission']);
        }

        return $fields;
    }

    public static function make(): Step
    {
        return Step::make('permissions')
            ->label('Permissions')
            ->schema(self::form());
    }
}
