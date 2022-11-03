<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    use HasFactory;
    
    protected $table = 'wikis';

    protected $fillable = ['name', 'content', 'project_id', 'created_by'];


    public function files() 
    {
        return $this->hasMany(WikiFile::class, 'wiki_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
