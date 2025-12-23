<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $created_by
 * @property string|null $created_ip
 * @property string|null $created_date
 * @property int|null $updated_by
 * @property string|null $updated_ip
 * @property string|null $updated_date
 * @property int $deleted
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereCreatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereUpdatedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeOfBusiness whereUpdatedIp($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTypeOfBusiness {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $company
 * @property int|null $type_of_business_id
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\TypeOfBusiness|null $typeOfBusiness
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTypeOfBusinessId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

