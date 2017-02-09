<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
      tinymce.init({ selector:'textarea' });
    </script>
  </head>
  <body>
    <h1>Add New Blog Post</h1>
    <form class="" action="/blog" method="post" enctype="multipart/form-data">
      <input type="text" name="title" value="" placeholder="Title">
      {{ ($errors->has('title')) ? $errors->first('title') : '' }}<br>
      <input type="file" id="inputgambar" name="image" class="validate"/ ><br>
      <input type="text" name="slug" value="" placeholder="Slug here" required>
      <textarea name="description" rows="8" cols="40" placeholder="description"></textarea>
      {{ ($errors->has('description')) ? $errors->first('description') : '' }}<br>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="submit" name="name" value="post">
    </form>
  </body>
</html>
