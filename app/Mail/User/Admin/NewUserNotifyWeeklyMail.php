<?php

	namespace App\Mail\User\Admin;

	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Illuminate\Database\Eloquent\Collection;

	use App\Models\User\User;

	class NewUserNotifyWeeklyMail extends Mailable {

		use Queueable, SerializesModels;

		public $users;

		/**
		 * Create a new message instance.
		 *
		 * @return void
		 */
		public function __construct( Collection $users ) {
			$this->users = $users;
		}
		
		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {
		    return $this->subject( setting( 'userEmailAdminNotifySubject' ) )->view( 'emails.user.admin.notify.weekly' );
		}

	}

?>