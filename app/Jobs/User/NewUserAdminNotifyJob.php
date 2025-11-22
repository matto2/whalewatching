<?php

	namespace App\Jobs\User;

	use App\Models\User\User;
	use Illuminate\Bus\Queueable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Queue\InteractsWithQueue;
	use Illuminate\Contracts\Queue\ShouldQueue;

	class NewUserAdminNotifyJob implements ShouldQueue {

		use InteractsWithQueue, Queueable, SerializesModels;

		private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
		public function __construct( User $user ) {
	    	$this->user = $user;
		}

    /**
     * Execute the job.
     *
     * @return void
     */
		public function handle() {

			// Send the new user mail message
			$this->user->sendWelcomeMail();

			// Send the admin new user mail message
			$this->user->sendAdminNewUserMail();

		}

	}

?>