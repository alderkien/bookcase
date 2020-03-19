<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name','description','isbn'];

    public function authors()
    {
        return $this->belongsToMany('App\Author','book_author');
    }

    public function scopeSearch($query, $term = null){
        if($term){
            return $query->where('name','like',"%".$term."%")->orWhereHas('authors',function ($q) use($term) {
                $q->where('name', 'like', "%".$term."%")->orWhere('surname', 'like', "%".$term."%");
            });
        }else{
            return $query;
        }
        
    }
}
