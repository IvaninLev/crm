<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TodoList extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;
    const STATUS_ERR = 2;
    const STATUS_PROGRESS = 0;
    const  STATUS_DONE = 1;


    protected $table = 'todo_list';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'completed'
    ];

    public static function statusList(): array
    {
        return [
            self::STATUS_ERR => 'Error',
            self::STATUS_PROGRESS => 'Progress',
            self::STATUS_DONE => 'Done',
        ];
    }

    public function task(): HasMany
    {
        return $this->hasMany(TodoList::class, 'user_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
