<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practical extends Model
{
    use HasFactory;

    protected $table = 'practical';


    public function createPractical($data) {
        $this->sprint_id = $data['sprint_id'];
        $this->title = $data['title'];
        $this->serial_number = $data['serial_number'];
        $this->save();
        return $this;
    }
}
