@extends("layout")

@section("content")
    <div>
        <h1>Der Wert von ?name lautet: {{ $name }}</h1>
    </div>
@endsection

@section("cssextra")
    <link rel="stylesheet" href="/css/default.min.css">
    <style>
        body > div {background-color: {{ '#' . $bgcolor }}; }
    </style>
@endsection

@section("jsextra")
    <script src="/js/highlight.min.js"></script><script>hljs.highlightAll();</script>
@endsection