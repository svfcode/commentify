<?php

namespace Usamamuneerchaudhary\Commentify\Http\Livewire;


use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Like extends Component
{

    public $comment;
    public $count;


    public function mount(\Usamamuneerchaudhary\Commentify\Models\Comment $comment): void
    {
        $this->comment = $comment;
        $this->count = $comment->likes_count;
    }

    public function like(): void
    {
        if (!auth()->check()) {
            return;
        }

        if (!auth()->user()->hasVerifiedEmail()) {
            return;
        }

        if ($this->comment->isLiked()) {
            $this->comment->removeLike();
            $this->count--;
            return;
        }

        $this->comment->likes()->create([
            'user_id' => auth()->id(),
        ]);

        $this->count++;
    }

    /**
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application|null
     */
    public function render(
    ): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|null
    {
        return view('commentify::livewire.like');
    }

}
