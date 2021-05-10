<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Album extends Model
{
    use HasFactory,Sortable;
    
    protected $fillable = [
        'title',
        'album_cover',
		'created_at',
		'updated_at',
    ];

    public $sortable = [
		'id',
        'title',
		'created_at',
    ];
}
