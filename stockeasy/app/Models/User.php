<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'email', 'password', 'cedula', 'id_rol'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_rol');
    }
}
