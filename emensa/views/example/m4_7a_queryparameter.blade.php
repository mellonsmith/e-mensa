@extends("layout")

@section("content")
    <div>
        <h1>Demo für {{ $name }}</h1>
        <p>Kurze Übersicht, wie die Arbeit mit dem Router und der Blade View-Engine funktioniert.</p>
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