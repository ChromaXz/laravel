<?php
//dibuat file ini dengan code: php artisan make:model Staff
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nip', 'nama', 'alamat', 'email'
    ];
}
