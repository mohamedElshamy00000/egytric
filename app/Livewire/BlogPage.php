<?php

namespace App\Livewire;

use Livewire\Component;
use Firefly\FilamentBlog\Models\Post;
class BlogPage extends Component
{
    public function render()
    {
        $posts = Post::latest()->paginate(10);
        return view('livewire.blog-page', compact('posts'));
    }
}
