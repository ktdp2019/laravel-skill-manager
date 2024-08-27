<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticalNote extends Model
{
    use HasFactory;

    protected $table = 'practical_note';

    public function createNote($data) {
        $this->practical_id = $data['practical_id'];
        $this->note = $data['note'];
        $this->save();
        return $this;
    }
}
