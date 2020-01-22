<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    
    protected $table = 'sekolah';
    /**
     * The attributes that are mass assignable.
     *
    //  * @var array
     */
    protected $fillable = [
        'nama', 
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function kelas() {
        return $this->hasMany('App\Kelas', 'sekolah_id');
    }
}