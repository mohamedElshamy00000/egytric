<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use App\Models\CarRating;
use Livewire\WithPagination;

class RatingTable extends Component
{
    use WithPagination;

    public $carId;
    public $rating;
    public $comment;
    public function mount($carId)
    {
        $this->carId = $carId;
    }

    public function addRating()
    {
        // dd($this->rating, $this->comment);
        $validated = $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);
        CarRating::create([
            'electric_car_id' => $this->carId,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'user_id' => auth()->user()->id
        ]);
        $this->reset('rating', 'comment');
    }
    public function render()
    {
        $ratings = CarRating::where('electric_car_id', $this->carId)
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('livewire.partials.rating-table', [
            'ratings' => $ratings
        ]);
    }
}
