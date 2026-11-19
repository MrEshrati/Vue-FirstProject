<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request, ServerRequestInterface $oauthRequest) {
    $credentials = $request->validate([
        'username' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'max:255'],
    ]);

    $client = config('services.passport_web_client');
    if (empty($client['id']) || empty($client['secret'])) {
        return response()->json(['message' => 'Sign-in is not configured.'], 503);
    }

    return app(AccessTokenController::class)->issueToken($oauthRequest->withParsedBody([
        'grant_type' => 'password',
        'client_id' => $client['id'],
        'client_secret' => $client['secret'],
        'username' => $credentials['username'],
        'password' => $credentials['password'],
    ]));
})->middleware('throttle:6,1');
