<?php

	namespace App\Mail\User\Admin;

	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Contracts\Queue\ShouldQueue;

	use App\Models\User\User;

	class UserActivateAdminMail extends Mailable {

		use Queueable, SerializesModels;

		public $user;

		/**
		 * Create a new message instance.
		 *
		 * @return void
		 */
		public function __construct( User $user ) {
			$this->user = $user;
		}
		
		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {
		    return $this->subject( setting( 'userActivateEmailAdminSubject' ) )->view( 'emails.user.admin.activate' );
		}

	}

?>