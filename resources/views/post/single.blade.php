<h1>This details Posts</h1>
<h2>{{ $single->title }}</h2>
<p>
  {!! $single->description !!}
  <img src="{{ asset('image/' . $single->image)}}">
</p>
  <a href="{{url($single->slug) }}">{{ $single->slug}}</a>
<a href="/blog">Back to home</a>
