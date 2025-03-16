<?php

namespace App\Livewire\Partials;

use App\Models\ProductRating;
use Livewire\Component;

class ProductRatingTable extends Component
{
    public $productId;
    public $rating;
    public $comment;

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function addRating()
    {
        // dd($this->rating, $this->comment);
        $validated = $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);
        ProductRating::create([
            'product_id' => $this->productId,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'user_id' => auth()->user()->id
        ]);
        $this->reset('rating', 'comment');
    }

    public function render()
    {
        $ratings = ProductRating::where('product_id', $this->productId)
        ->with('user')
        ->latest()
        ->paginate(10);

        return view('livewire.partials.product-rating-table', [
            'ratings' => $ratings
        ]);
    }
}
