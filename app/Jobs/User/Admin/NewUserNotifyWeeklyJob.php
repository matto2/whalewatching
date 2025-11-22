<?php

	namespace App\Jobs\User\Admin;

	use App\Mail\User\Admin\NewUserNotifyWeeklyMail;
	use App\Models\User\User;
	use Carbon\Carbon;
	use Illuminate\Bus\Queueable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Queue\InteractsWithQueue;
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Illuminate\Support\Facades\Mail;

	class NewUserNotifyWeeklyJob implements ShouldQueue {

		use InteractsWithQueue, Queueable, SerializesModels;

		// ********************************************************************************
		// Function: __construct()
		// --------------------------------------------------------------------------------
		// Class constructor.
		// ********************************************************************************

		public function __construct() {
		}

		// ********************************************************************************
		// Function: handle()
		// --------------------------------------------------------------------------------
		// Process the job.
		// ********************************************************************************

		public function handle() {

			// Calculate starting and ending times for last week
			$start = Carbon::parse( 'last Sunday 00:00:00' )->toDateTimeString();
			$end = Carbon::parse( 'yesterday 23:59:59' )->toDateTimeString();

			// Retrieve user accounts created yesterday
			$users = User::where( 'created_at', '>=', $start )->where( 'created_at', '<=', $end )->get();

			// Send notification email only if configured to do so, and if users were created yesterday
			if ( setting( 'userEmailAdminNotifyInterval' ) == 'weekly' && count( $users ) ) {
				Mail::to( setting( 'userEmailAdminNotifyRecipient' ) )->queue( new NewUserNotifyWeeklyMail( $users ) );
			}

		}

	}

?>