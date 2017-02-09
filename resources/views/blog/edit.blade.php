<h1>Edit Post</h1>
<form class="" action="/blog/{{ $detailpage->id }}" method="post" enctype="multipart/form-data">
  <input type="text" name="title" value="{{ $detailpage->title }}" placeholder="Title">
  {{ ($errors->has('title')) ? $errors->first('title') : '' }}<br>
  <input type="file" id="inputgambar" name="image" class="validate"/ ><br>
  <input type="text" name="slug" value="{{ $detailpage->slug}}" placeholder="Slug here" required>
  <textarea name="description" rows="8" cols="40" placeholder="description">{{ $detailpage->description }}</textarea>
  {{ ($errors->has('description')) ? $errors->first('description') : '' }}<br>
  <input type="hidden" name="_method" value="put">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="submit" name="name" value="Edit post">
</form>

<script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script>tinymce.init({ selector:'textarea' });</script>
