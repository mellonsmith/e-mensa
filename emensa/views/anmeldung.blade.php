@extends("werbeseitelayout")
@section("main")
    <form method="post" id="submit" action="/anmeldung_verifizieren">

        <fieldset class="form-grid">
            <legend>Anmeldung</legend>
            <div>

                <label for="emailID"> Email*</label><br>
                <input name="email" type="text" size="34" required="required" placeholder="Bitte gib deine Email ein" id="emailID">
                <br><br>
                <label for="passwordID"> Passwort*</label><br>
                <input id="passwordID" type="password" name="password">
            </div>
            <div align="right">
                <br><br><br><br>
                    <button style="height: 2rem; width : 8rem" class="submit">Anmelden</button>

            </div>
        </fieldset>
    </form>
    {{$error}}
@endsection