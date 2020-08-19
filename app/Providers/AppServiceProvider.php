<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use NlpTools\Tokenizers\TokenizerInterface;
use NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer;
use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\Stemmer\StemmerInterface;
use Sastrawi\StopWordRemover\StopWordRemover;
use Sastrawi\StopWordRemover\StopWordRemoverFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StopWordRemover::class, function () {
            return (new StopWordRemoverFactory)->createStopWordRemover();
        });

        $this->app->singleton(StemmerInterface::class, function () {
            return (new StemmerFactory)->createStemmer();
        });

        $this->app->singleton(TokenizerInterface::class, function () {
            return new WhitespaceAndPunctuationTokenizer();
        });
    }
}
