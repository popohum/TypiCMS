<?php
Route::bind('news', function ($value, $route) {
    return TypiCMS\Modules\News\Models\News::where('id', $value)
        ->with('translations')
        ->firstOrFail();
});

if (! App::runningInConsole()) {
    Route::group(array('before' => 'auth.public|cache', 'after' => 'cache'), function () {
        $routes = app('TypiCMS.routes');
        foreach (Config::get('app.locales') as $lang) {
            if (array_key_exists('news', $routes)) {
                $uri = $routes['news'][$lang];
            } else {
                $uri = 'news';
                if (Config::get('app.locale_in_url')) {
                    $uri = $lang . '/' . $uri;
                }
            }
            Route::get(
                $uri,
                array(
                    'as' => $lang.'.news',
                    'uses' => 'TypiCMS\Modules\News\Controllers\PublicController@index'
                )
            );
            Route::get(
                $uri.'/{slug}',
                array(
                    'as' => $lang.'.news.slug',
                    'uses' => 'TypiCMS\Modules\News\Controllers\PublicController@show'
                )
            );
        }
    });
}

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function () {
    Route::resource(
        'news',
        'TypiCMS\Modules\News\Controllers\AdminController'
    );
});
