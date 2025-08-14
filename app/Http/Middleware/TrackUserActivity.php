<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use Illuminate\Support\Carbon;
use Auth;
use App\Models\UserAccessLog;
use WhichBrowser\Parser;
use Symfony\Component\HttpFoundation\Response;

class TrackUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
 public function handle(Request $request, Closure $next)
    {
   // Admin URL হলে visitor count করবেন না
    if ($request->is('admin/*')) {
        return $next($request);
    }

    $ip = $request->ip();
    $userAgent = $request->userAgent();
    $parser = new Parser($userAgent);

    $device = $parser->device->type ?? 'Desktop';
    if ($device === 'unknown' || empty($device)) {
        $device = 'Desktop';
    }

    $platform = $parser->os->name ?? 'Unknown';
    $platformVersion = $parser->os->version->value ?? 'Unknown';
    $browser = $parser->browser->name ?? 'Unknown';
    $browserVersion = $parser->browser->version->value ?? 'Unknown';

    $country = $this->getCountryFromIP($ip);
    $userId = auth()->id();

    $url = $request->fullUrl(); // অথবা $request->path() শুধু পাথ

    // একই URL, ব্রাউজার ও ডিভাইসের জন্য আগের লগ খুঁজুন
    $log = UserActivityLog::where('url', $url)
        ->where('browser', $browser)
        ->where('device', $device)
        ->first();

    if ($log) {
        // আগের রেকর্ড আছে, visit_count বাড়ান
        $log->visit_count += 1;
        $log->last_activity = now();
        $log->save();
    } else {
        // নতুন রেকর্ড তৈরি করুন
        UserActivityLog::create([
            'user_id'          => $userId,
            'ip_address'       => $ip,
            'url'              => $url,
            'user_agent'       => $userAgent,
            'browser'          => $browser,
            'browser_version'  => $browserVersion,
            'platform'         => $platform,
            'platform_version' => $platformVersion,
            'device'           => $device,
            'country'          => $country,
            'visit_count'      => 1,
            'last_activity'    => now(),
        ]);
    }

        return $next($request);
    }

    private function getCountryFromIP(string $ip): ?string
    {
        try {
            $response = @file_get_contents("http://ip-api.com/json/{$ip}");
            if (!$response) {
                return null;
            }

            $data = json_decode($response);
            if ($data && isset($data->status) && $data->status === 'success') {
                return $data->country ?? null;
            }
        } catch (\Exception $e) {
            // Exception থাকলে null রিটার্ন করুন
        }

        return null;
    }

}
