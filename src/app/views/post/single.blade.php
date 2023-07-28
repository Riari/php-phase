@include('partials.header', ['pageTitle' => "Greeting"])

<h1>{{ $post->title }}</h1>

{!! $post->content !!}

@include('partials.footer')