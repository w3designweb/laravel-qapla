<?php
namespace W3design\Qapla;
use Illuminate\Support\ServiceProvider;

class QaplaServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/config.php' => config_path('qapla.php'),
		], 'config');
	}
	/**
	 * Register the application services.
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__.'/../config/config.php', 'qapla');
	}
}