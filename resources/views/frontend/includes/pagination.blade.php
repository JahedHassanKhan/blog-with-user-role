<!--Pagination-->
@if ($paginator->hasPages())
    <div class="text-center">
        <nav class="page_pagination_wrapper margin50_0_0_0">
            <ul class="page-numbers">
                @if ($paginator->onFirstPage())
                    <li style="display: none"><a class="prev page-numbers"><i class="icon-left-open-big"></i></a></li>
                @else
                    <li><a class="prev page-numbers" href="{{ $paginator->previousPageUrl() }}"><i class="icon-left-open-big"></i></a></li>
                @endif
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li style="display: none"><a class="page-numbers">{{ $element }}</a></li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li><span aria-current="page" class="page-numbers current">{{ $page }}</span></li>
                            @else
                                <li><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li><a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}"><i class="icon-right-open-big"></i></a></li>
                @else
                    <li style="display: none"><a class="next page-numbers" href=""><i class="icon-right-open-big"></i></a></li>
                @endif
            </ul>
        </nav>
    </div>
@endif
{{--<!----}}
{{--@if ($paginator->hasPages())--}}
{{--    <ul class="pager">--}}
{{--        @if ($paginator->onFirstPage())--}}
{{--            <li class="disabled"><span>← Previous</span></li>--}}
{{--        @else--}}
{{--            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</a></li>--}}
{{--        @endif--}}
{{--        @foreach ($elements as $element)--}}
{{--            @if (is_string($element))--}}
{{--                <li class="disabled"><span>{{ $element }}</span></li>--}}
{{--            @endif--}}
{{--            @if (is_array($element))--}}
{{--                @foreach ($element as $page => $url)--}}
{{--                    @if ($page == $paginator->currentPage())--}}
{{--                        <li class="active my-active"><span>{{ $page }}</span></li>--}}
{{--                    @else--}}
{{--                        <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--        @if ($paginator->hasMorePages())--}}
{{--            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>--}}
{{--        @else--}}
{{--            <li class="disabled"><span>Next →</span></li>--}}
{{--        @endif--}}
{{--    </ul>--}}
{{--@endif--}}
{{--END Pagination-->--}}
