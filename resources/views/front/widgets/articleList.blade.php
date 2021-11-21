@if(count($articles)>0)
    @foreach($articles as $article)

        <!-- Post preview-->
        <div class="post-preview">
            <a href="{{Route('single',$article->slug)}}">
                <h2 class="post-title">{{$article->title}}</h2>
                <img src="{{$article->image}}">
                <h3 class="post-subtitle">{{\Illuminate\Support\Str::limit($article->content,70)}}</h3>
            </a>
            <p class="post-meta">
                Kategori:
                <a href="{{route('category',\App\Models\Category::whereId($article->category_id)->first()->slug)}}">{{\App\Models\Category::whereId($article->category_id)->first()->name}}</a>
                <span class="float-right">{{$article->created_at->diffForHumans()}}</span>
            </p>
        </div>
        @if($loop->last)
            <hr>
        @endif
    @endforeach
    {{$articles->links()}}
@else
    <div class="alert alert-danger"><h1>Bu kategoriye ait yazı bulunamadı</h1></div>
@endif
