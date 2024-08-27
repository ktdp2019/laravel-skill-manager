<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theory extends Model
{
    use HasFactory;

    protected $table = 'theory';

    public function createTheory($data) {
        $this->sprint_id = $data['sprint_id'];
        $this->title = $data['title'];
        $this->serial_number = $data['serial_number'];
        $this->save();
        return $this;
    }
}
