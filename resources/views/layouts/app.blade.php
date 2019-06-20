<!DOCTYPE html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <title>example</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-primary">
  <a class="navbar-brand" style="color:#fff;" href="/">example</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse navbarNav d-flex">
  </div>

  <div class="flex-row-reverse collapse navbar-collapse navbarNav">
    <ul class="navbar-nav">
    </ul>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-12">
      @yield('content')
    </div>
  </div>
</div>


<script src="{{asset('js/app.js')}}"></script>
<!-- 導入javascipt -->
@yield('script')


</body>
</html>
