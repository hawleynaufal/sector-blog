<h1>This details Posts</h1>
<h2>{{ $detailpage->title }}</h2>
<p>
  {!! $detailpage->description !!}
  <img src="{{ asset('image/' . $detailpage->image)}}">
</p>
  <a href="{{url($detailpage->slug) }}">{{ $detailpage->slug}}</a>
<a href="/blog">Back to home</a>
