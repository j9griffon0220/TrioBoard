<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostForm extends Component
{
    public $title;
    public $body;

    public function render()
    {
        return view('livewire.post-form');
    }
}
