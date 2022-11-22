<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GithubWebHook
{
    public function handle(Request $request, Closure $next)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        $jsonPayload = json_decode($githubPayload, false);
        $externalToken = $jsonPayload['data']['secret'];

        if ($localToken !== $externalToken) {
            abort(403);
        }

        return $next($request);
    }
}
