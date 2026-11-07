@extends('layouts.apps')

@section('content')
<main class="container-fluid admin-page">
    <header class="admin-page__header">
        <div>
            <p class="admin-page__eyebrow">System configuration</p>
            <h1 class="admin-page__title">Add email configuration</h1>
            <p class="admin-page__description">Connect an SMTP mail server for organization notifications.</p>
        </div>
        <a href="{{ route('notificationget') }}" class="admin-page__button-secondary">
            <em class="icon ni ni-arrow-left" aria-hidden="true"></em>
            Back to email settings
        </a>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif
    @if (session('smtp_test_success'))
        <div class="alert alert-success" role="status">{{ session('smtp_test_success') }}</div>
    @endif

    <section class="admin-page__card admin-page__form-card admin-page__form-card--wide">
        <div class="admin-page__card-head">
            <div>
                <h2>SMTP server details</h2>
                <p>These details are used to deliver organization email notifications.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('notificationstore') }}" class="admin-page__form">
            @csrf
            <input type="hidden" name="organization_id" value="{{ Auth::user()->organization_id }}">
            <input type="hidden" name="created_by" value="{{ Auth::id() }}">
            <input type="hidden" name="driver" value="smtp">
            <div class="admin-page__form-grid">
                <div class="admin-page__field">
                    <label for="mail-host">Mail host</label>
                    <input id="mail-host" type="text" name="host" value="{{ old('host') }}" class="form-control" placeholder="smtp.example.org" required>
                </div>
                <div class="admin-page__field">
                    <label for="mail-port">Port</label>
                    <input id="mail-port" type="number" name="port" value="{{ old('port') }}" class="form-control" placeholder="587" required>
                </div>
                <div class="admin-page__field">
                    <label for="mail-username">Email address / username</label>
                    <input id="mail-username" type="text" name="username" value="{{ old('username') }}" class="form-control" autocomplete="username" required>
                </div>
                <div class="admin-page__field">
                    <label for="mail-password">Password</label>
                    <input id="mail-password" type="password" name="password" class="form-control" autocomplete="new-password" required>
                </div>
                <div class="admin-page__field">
                    <label for="mail-encryption">Encryption</label>
                    <select id="mail-encryption" name="encryption" class="form-control" required>
                        <option value="tls"{{ old('encryption', 'tls') === 'tls' ? ' selected' : '' }}>TLS (recommended)</option>
                        <option value="ssl"{{ old('encryption') === 'ssl' ? ' selected' : '' }}>SSL</option>
                        <option value="none"{{ old('encryption') === 'none' ? ' selected' : '' }}>None</option>
                    </select>
                </div>
            </div>
            <div class="admin-page__smtp-test-status alert" id="smtpTestStatus" role="status" aria-live="polite" hidden></div>
            <div class="admin-page__form-footer">
                <button type="button" class="admin-page__button-secondary" id="testSmtpSettings"
                        data-test-url="{{ route('notificationtest') }}">
                    <em class="icon ni ni-mail" aria-hidden="true"></em>
                    Test SMTP settings
                </button>
                <button type="submit" class="admin-page__button" id="saveEmailConfiguration" hidden>Save email configuration</button>
                <span class="admin-page__field-hint" id="smtpTestHint">Send a successful test email before saving these settings.</span>
                <a href="{{ route('notificationget') }}" class="admin-page__button-secondary">Cancel</a>
            </div>
        </form>
        <p class="admin-page__smtp-recipient">
            The test email will be sent to your signed-in address: <strong>{{ Auth::user()->email }}</strong>.
        </p>
    </section>
</main>
<script>
    (function () {
        var form = document.querySelector('.admin-page__form');
        var testButton = document.getElementById('testSmtpSettings');
        var saveButton = document.getElementById('saveEmailConfiguration');
        var testStatus = document.getElementById('smtpTestStatus');
        var testHint = document.getElementById('smtpTestHint');
        var settingsFields = ['host', 'port', 'username', 'password', 'encryption'];
        var originalButtonText = testButton.innerHTML;

        function showStatus(message, state) {
            testStatus.className = 'admin-page__smtp-test-status alert alert-' + state;
            testStatus.setAttribute('role', state === 'danger' ? 'alert' : 'status');
            testStatus.textContent = message;
            testStatus.hidden = false;
        }

        function clearTestState() {
            saveButton.hidden = true;
            testHint.hidden = false;
            testStatus.hidden = true;
            testStatus.textContent = '';
        }

        settingsFields.forEach(function (name) {
            form.elements[name].addEventListener('input', clearTestState);
            form.elements[name].addEventListener('change', clearTestState);
        });

        testButton.addEventListener('click', function () {
            clearTestState();
            testButton.disabled = true;
            testButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Testing connection…';
            showStatus('Connecting to the SMTP server and sending a test email…', 'info');

            fetch(testButton.dataset.testUrl, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            })
                .then(function (response) {
                    return response.text().then(function (text) {
                        var data;
                        try {
                            data = JSON.parse(text);
                        } catch (parseError) {
                            throw new Error('The server could not complete the SMTP test. Try again later.');
                        }

                        if (!response.ok) {
                            var validationErrors = data.errors ? Object.keys(data.errors).map(function (field) {
                                return data.errors[field].join(' ');
                            }).join(' ') : '';
                            throw new Error(validationErrors || data.message || 'The SMTP test failed. Check the settings and try again.');
                        }
                        return data;
                    });
                })
                .then(function (data) {
                    showStatus(data.message || 'The SMTP test completed successfully.', 'success');
                    saveButton.hidden = false;
                    testHint.hidden = true;
                })
                .catch(function (error) {
                    showStatus(error.message || 'The SMTP test could not be completed. Check your connection and try again.', 'danger');
                })
                .finally(function () {
                    testButton.disabled = false;
                    testButton.innerHTML = originalButtonText;
                });
        });
    })();
</script>
@endsection
