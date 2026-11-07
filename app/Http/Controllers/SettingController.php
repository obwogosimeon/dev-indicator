<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;
use App\BarNotification;
use Auth;
use DB;
use Log;

class SettingController extends Controller
{
    public function index()
    {
    	$notifications = Notification::all();
        return view('settings.index', compact('notifications'));
    }


    public function notification()
    {
        $notifications = Notification::with('organization')->get();
        $notifcations = BarNotification::where('status', '=', '01')
            ->where('user_id', Auth::user()->id)
            ->get();
        $notificationcount = DB::table('bar_notifications')
            ->where('status', '=', '01')
            ->where('user_id', Auth::user()->id)
            ->count();

        return view('notifications.index', compact(
            'notifications',
            'notifcations',
            'notificationcount'
        ));
    }

    public function createnotification() 
    {
        $notifcations = BarNotification::where('status', '=', '01')
            ->where('user_id', Auth::user()->id)
            ->get();
        $notificationcount = DB::table('bar_notifications')
            ->where('status', '=', '01')
            ->where('user_id', Auth::user()->id)
            ->count();

        return view('notifications.create', compact('notifcations', 'notificationcount'));
    }

    public function testnotification(Request $request)
    {
        session()->forget('notification_smtp_test');

        $settings = $request->validate([
            'host' => 'required|string|max:255',
            'port' => 'required|integer|in:25,465,587,2525',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'encryption' => 'required|in:tls,ssl,none',
        ], [
            'port.in' => 'Use a supported SMTP port: 25, 465, 587, or 2525.',
        ]);

        if (!$this->hasPublicSmtpAddress($settings['host'])) {
            return $this->smtpTestFailure(
                $request,
                'Use a public SMTP hostname or address. Local, private, and reserved network addresses are not allowed.'
            );
        }

        $recipient = Auth::user()->email;
        if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            return $this->smtpTestFailure($request, 'Your account does not have a valid email address for the SMTP test.');
        }

        $fromAddress = config('mail.from.address');
        if (!filter_var($fromAddress, FILTER_VALIDATE_EMAIL)) {
            $fromAddress = $settings['username'];
        }
        if (!filter_var($fromAddress, FILTER_VALIDATE_EMAIL)) {
            return $this->smtpTestFailure($request, 'Set a valid application sender address or use an email address as the SMTP username.');
        }

        $transport = new \Swift_SmtpTransport(
            $settings['host'],
            (int) $settings['port'],
            $settings['encryption'] === 'none' ? null : $settings['encryption']
        );
        $transport->setTimeout(10);
        $transport->setUsername($settings['username']);
        $transport->setPassword($settings['password']);

        $mailer = new \Swift_Mailer($transport);
        $message = (new \Swift_Message('DevIndicator SMTP test'))
            ->setFrom([$fromAddress => config('mail.from.name', 'DevIndicator')])
            ->setTo([$recipient])
            ->setBody('This test message confirms that the SMTP settings entered in DevIndicator can send email.');

        try {
            $sent = $mailer->send($message);
        } catch (\Swift_TransportException $exception) {
            Log::warning('SMTP settings test failed', [
                'user_id' => Auth::id(),
                'host' => $settings['host'],
                'port' => $settings['port'],
                'message' => $exception->getMessage(),
            ]);

            return $this->smtpTestFailure(
                $request,
                'The SMTP test could not be sent. Check the host, port, encryption, username, and password, then try again.',
                502
            );
        }

        if ($sent !== 1) {
            return $this->smtpTestFailure($request, 'The SMTP server did not accept the test email.', 502);
        }

        session()->put('notification_smtp_test', $this->smtpTestSignature($settings));

        $message = 'Test email sent successfully to ' . $recipient . '. Save the configuration to apply these settings.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $message]);
        }

        return back()->withInput($request->except(['password', '_token']))->with('smtp_test_success', $message);
    }

    private function smtpTestFailure(Request $request, $message, $status = 422)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], $status);
        }

        return back()->withInput($request->except(['password', '_token']))->with('error', $message);
    }

    public function storenotification(Request $request)
    {
        $settings = $request->validate([
            'host' => 'required|string|max:255',
            'port' => 'required|integer|in:25,465,587,2525',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'encryption' => 'required|in:tls,ssl,none',
        ], [
            'port.in' => 'Use a supported SMTP port: 25, 465, 587, or 2525.',
        ]);

        $signature = $this->smtpTestSignature($settings);
        if (!hash_equals((string) session('notification_smtp_test'), $signature)) {
            session()->forget('notification_smtp_test');

            return back()->withInput($request->except(['password', '_token']))->with(
                'error',
                'Test the current SMTP settings successfully before saving. Any changed settings must be tested again.'
            );
        }

        Notification::create([
            'organization_id' => Auth::user()->organization_id,
            'created_by' => Auth::id(),
            'driver' => 'smtp',
            'host' => $settings['host'],
            'port' => $settings['port'],
            'username' => $settings['username'],
            'password' => $settings['password'],
            'encryption' => $settings['encryption'] === 'none' ? null : $settings['encryption'],
        ]);

        session()->forget('notification_smtp_test');

        return redirect()->route('notificationget')
                        ->with('success','Notification Mode Created Successfully');
    }

    private function smtpTestSignature(array $settings)
    {
        return hash_hmac('sha256', serialize([
            Auth::id(),
            $settings['host'],
            (string) $settings['port'],
            $settings['username'],
            $settings['password'],
            $settings['encryption'],
        ]), config('app.key'));
    }

    private function hasPublicSmtpAddress($host)
    {
        if (filter_var($host, FILTER_VALIDATE_IP)) {
            $addresses = [$host];
        } else {
            if (!filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)
                || !preg_match('/[a-z]/i', $host)) {
                return false;
            }

            $records = dns_get_record($host, DNS_A | DNS_AAAA);
            $addresses = [];
            foreach ($records ?: [] as $record) {
                if (isset($record['ip'])) {
                    $addresses[] = $record['ip'];
                }
                if (isset($record['ipv6'])) {
                    $addresses[] = $record['ipv6'];
                }
            }
        }

        if (empty($addresses)) {
            return false;
        }

        foreach (array_unique($addresses) as $address) {
            if (!filter_var(
                $address,
                FILTER_VALIDATE_IP,
                FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            )) {
                return false;
            }
        }

        return true;
    }
}
