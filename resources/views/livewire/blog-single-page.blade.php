<div>
    <div class="blog-page-bg rtl" style="margin-bottom: 93px;">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 feature-blog-one width-lg blog-details-post-v1">
                    <div class="post-meta">
                        <img src="{{ asset('storage/'.$post->cover_photo_path) }}" alt="" class="image-meta">
                        <div class="tag">{{ $post->created_at->format('d M. Y') }}</div>
                        <h3 class="title">{{ $post->title }}</h3>
                        <p>{!! $post->body !!}</p>

                        <div class="d-sm-flex align-items-center justify-content-between share-area">
                            <ul class="tag-feature d-flex">
                                <li>التصنيف: &nbsp;</li>
                                @foreach ($post->tags as $tag)
                                    <li><a href="#">{{ $tag->name }}</a></li>
                                @endforeach
                            </ul>
                            <ul class="share-option d-flex align-items-center">
                                <li class="mx-2">مشاركة</li>
                                <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" style="background: #41CFED;"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" style="background: #588DE7;"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}" target="_blank" style="background: #0077B5;"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div> <!-- /.post-meta -->

                    <div class="comment-area">
                        <h3 class="title text-center">التعليقات</h3>
                        @foreach ($post->comments->where('approved', 1) as $comment)
                        <div class="single-comment text-right" dir="rtl">
                            <div class="d-flex">
                                <div class="comment">
                                    <h6 class="name">{{ $comment->user->name }}</h6>
                                    <div class="time">{{ $comment->created_at->format('d M. Y') }}</div>
                                    <p>{{ $comment->comment }}</p>
                                    </div> <!-- /.comment -->
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- /.comment-area -->

                    <div class="comment-form-section text-right">
                        <h3 class="title">أضف تعليق</h3>

                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @auth
                        <div class="form-style-light">
                            <form wire:submit.prevent="submitComment">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group-meta lg mb-35">
                                            <label>التعليق</label>
                                            <textarea wire:model="commentBody" placeholder="اكتب تعليقك هنا..."></textarea>
                                            @error('commentBody') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="theme-btn-one btn-lg">إرسال</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @else
                        <p><a href="login.html">تسجيل الدخول</a> لإضافة تعليقك أو إنشاء حساب إذا لم يكن لديك حساب.</p>
                        @endauth

                    </div> <!-- /.comment-form-section -->
                </div>

            </div>
        </div>
    </div> <!-- /.feature-blog-one -->

</div>
