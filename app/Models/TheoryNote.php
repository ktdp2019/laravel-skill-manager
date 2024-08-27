<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheoryNote extends Model
{
    use HasFactory;

    protected $table = 'theory_note';

    public function createNote($data) {
        $this->theory_id = $data['theory_id'];
        $this->note = $data['note'];
        $this->save();
        return $this;
    }
}
