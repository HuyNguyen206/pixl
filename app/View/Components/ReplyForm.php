<?php

namespace App\View\Components;

use App\Models\Post;
use App\Models\Profile;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReplyForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ?Profile $profile, public Post $post)
    {
        $this->profile = \Auth::user()?->profile;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reply-form');
    }
}
