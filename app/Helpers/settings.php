<?php

	use App\Models\System\Setting;
	use Illuminate\Support\Facades\Cache;

	function setting( $key = null, $value = null ) {

		// Retrieve all system settings as an associative array
		$settings = Cache::remember( 'system.settings', 1440, function() {
			$results = [];
			foreach ( Setting::all() as $item ) {
				$results[$item->key] = $item->value;
			}
			return $results;
		});

		// If no key was specified, return all settings.
		if ( is_null( $key ) ) {
			return $settings;
		}

		// If an array was specified, set multiple values
		if ( is_array( $key ) ) {

			// Add each setting
			foreach ( $key as $item => $value ) {

				try {
					$setting = Setting::firstOrNew([ 'key' => $item ]);
					$setting->value = strval( $value );
					$setting->save();
				}

				catch ( Exception $e ) {
					\Log::error( 'Error saving setting: ' . $e->getMessage());
					return false;
				}
				// Update the value only if the value isn't null

			}

			// Re-save the settings to \Cache
			Cache::forget( 'system.settings' );
			return true;

		}

		// If no value was specified, return the value for the specified key.
		if ( is_null( $value ) ) {
			if ( array_key_exists($key, $settings) ) {
				return $settings[$key];
			}
			return null;
		}

		// A key and value was specified, so set the value and they return it.
		if ( $setting = Setting::where( 'key', $key )->first() ) {
			$setting->value = $value;
			$setting->save();
		}

		else {
			$setting = new Setting;
			$setting->keyName = $key;
			$setting->value = $value;
			$setting->save();
		}

		Cache::forget( 'system.settings');

		return $value;

	}

?>