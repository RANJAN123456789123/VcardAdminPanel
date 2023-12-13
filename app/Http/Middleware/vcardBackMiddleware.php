<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class vcardBackMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {

        if ($request->is('vcardEdit')) {

            if (Session::has('destroySessionOnBack')) {
                $getsession = Session::get('userId');
                Session::flush();
                return redirect()->route('vcardcheckUser/' . $getsession);
            }
        }
        $response = $next($request);

        $response->headers->set('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');

        // Correct the JavaScript function name to window.history.back()
        $response->setContent($response->getContent() . '<script>window.history.forward();</script>');

        return $response;
    }
}
