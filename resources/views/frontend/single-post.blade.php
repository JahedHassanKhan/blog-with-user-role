@extends('frontend-master')

@section('og-meta')
<meta property="og:url" content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
<meta property="og:type" content="article" />
<meta property="og:title" content="When Great Minds Don’t Think Alike" />
<meta property="og:description" content="How much does culture influence creative thinking?" />
<meta property="og:image" content="{{asset('/')}}{{$post->image}}" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
@endsection

@section('title')
{{$post->title}}
@endsection

@section('body')
<!--Single no Sidebar-->
<div class="container no_padding single_nosidebar">
    <div class="row">
        <div class="col-lg-12">
            <!--Preview Image-->
            <div class="post_preview_image">
                <img src="{{asset('/')}}{{$post->image}}" alt="">
            </div>
            <!--END Preview Image-->
            <div class="post_single_container clearfix">
                <div class="single_post_content">
                    <!--Breadcrumbs-->
                    <div class="breadcrumbs">
                        <!--Post Data-->
                        <div class="post_data_publiс">
                            {{ $post->created_at->isoFormat('D MMM YYYY')}}
                        </div>
                        <!--END Post Data-->
                        <ul class="page-list">
                            <li class="first-item">
                                <a href="{{route('/')}}">Home</a>
                            </li>
                            <li><i class="icon-right-open-big"></i></li>
                            <li>
                                @foreach($post->categories as $postCategory)
                                    @if($loop->last)
                                        <a href="{{route('categoryPost', $postCategory)}}">{{ $postCategory->name }}</a>
                                    @else
                                        <a href="{{route('categoryPost', $postCategory)}}">{{ $postCategory->name }}</a>/
                                    @endif
                                @endforeach
                            </li>
                            <li><i class="icon-right-open-big"></i></li>
                            <li>{{$post->title}}</li>
                        </ul>
                    </div>
                    <!--END Breadcrumbs-->
                    <h1>{{$post->title}}</h1>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <p>Author :<a href="{{route('author', ['id' => $post->createdBy->id])}}"> {{$post->createdBy->name}} </a></p>
                        </div>
                        <div class="col-md-8 col-12">
                            {{-- Social-Share-Links  --}}
                            <div class="d-flex justify-content-end">
                                <p class="mr-3 text-dark ">Share with &#10170;</p>
                                <a href="#" class="text-dark mr-4" id="gmail-share-btn" target="_blank"><i class="fas fa-envelope" style="color: #cf3e39; font-size: 1rem"></i></a>
                                <a href="#" class="text-dark mr-4" id="facebook-share-btn" target="_blank"><i class="fab fa-facebook" style="color: #3b5998; font-size: 1rem"></i></a>
                                <a href="#" class="text-dark mr-4" id="twitter-share-btn" target="_blank"><i class="fab fa-twitter" style="color: #1da1f2; font-size: 1rem"></i></a>
                                <a href="#" class="text-dark mr-4" id="linkedin-share-btn" target="_blank"><i class="fab fa-linkedin-in" style="color: #0077b5; font-size: 1rem"></i></a>
                                <a href="#" class="text-dark mr-4" id="whatsapp-share-btn" target="_blank"><i class="fab fa-whatsapp" style="color: #25d366; font-size: 1rem"></i></a>
                                <span id="shareBtn" style="cursor: pointer"><i class="fa fa-share text-darrk mr-3" aria-hidden="true" style=" font-size: 1rem"></i></span>
                            </div>
                            {{-- Social-Share_Links End  --}}
                        </div>
                    </div>
                    {!! $post->post_body !!}
                    <!--Post Category and Tags-->
                    <div class="post_datainfo">
                        <div class="post_datainfo_item tagspost">
                            <span class="tagpostname">Tags:</span>
                            @foreach($post->tags as $postTag)
                                <a>{{ $postTag->name }}</a>
                            @endforeach
                        </div>
                        <div class="post_datainfo_item categoriesspost">
                            <span class="catspostname">Category:</span>
                            @foreach($post->categories as $postCategory)
                                @if($loop->last)
                                    <a href="{{route('categoryPost', $postCategory->slug)}}">{{ $postCategory->name }}</a>
                                @else
                                    <a href="{{route('categoryPost', $postCategory->slug)}}">{{ $postCategory->name }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!--END Post Category and Tags-->
                    <div class="action-count">
                        <span class="comments_count"><i class="fas fa-comments"></i> {{$post->replies->count()}} Comments</span>
                        <span class="reviews_count"><i class="fas fa-eye"></i> {{$post->views}} Views</span>
                    </div>
                </div>
            </div>
            <div class="author_box_post">
                <div class="author_box clearfix">
                    <div class="autor_img_wrapp">
                        <div class="author_image">
                            <a href="{{route('author', ['id' => $post->createdBy->id])}}">
                                <img src="{{asset('/')}}{{$previous->createdBy->userInformation->image ?? 'default-image/avatar.png'}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="short_autord_desc">
                        <div class="author_name">
                            <a href="{{route('author', ['id' => $post->createdBy->id])}}"> {{$post->createdBy->name}} </a>
                        </div>
                        <p>About</p>
                        <div class="author_socials">
                            <a href="#"><span class="icon-facebook"></span></a>
                            <a href="#"><span class="icon-twitter"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post_navigation clearfix">
                @if($previous)
                    <div class="prevous_post">
                        <div class="prev_img">
                            <a href="{{route('blogPost', $previous)}}">
                                <img
                                    src="{{asset('/')}}{{$previous->createdBy->userInformation->image ?? 'default-image/avatar.png'}}"
                                    alt="">
                            </a>
                        </div>
                        <div class="link_post">
                            <a href="{{route('blogPost', $previous)}}">
                                <span class="nav_arrow">← Previous</span>
                                {{$previous->title}}
                            </a>
                        </div>
                    </div>
                @endif
                @if($next)
                    <div class="next_post">
                        <div class="prev_img">
                            <a href="{{route('blogPost', $next)}}">
                                <img src="{{asset('/')}}{{$next->createdBy->userInformation->image ?? 'default-image/avatar.png'}}" alt="">
                            </a>
                        </div>
                        <div class="link_post">
                            <a href="{{route('blogPost', $next)}}">
                                <span class="nav_arrow">Next →</span>
                                {{$next->title}}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="comments-area">
                <h3 class="comment_titleform">Leave a Comment</h3>
                <div class="block">
                    @if($post->replies->count() > 0)
                    <ul class="comment-list">
                        @foreach($post->replies as $postReply)
                            <li class="comment">
                                <div class="single-comment clearfix">
                                    <div class="comment-author">
                                        <div class="inner-author">
                                            <div class="avatar_comment">
                                                @if($postReply->user)
                                                    @if($postReply->user->userInformation)
                                                        <img src="{{asset('/')}}{{$postReply->user->userInformation->image}}" alt="">
                                                    @else
                                                        <img src="{{asset('/')}}default-image/avatar.png" alt="">
                                                    @endif
                                                @endif
                                            </div>
                                            @if($postReply->user)
                                                <div class="author-name">{{$postReply->user->name}}</div>
                                            @endif
                                            <div class="comment-date">{{ $postReply->created_at->isoFormat('D MMM YYYY')}}</div>
                                        </div>
                                        <div class="comment-reply">
                                            @if(Auth::guard('web')->check())
                                                <a href="" id="replybtn{{$postReply->id}}" onclick="doSomethingfor{{$postReply->id}}()">Reply</a>
                                            @else
                                                Please <a href="{{route('login')}}">LOGIN</a> to reply
                                            @endif
                                        </div>
                                    </div>
                                    <div class="comment-text">
                                        <p>{{$postReply->body}}</p>
                                    </div>
                                </div>
                                <div class="comment-respond" id="replyBox{{$postReply->id}}" style="display: none">
                                    <form action="{{route('replyReply', [$postReply->id])}}" method="post"
                                          class="comment-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="custom-field">
                                                    <textarea id="comment" name="body" rows="7" placeholder="Your Comment..." required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button class="btn_gurd btn_send">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <script>
                                    function doSomethingfor{{$postReply->id}}() {
                                        event.preventDefault();
                                        var x{{$postReply->id}} = document.getElementById("replyBox{{$postReply->id}}");
                                        if (x{{$postReply->id}}.style.display === "none") {
                                            x{{$postReply->id}}.style.display = "block";
                                        } else {
                                            x{{$postReply->id}}.style.display = "none";
                                        }
                                        var y = document.getElementById("main-reply");
                                        if (y.style.display === "none") {
                                            y.style.display = "block";
                                        } else {
                                            y.style.display = "none";
                                        }
                                    }
                                </script>
                                @if($postReply->replies)
                                    <ul class="children">
                                        @foreach($postReply->replies as $commentReply)
                                            <li class="comment">
                                                <div class="single-comment clearfix">
                                                    <div class="comment-author">
                                                        <div class="inner-author">
                                                            <div class="avatar_comment">
                                                                @if($postReply->user)
                                                                    <img src="{{asset('/')}}{{$postReply->user->userInformation->image}}" alt="">
                                                                @else
                                                                    <img src="{{asset('/')}}default-image/avatar.png" alt="">
                                                                @endif
                                                            </div>
                                                            @if($postReply->user)
                                                                <div class="author-name">{{$postReply->user->name}}</div>
                                                            @endif
                                                            <div
                                                                class="comment-date">{{ $commentReply->created_at->isoFormat('D MMM YYYY')}}</div>
                                                        </div>
                                                        <div class="comment-reply">
                                                            @if(Auth::guard('web')->check())
                                                                <a href="#" id="replybtn{{$commentReply->id}}" onclick="doSomethingfor{{$commentReply->id}}()">Reply</a>
                                                            @else
                                                                Please <a href="{{route('login')}}">LOGIN</a> to reply
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="comment-text">
                                                        <p>{{$commentReply->body}}</p>
                                                    </div>
                                                </div>
                                                <div class="comment-respond" id="replyBox{{$commentReply->id}}"
                                                     style="display: none">
                                                    <form action="{{route('replyReply', [$commentReply->id])}}" method="post"
                                                          class="comment-form">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="custom-field">
                                                                    <textarea id="comment" name="body" rows="7" placeholder="Your Comment..." required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button class="btn_gurd btn_send">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <script>
                                                    function doSomethingfor{{$commentReply->id}}() {
                                                        event.preventDefault();
                                                        var x{{$commentReply->id}} = document.getElementById("replyBox{{$commentReply->id}}");
                                                        if (x{{$commentReply->id}}.style.display === "none") {
                                                            x{{$commentReply->id}}.style.display = "block";
                                                        } else {
                                                            x{{$commentReply->id}}.style.display = "none";
                                                        }
                                                        var y = document.getElementById("main-reply");
                                                        if (y.style.display === "none") {
                                                            y.style.display = "block";
                                                        } else {
                                                            y.style.display = "none";
                                                        }
                                                    }
                                                </script>
                                                @if($commentReply->replies)
                                                    <ul class="children">
                                                        @foreach($commentReply->replies as $replyReply)
                                                            <li class="comment">
                                                                <div class="single-comment clearfix">
                                                                    <div class="comment-author">
                                                                        <div class="inner-author">
                                                                            <div class="avatar_comment">
                                                                                @if($postReply->user)
                                                                                    <img src="{{asset('/')}}{{$postReply->user->userInformation->image}}" alt="">
                                                                                @else
                                                                                    <img src="{{asset('/')}}default-image/avatar.png" alt="">
                                                                                @endif
                                                                            </div>
                                                                            @if($postReply->user)
                                                                                <div
                                                                                    class="author-name">{{$postReply->user->name}}</div>
                                                                            @endif
                                                                            <div
                                                                                class="comment-date">{{ $replyReply->created_at->isoFormat('D MMM YYYY')}}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="comment-text">
                                                                        <p>{{$replyReply->body}}</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @if(Auth::guard('web')->check())
                    <div class="comment-respond" id="main-reply" style="display: block">
                        <form action="{{route('reply', $post->id)}}" method="post" class="comment-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="custom-field">
                                        <textarea id="comment" name="body" rows="7" placeholder="Your Comment..." required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn_gurd btn_send">Submit</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="comment-respond" id="main-reply" style="display: block">
                        <form action="{{route('reply', $post->id)}}" method="post" class="comment-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="custom-field">
                                        Please <a href="{{route('login')}}">LOGIN</a> for comment
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Social Share links.
        const gmailBtn = document.getElementById('gmail-share-btn');
        const facebookBtn = document.getElementById('facebook-share-btn');
        const linkedinBtn = document.getElementById('linkedin-share-btn');
        const twitterBtn = document.getElementById('twitter-share-btn');
        const whatsappBtn = document.getElementById('whatsapp-share-btn');

        // posturl posttitle------->
        let postUrl = encodeURI(document.location.href);
        let postTitle = encodeURI('{{$post->title}}');
        facebookBtn.setAttribute("href", `https://www.facebook.com/sharer.php?u=${postUrl}`);
        twitterBtn.setAttribute("href", `https://twitter.com/share?url=${postUrl}&text=${postTitle}`);
        linkedinBtn.setAttribute("href", `https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`);
        whatsappBtn.setAttribute("href", `https://wa.me/?text=${postTitle} ${postUrl}`);
        gmailBtn.setAttribute("href", `https://mail.google.com/mail/?view=cm&su=${postTitle}&body=${postUrl}`);
        // Button------------------>
        const shareBtn = document.getElementById('shareBtn');
        if (navigator.share) {
            shareBtn.style.display = 'block';
            shareBtn.addEventListener('click', () => {
                navigator.share({
                    title: postTitle,
                    url: postUrl
                }).then((result) => {
                    alert('Thank You for Sharing!');
                }).catch((err) => {
                    console.log(err);
                });
                ;
            });
        } else {
            shareBtn.style.display = 'none';
        }
</script>
@endsection
