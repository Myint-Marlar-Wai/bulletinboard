<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

use Kyslik\ColumnSortable\Sortable;

class User extends Model
{
    use SoftDeletes;

    use Sortable;

    protected $table = "users";

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'profile',
        'type',
        'phone',
        'address',
        'dob',
        'create_user_id',
        'updated_user_id',
        'deleted_user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $sortable = [
        'id',
        'name',
        'email',
        'password',
        'profile',
        'type',
        'phone',
        'address',
        'dob',
        'create_user_id',
        'updated_user_id',
        'deleted_user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
        {
            return $this->belongsTo(User::class, 'create_user_id', 'id');
        }

    /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post()
        {
            return $this->hasMany(Post::class, 'create_user_id', 'id');
        }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
