<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    use HasFactory;

    protected $table = 'skill_category';

    public function getAllCategory() {
        $allCategory = $this->all();
        return $allCategory;
    }

    public function isDuplicateCategory($title) {
        $allCategory = $this->getAllCategory();
        $oldCategory = null;
        forEach ($allCategory as $category) {
            if (strtoupper($category->title) == $title) {
                $oldCategory = $category;
                break;
            }
        }
        return $oldCategory;
    }

    public function createVerifiedCategory($data) {
        $data['verified'] = true;
        $category = $this->createCategory($data);
        return $category;
    }

    public function createUnVerifiedCategory($data) {
        $data['verified'] = false;
        $category = $this->createCategory($data);
        return $category;
    }

    private function createCategory($data) {
        $category = $this->isDuplicateCategory(strtoupper($data['title']));
        if ($category) {
            return $category;
        }
        $this->title = $data['title'];
        $this->verified = $data['verified'];
        $this->skill_category_id = $data['skill_category_id'];
        $this->save();
        return $this;
    }
}
