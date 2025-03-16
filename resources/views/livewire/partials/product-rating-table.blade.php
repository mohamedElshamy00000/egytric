<div>
    <div class="mt-4">
        <div class="w-100 ms-auto">
            <div class="comment-form-section text-right">
                <div class="form-style-light p-4 mt-4">
                    <div class="user-comment-area">
                        @foreach($ratings as $rate)
                        <div class="single-comment d-flex align-items-top text-right rtl ratingBox">
                            <div class="user-comment-data">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="name mb-0">{{ $rate->user->name }}</h6>
                                    <span class="h6 text-muted mb-0 mr-2 badge bg-light">{{ $rate->created_at->diffForHumans() }}</span>
                                </div>
                                <ul class="style-none d-flex rating">
                                    @for($i = 1; $i <= $rate->rating; $i++)
                                        <li><i class="fa fa-star text-yellow-400"></i></li>
                                    @endfor
                                </ul>
                                <p>"{{ $rate->comment }}"</p>
                            </div> <!-- /.user-comment-data -->
                        </div>
                        @endforeach

                    </div>
                    <div class="mt-4">
                        {{ $ratings->links('vendor.pagination.custom') }}
                    </div>

                    @auth
                    <h5 class="title mb-4">أضف تعليق</h5>

                    <form wire:submit="addRating">
                        <div class="row">
                            <div class="col-12">
                                <div class="rating">
                                    <span class="star {{ $rating >= 1 ? 'text-warning' : 'text-gray-400' }}" wire:click="$set('rating', 1)"><i class="fa fa-star"></i></span>
                                    <span class="star {{ $rating >= 2 ? 'text-warning' : 'text-gray-400' }}" wire:click="$set('rating', 2)"><i class="fa fa-star"></i></span>
                                    <span class="star {{ $rating >= 3 ? 'text-warning' : 'text-gray-400' }}" wire:click="$set('rating', 3)"><i class="fa fa-star"></i></span>
                                    <span class="star {{ $rating >= 4 ? 'text-warning' : 'text-gray-400' }}" wire:click="$set('rating', 4)"><i class="fa fa-star"></i></span>
                                    <span class="star {{ $rating >= 5 ? 'text-warning' : 'text-gray-400' }}" wire:click="$set('rating', 5)"><i class="fa fa-star"></i></span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group-meta lg mb-35">
                                    <label>التعليق</label>
                                    <textarea placeholder="اكتب تعليقك هنا..." wire:model="comment"></textarea>
                                    @error('comment')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12"><button class="theme-btn-one btn-lg">إرسال</button></div>
                        </div>
                    </form>
                    @endauth
                </div> <!-- /.form-style-light -->
            </div>
        </div>
    </div>
</div>
