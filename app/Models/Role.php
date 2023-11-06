<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role'; // Set the table name to 'role'

    protected $fillable = [
        'name'
    ]; // Define fillable columns

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
