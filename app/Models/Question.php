<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Accessor
    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    // Accessor
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // Accessor
    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return 'answered';
        }
        return "unanswered";
    }

    // Accessor
    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer($answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }
}
