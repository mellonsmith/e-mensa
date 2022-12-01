@extends("layout")
@section("content")
    <div>
        <h1>Kategorien</h1>
        <p>Blabllabllba</p>
        <table>
            <tr>
                <th>Name</th>
                <th>Preis Intern ab 2€</th>
            </tr>
            @forelse($data2 as $a)
                <tr>
                    <td>{{$a['name']}}</td>
                    <td>{{$a['preis_intern']}}</td>
                </tr>
            @empty
                <li>Keine Daten vorhanden.</li>
            @endforelse
        </table>

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