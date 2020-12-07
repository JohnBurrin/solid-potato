<?php

namespace App\Models;

use Backpack\PageManager\app\Models\Page as ParentModel;

/**
 * @property string $template
 *
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class Page extends ParentModel
{
    protected $fillable = ['template', 'name', 'title', 'slug', 'content', 'extras', 'is_published', 'user_id', 'is_featured'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getFaqsAttribute()
    {
        $return = [];
        $faqs = $this->attributes['faqs'] ?? null;
        if ($faqs === null) {
            return $return;
        }
        $faqs = json_decode($faqs);
        foreach ($faqs as $faq_group) {
            $faq_group->questions = json_decode($faq_group->questions);
            $return[] = $faq_group;
        }
        return $return;
    }
}
