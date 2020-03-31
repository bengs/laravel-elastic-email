<?php

namespace Chocoholics\LaravelElasticEmail;

use Illuminate\Mail\MailServiceProvider as LaravelMailServiceProvider;

class MailServiceProvider extends LaravelMailServiceProvider
{
	/**
     * Register the Swift Transport instance.
     *
     * @return void
     */
    protected function registerSwiftTransport()
    {
        $this->app->singleton('swift.transport', function ($app) {
		return new TransportManager($app);
	});
    }

    /**
     * Register the Illuminate mailer instance.
     * For Laravel 7
     * @return void
     */
    protected function registerIlluminateMailer()
    {
        $this->app->singleton('mail.manager', function ($app) {
            return new MailManager($app);
        });

        $this->app->bind('mailer', function ($app) {
            return $app->make('mail.manager')->mailer();
        });
    }
}
