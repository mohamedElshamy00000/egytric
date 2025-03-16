<?php
namespace App\Livewire;

use Livewire\Component;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Comment;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Route;

class BlogSinglePage extends Component
{
    public $slug;
    public $post;

    // Comment form properties
    public $name;
    public $email;
    public $commentBody;

    public function mount($slug = null)
    {
        $this->slug = $slug ?? request()->segment(count(request()->segments()));
        $this->post = Post::where('slug', $this->slug)->firstOrFail();
    }

    #[Title('title')]
    public function title()
    {
        return $this->post ? $this->post->title . ' - المدونة' : 'Electric - المدونة';
    }

    public function submitComment()
    {
        $this->validate([
            'commentBody' => 'required|min:10',
        ]);

        $comment = new Comment();
        // user_id , post_id , approved , comment
        $comment->user_id = auth()->id();
        $comment->comment = $this->commentBody;
        $comment->post_id = $this->post->id;
        $comment->save();

        // Reset form fields
        $this->reset(['commentBody']);

        // Add a success message
        session()->flash('message', 'تم إضافة تعليقك بنجاح!');
    }

    public function render()
    {
        if (!$this->post) {
            return redirect()->route('blog.index');
        }

        return view('livewire.blog-single-page', [
            'post' => $this->post,
        ]);
    }
}