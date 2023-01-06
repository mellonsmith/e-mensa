@extends("werbeseitelayout")

@section("main")
    @if($username != "nouser")
        <div>Angemeldet als: {{$username}}
            <form method="post" id="submit" action="/abmelden">
                <button class="submit" style="height: 2rem; width : 8rem"  >Abmelden</button>
            </form>
        </div>

    @endif
    <img alt="placeholder" src="img/French-fries.webp" style="height:20%; width:40%;">
    <h1 id="CA">Bald könnt ihr online Essen bestellen!</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc condimentum, nibh vel bibendum blandit, ante orci auctor magna, quis sodales felis nulla eu tortor. Fusce volutpat, lorem finibus porttitor commodo, sapien ligula imperdiet lacus, vitae fermentum nisl tellus nec orci. In porta est ut ornare euismod. Donec sit amet enim iaculis, vulputate turpis porta, lacinia libero. Sed vel bibendum justo. Vestibulum et erat mattis, sollicitudin leo scelerisque, molestie ante. In eget quam facilisis, iaculis urna vitae, pellentesque arcu. Aenean malesuada a eros mattis ornare. Curabitur interdum risus ligula, in vestibulum dui venenatis vel. Proin aliquet aliquam congue. Phasellus ante lectus, placerat ac blandit ac, ultricies vitae lectus. Suspendisse sit amet risus mollis, rutrum leo faucibus, semper velit. <br> <br>Vestibulum pretium, erat eu porttitor posuere, leo ipsum lacinia est, quis tincidunt lectus nulla a lacus. Quisque ut purus diam. Fusce semper lectus a mauris viverra elementum. Pellentesque at malesuada magna. Fusce quis quam nunc. Morbi eu lorem iaculis, convallis purus sit amet, commodo massa. Praesent tincidunt neque lacus, nec fermentum ligula pulvinar non. Nullam ullamcorper at nunc quis ultricies. Sed quis ex dui. Nunc lobortis egestas erat, eget malesuada eros. Donec non ante ut nibh congue molestie. </p>
    <br><h1 id="CS">Köstlichkeiten die sie erwarten</h1>

    <table>
        <tr>
            <th>Gericht</th>
            <th>Bild</th>
            <th>Preis Intern</th>
            <th>Preis Extern</th>
            <th>Bewerten</th>
        </tr>

        @foreach($gericht as $g)
            <tr>
                <td> {{$g['name']}} </td>
                <td>
                    @if($g['bildname'] != "NULL")
                        <img class="gerichtimg" src="img/gerichte/{{$g['bildname']}}">
                    @endif
                    @if($g['bildname'] == "NULL")
                        <img class="gerichtimg" src="img/gerichte/00_image_missing.png">
                    @endif
                </td>
                <td>  {{$g['preis_intern']}}</td>
                <td>  {{$g['preis_extern']}} </td>
                <td>
                    <form method="get" id="submit" action="/bewertung">
                        <input type="hidden" name="id" value="{{$g['id']}}"></input>
                        <button style="height: 2rem; width : 6rem" class="submit">Bewerten</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
@endsection

