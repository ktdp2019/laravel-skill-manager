<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    use HasFactory;

    protected $table = 'skill_category';

    public function createCategory($data) {
        $this->title = $data['title'];
        $this->skill_category_id = $data['skill_category_id'];
        $this->save();
        return $this;
    }
}
