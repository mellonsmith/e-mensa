@extends("layout")
@section("content")
    <div>
        <h1>Kategorien</h1>
        <p>Blabllabllba</p>
        <ul>
        @forelse($data as $a)
            <li>{{$a['name']}}</li>
        @empty
            <li>Keine Daten vorhanden.</li>
        @endforelse
        </ul>

    </div>
@endsection
@section("cssextra")
    <link rel="stylesheet" href="/css/default.min.css">
    <style>
        body > div {background-color: {{ '#' . $bgcolor }}; }

        li:nth-child(odd) {
            font-weight: bold;
        }
    </style>
@endsection

@section("jsextra")
    <script src="/js/highlight.min.js"></script><script>hljs.highlightAll();</script>
@endsection