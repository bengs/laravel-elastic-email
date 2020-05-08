<?php

namespace Chocoholics\LaravelElasticEmail;

use Illuminate\Mail\MailManager as LaravelMailManager;
if (class_exists('Illuminate\Mail\MailManager')) {
    class MailManager extends LaravelMailManager
    {
        protected function createElasticEmailTransport()
        {
            $config = $this->app['config']->get('services.elastic_email', []);

            return new ElasticTransport(
                $this->guzzle($config),
                $config['key'],
                $config['account']
            );
        }

    }
}
