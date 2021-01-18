<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    // Mutator
    public function setTitleAttribute($value){
        $this->attributes['title'] =  $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Accessor
    public function getUrlAttribute(){
        return route('questions.show', $this->id);
    }

    // Accessor
    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}