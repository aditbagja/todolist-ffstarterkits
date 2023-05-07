<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = [
        'id'
    ]; 
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    protected $attributes = [
        'is_done' => false,
   ];
    public function mark(){
        $this->is_done = $this->is_done ? false : true;
        $this->save();
    }
}

