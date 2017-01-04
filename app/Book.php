<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
     
    protected $table = 'books'; 
     
    protected $fillable=[
        'isbn',
        'title',
        'author',
        'publisher',
        'image',
        'price',
        'author_id'
    ];
    
    public function author(){		
	return $this->belongsTo('App\Author', 'author_id', 'id');
    }
    
    
     public function relAuthor(){		
	return $this->belongsTo('App\Author', 'author_id', 'id');
    }
    
}
