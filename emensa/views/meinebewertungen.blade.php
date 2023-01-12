@extends("werbeseitelayout")
@section("main")
    <br><br><br>
    <h2>Bewertungen von {{$bewertungen[0]['name']}}</h2>
    <table>

    @foreach($bewertungen as $b)
        <tr>
            <td>
                {{$b['sterne_bewertung']}}
            </td>
            <td>
                {{$b['bemerkung']}}
            </td>
            <td>
                <form method="post" action="/bewertungloeschen">
                    <input name="id" type="hidden" value="{{$b['id']}}">
                    <input class="right-button" type="submit" id="submit" value="Loeschen">
                </form>
            </td>
        </tr>
    @endforeach
    </table>

@endsection