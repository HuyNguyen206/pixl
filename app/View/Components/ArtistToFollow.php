<?php

namespace App\View\Components;

use App\Models\Profile;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ArtistToFollow extends Component
{
    public Collection $artists;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (Auth::check()) {
//            $this->artists = Profile::where(function ($query) {
//                $query->whereHas('followers', function ($query) {
//                    $query->where('follower_profile_id',
//                        '<>', \auth()->user()->profile->id);
//                })
//                    ->orWhereDoesntHave('followers');
//            })
//            ->where('id', '<>', \auth()->user()->profile->id)
//                ->inRandomOrder()->get();

            $query = Profile::whereDoesntHave('followers', function ($query) {
                $query->where('follower_profile_id', \auth()->user()->profile->id);
            })
                ->where('id', '<>', \auth()->user()->profile->id);

        } else {
            $query = Profile::query();
        }

        $this->artists = $query->inRandomOrder()->take(4)->get();

        return view('components.artist-to-follow');
    }
}
