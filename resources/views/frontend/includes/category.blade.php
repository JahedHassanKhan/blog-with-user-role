<div class="categories_wrapper">
    <div class="categories_slides owl-carousel">
        @for($j=1; $j <= ($categories->count()%2 == 0 ? $categories->count()/2 : ($categories->count()+1)/2); $j++)
        <div class="item">
{{--            @foreach($categories->chunk($categories->count()) as $chunk)--}}
{{--                @foreach($chunk as $key=>$category)--}}
                @foreach($categories as $key=>$category)
                    @if($key < $j*2-2 || $key >= $j*2)
                        @continue
                    @endif
                <div class="category_box" style="background-image: url({{asset($category->category_image)}})">
                    <a href="{{route('categoryPost', [$category, $category->main_category])}}">
                        <img src="{{asset('/')}}frontend/assets/images/postimagebox.png" alt="">
                        <span class="name_cat">{{$category->name}}</span>
                    </a>
                </div>
                @endforeach
{{--            @endforeach--}}
{{--            // By using chunk it also work.--}}
        </div>
        @endfor
    </div>
</div>
