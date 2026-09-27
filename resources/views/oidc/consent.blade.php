<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Authorize KoboToolbox</title></head>
<body style="font-family: sans-serif; max-width: 680px; margin: 40px auto; padding: 0 16px;">
    <h1>Allow KoboToolbox to sign you in?</h1>
    <p>KoboToolbox is requesting access to your Laravel account identity.</p>
    <ul>
        @if (strpos(' '.$params['scope'].' ', ' profile ') !== false)
            <li>Your name</li>
        @endif
        @if (strpos(' '.$params['scope'].' ', ' email ') !== false)
            <li>Your email address</li>
        @endif
    </ul>
    <p>Signed in as {{ auth()->user()->email }}.</p>
    <form method="POST" action="{{ url('/oauth/authorize/approve') }}" style="display:inline-block;">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary">Allow</button>
    </form>
    <form method="POST" action="{{ url('/oauth/authorize/deny') }}" style="display:inline-block; margin-left: 8px;">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">Cancel</button>
    </form>
</body>
</html>
