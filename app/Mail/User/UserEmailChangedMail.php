<?php

	namespace App\Mail\User;

	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Contracts\Queue\ShouldQueue;

	use App\Models\User\User;

	class UserEmailChangedMail extends Mailable {

		use Queueable, SerializesModels;

		public $user;
		public $newEmail;

		/**
		 * Create a new message instance.
		 *
		 * @return void
		 */
		public function __construct( User $user, $newEmail ) {
			$this->user = $user;
			$this->newEmail = $newEmail;
		}
		
		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {
		    return $this->subject( setting( 'userEmailChangedEmailSubject' ) )->view( 'emails.user.email.changed' );
		}

	}

?>