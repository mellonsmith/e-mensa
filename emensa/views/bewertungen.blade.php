@extends("werbeseitelayout")
@section("main")
    <br><br><br>
    <table>
    @foreach($bewertungen as $b)
            <tr>
                <td>
                    {{$b['name']}}
                </td>
                <td>
                    {{$b['sterne_bewertung']}}
                </td>
                <td>
                    {{$b['bemerkung']}}
                </td>
                @if ($admin ==1)
                    <td>
                        <form method="post" action="/hervorheben">
                            <input name="id" type="hidden" value="{{$b['id']}}">
                            <input class="right-button" type="submit" id="submit" value="Hervorheben">
                        </form>
                    </td>
                @endif
            </tr>
    @endforeach
    </table>

@endsection