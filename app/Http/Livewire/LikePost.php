<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;

    public function like()
    {
        // return "desde la funcion de like";
        if ($this->post->checklike(auth()->user())) {

            $this->post->likes()->where('post_id', $this->post->id)->delete();
        } else{
            $this->post->likes()->create([
            'user_id' => auth()->user()->id
        ]);

        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
