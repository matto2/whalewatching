<?php

	namespace App\Jobs\User\Admin;

	use App\Mail\User\Admin\NewUserNotifyMail;
	use App\Models\User\User;
	use Illuminate\Bus\Queueable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Queue\InteractsWithQueue;
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Illuminate\Support\Facades\Mail;

	class NewUserNotifyJob implements ShouldQueue {

		use InteractsWithQueue, Queueable, SerializesModels;

		private $user;

		// ********************************************************************************
		// Function: __construct()
		// --------------------------------------------------------------------------------
		// Class constructor.
		// ********************************************************************************

		public function __construct( User $user ) {
			$this->user = $user;
		}

		// ********************************************************************************
		// Function: handle()
		// --------------------------------------------------------------------------------
		// Process the job.
		// ********************************************************************************

		public function handle() {
			if ( setting( 'userEmailAdminNotifyInterval' ) == 'immediate' ) {
				Mail::to( setting( 'userEmailAdminNotifyRecipient' ) )->queue( new NewUserNotifyMail( $this->user ) );
			}
		}

	}

?>