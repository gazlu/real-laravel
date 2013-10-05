<?php

	class AuthController extends BaseController{
		
		protected $user;

		public function __construct(User $user)
		{
			$this->user = $user;
		}

		public function index()
		{			
			return View::make('auth.index');
		}

		public function logout()
		{
			Session::flush();
			Auth::logout();
			return Redirect::to('auth');
		}

		public function ServiceLogin()
		{
			// get POST data
		    $userdata = array(
		        'username' => Input::get('username'),
		        'password' => Input::get('password')
		    );

		    if ( Auth::attempt($userdata) )
		    {
		    	$userRow = DB::select(
					    		'SELECT * FROM users where Username = ?',
					    		array(Input::get('username'))
					    	);
			    if (count($userRow)==1) {
			    	$user = $userRow[0];
			    	Session::put('light.logintime', date('g:i a'));
			    	Session::put('light.username', $user->username);
			    	Session::put('light.useremail', $user->Email);
			    	Session::put('light.useruid', $user->id);
			    }
		        // we are now logged in, go to original url
		        return Redirect::intended('/change');
		    }
		    else
		    {
		        // auth failure! lets go back to the login
		        return Redirect::to('auth')
		            ->with('login_errors', true);
		        // pass any error notification you want
		        // i like to do it this way :)
		    }
		}
		
	}