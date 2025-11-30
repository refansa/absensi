<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SetAppBasePath
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the base path from X-Forwarded-Prefix header or environment
        $basePath = $request->header('X-Forwarded-Prefix') ?? $this->getBasePathFromUrl();

        if ($basePath && $basePath !== '/') {
            // Set the base path for URL generation
            URL::forceRootUrl(rtrim(config('app.url'), '/'));
            
            // Ensure route generation includes the base path
            $request->server->set('SCRIPT_NAME', $basePath . '/index.php');
        }

        return $next($request);
    }

    /**
     * Extract base path from APP_URL
     *
     * @return string|null
     */
    protected function getBasePathFromUrl()
    {
        $appUrl = config('app.url');
        
        if (!$appUrl) {
            return null;
        }

        $parsed = parse_url($appUrl);
        
        return $parsed['path'] ?? null;
    }
}
