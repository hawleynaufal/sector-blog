{{ Session::get('message') }}
<h1>SectorBlog</h1>
{{ $time}}
@if (Auth::guest())
  login?
@else
{{ Auth::user()->name }}
@endif

<form class="navbar-form navbar-left" url="blog" action="\blog" method="get" role="search">
  <input type="text" name="search" placeholder="search ..." >
  <span class="input-group-btn">
    <button type="submit" class="btn btn-default">
      search
    </button>
  </span>
</form>
@foreach($blogs as $data )
<h2><a href="post/{{ $data->slug }}">{{ $data->title }}</a></h2>
  <p>{!! str_limit($data->description, $limit= 300 , $end= '...... ')!!}</p>
  <img src="{{ asset('image/' . $data->image)}}">
  <a href="blog/{{ $data->id }}/edit">Edit Post</a>
  <form class="" action="blog/{{ $data->id }}" method="post">
    <input type="hidden" name="_method" value="delete">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" name="name" value="Delete Post">
    {{$data->created_at->format('M d,Y \a\t h:i a')}}
  </form>
  <hr>
  @endforeach
  {!! $blogs->links() !!}
