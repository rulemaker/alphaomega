<?php

class AdminUsersController extends AdminController {


    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;
		
		/**
     * Department Model
     * @var Department
     */
    protected $department;
		
		/**
     * Position Model
     * @var Position
     */
    protected $position;
		
		/**
     * Marital Model
     * @var Marital
     */
    protected $marital;

    /**
     * Inject the models.
     * @param User $user
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(User $user, Role $role, Permission $permission, Department $department, Position $position, Marital $marital)
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
				$this->department = $department;
				$this->position = $position;
				$this->marital = $marital;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/users/title.user_management');

        // Grab all the users
        $users = $this->user;

        // Show the page
        return View::make('admin/users/index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // All roles
        $roles = $this->role->all();

        // Get all the available permissions
        $permissions = $this->permission->all();
				
				// Get all the available departments
        $departments = $this->department->all();
				
				// Get all the available positions
        $positions = $this->position->all();
				
				// Get all the available maritals
        $maritals = $this->marital->all();

        // Selected groups
        $selectedRoles = Input::old('roles', array());

        // Selected permissions
        $selectedPermissions = Input::old('permissions', array());

		// Title
		$title = Lang::get('admin/users/title.create_a_new_user');

		// Mode
		$mode = 'create';

		// Show the page
		return View::make('admin/users/create_edit', compact('roles', 'permissions', 'departments', 'positions', 'maritals', 'selectedRoles', 'selectedPermissions', 'title', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $this->user->username = Input::get( 'username' );
				$this->user->firstname = Input::get( 'firstname' );
				$this->user->lastname = Input::get( 'lastname' );
        $this->user->email = Input::get( 'email' );
        $this->user->password = Input::get( 'password' );
				$this->user->department = Input::get( 'department' );
				$this->user->position = Input::get( 'position' );
				$this->user->marital_status = Input::get( 'marital_status' );
				
				$this->user->user_nik = Input::get( 'user_nik' );
				$this->user->gender = Input::get( 'gender' );
				$this->user->identity_no = Input::get( 'identity_no' );
				$this->user->tax_status = Input::get( 'tax_status' );
				$this->user->npwp_no = Input::get( 'npwp_no' );
				$this->user->npwp_date = Input::get( 'npwp_date' );
				$this->user->jamsostek_no = Input::get( 'jamsostek_no' );
				$this->user->job_status = Input::get( 'job_status' );
				$this->user->joined_date = Input::get( 'joined_date' );
				$this->user->birth_place = Input::get( 'birth_place' );
				$this->user->birth_date = Input::get( 'birth_date' );
				$this->user->address = Input::get( 'address' );
				$this->user->city = Input::get( 'city' );
				$this->user->state = Input::get( 'state' );
				$this->user->country = Input::get( 'country' );
				$this->user->zipcode = Input::get( 'zipcode' );
				$this->user->home_phone = Input::get( 'home_phone' );
				$this->user->mobile_phone = Input::get( 'mobile_phone' );
				$this->user->personal_email = Input::get( 'personal_email' );
				$this->user->ended_date = Input::get( 'ended_date' );
				
				// If Photo uploaded
				if (Input::hasFile('photo')) {
					$photo = Input::file('photo');
					$filename = $photo->getClientOriginalName();
	
					$destinationPath = 'uploads/'.date('Y-m-d');
					$upload_success = Input::file('photo')->move( 'public/' . $destinationPath, $filename);
					$this->user->photo = $destinationPath.'/'.$filename;			
				}
				

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $this->user->password_confirmation = Input::get( 'password_confirmation' );
        $this->user->confirmed = Input::get( 'confirm' );

        // Permissions are currently tied to roles. Can't do this yet.
        //$user->permissions = $user->roles()->preparePermissionsForSave(Input::get( 'permissions' ));

        // Save if valid. Password field will be hashed before save
        $this->user->save();

        if ( $this->user->id )
        {
            // Save roles. Handles updating.
            $this->user->saveRoles(Input::get( 'roles' ));

            // Redirect to the new user page
            return Redirect::to('users/' . $this->user->id . '/edit')->with('success', Lang::get('admin/users/messages.create.success'));
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->user->errors()->all();

            return Redirect::to('users/create')
                ->withInput(Input::except('password'))
                ->with( 'error', $error );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getShow($user)
    {
        
				// Get all the available departments
        $department = $this->department->find($user->department);

				// Get all the available positions
        $position = $this->position->find($user->position);
				
				// Get all the available maritals
        $marital = $this->marital->find($user->marital_status);
				
				// Title
				$title = Lang::get('admin/users/title.show_user');
				
				// Show the page
				return View::make('admin/users/show', compact('user', 'department', 'marital', 'position', 'title'));
		}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit($user)
    {
        if ( $user->id )
        {
          $roles = $this->role->all();
          $permissions = $this->permission->all();
					$departments = $this->department->all();
					$positions = $this->position->all();
					$maritals = $this->marital->all();

            // Title
        	$title = Lang::get('admin/users/title.user_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/users/create_edit', compact('user', 'roles', 'permissions', 'departments', 'positions', 'maritals', 'title', 'mode'));
        }
        else
        {
            return Redirect::to('users')->with('error', Lang::get('admin/users/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit($user)
    {
        // Validate the inputs
        $validator = Validator::make(Input::all(), $user->getUpdateRules());


        if ($validator->passes())
        {
            $oldUser = clone $user;
            $user->username = Input::get( 'username' );
            $user->email = Input::get( 'email' );
						$user->firstname = Input::get( 'firstname' );
            $user->lastname = Input::get( 'lastname' );
						$user->department = Input::get( 'department' );
						$user->position = Input::get( 'position' );
						$user->marital_status = Input::get( 'marital_status' );
            $user->confirmed = Input::get( 'confirm' );
						
						$user->user_nik = Input::get( 'user_nik' );
						$user->gender = Input::get( 'gender' );
						$user->identity_no = Input::get( 'identity_no' );
						$user->tax_status = Input::get( 'tax_status' );
						$user->npwp_no = Input::get( 'npwp_no' );
						$user->npwp_date = Input::get( 'npwp_date' );
						$user->jamsostek_no = Input::get( 'jamsostek_no' );
						$user->job_status = Input::get( 'job_status' );
						$user->joined_date = Input::get( 'joined_date' );
						$user->birth_place = Input::get( 'birth_place' );
						$user->birth_date = Input::get( 'birth_date' );
						$user->address = Input::get( 'address' );
						$user->city = Input::get( 'city' );
						$user->state = Input::get( 'state' );
						$user->country = Input::get( 'country' );
						$user->zipcode = Input::get( 'zipcode' );
						$user->home_phone = Input::get( 'home_phone' );
						$user->mobile_phone = Input::get( 'mobile_phone' );
						$user->personal_email = Input::get( 'personal_email' );
						$user->ended_date = Input::get( 'ended_date' );
						
						// If Photo uploaded
						if (Input::hasFile('photo')) {
							$photo = Input::file('photo');
							$filename = $photo->getClientOriginalName();
			
							$destinationPath = 'uploads/'.date('Y-m-d');
							$upload_success = Input::file('photo')->move( 'public/' . $destinationPath, $filename);
							$user->photo = $destinationPath.'/'.$filename;			
						}
						
            $password = Input::get( 'password' );
            $passwordConfirmation = Input::get( 'password_confirmation' );

            if(!empty($password)) {
                if($password === $passwordConfirmation) {
                    $user->password = $password;
                    // The password confirmation will be removed from model
                    // before saving. This field will be used in Ardent's
                    // auto validation.
                    $user->password_confirmation = $passwordConfirmation;
                } else {
                    // Redirect to the new user page
                    return Redirect::to('users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
                }
            } else {
                unset($user->password);
                unset($user->password_confirmation);
            }
            
            if($user->confirmed == null) {
                $user->confirmed = $oldUser->confirmed;
            }

            $user->prepareRules($oldUser, $user);

            // Save if valid. Password field will be hashed before save
            $user->amend();

            // Save roles. Handles updating.
            $user->saveRoles(Input::get( 'roles' ));
        } else {
            return Redirect::to('users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.edit.error'));
        }

        // Get validation errors (see Ardent package)
        $error = $user->errors()->all();

        if(empty($error)) {
            // Redirect to the new user page
            return Redirect::to('users/' . $user->id . '/edit')->with('success', Lang::get('admin/users/messages.edit.success'));
        } else {
            return Redirect::to('users/' . $user->id . '/edit')->with('error', Lang::get('admin/users/messages.edit.error'));
        }
    }

    /**
     * Remove user page.
     *
     * @param $user
     * @return Response
     */
    public function getDelete($user)
    {
        // Title
        $title = Lang::get('admin/users/title.user_delete');

        // Show the page
        return View::make('admin/users/delete', compact('user', 'title'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete($user)
    {
        // Check if we are not trying to delete ourselves
        if ($user->id === Confide::user()->id)
        {
            // Redirect to the user management page
            return Redirect::to('users')->with('error', Lang::get('admin/users/messages.delete.impossible'));
        }

        AssignedRoles::where('user_id', $user->id)->delete();

        $id = $user->id;
        $user->delete();

        // Was the comment post deleted?
        $user = User::find($id);
        if ( empty($user) )
        {
            // TODO needs to delete all of that user's content
            return Redirect::to('users')->with('success', Lang::get('admin/users/messages.delete.success'));
        }
        else
        {
            // There was a problem deleting the user
            return Redirect::to('users')->with('error', Lang::get('admin/users/messages.delete.error'));
        }
    }

    /**
     * Show a list of all the users formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $users = User::leftjoin('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'assigned_roles.role_id')
										->leftjoin('departments', 'departments.department_id', '=', 'users.department')
                    ->select(array('users.id', 'users.username', 'users.firstname', 'users.lastname','users.email', 'departments.department_name as department_name', 'users.city', 'roles.name as rolename', 'users.confirmed'));

        return Datatables::of($users)

        ->edit_column('confirmed',
					'@if($confirmed)
              Yes
          @else
              No
          @endif')

        ->add_column('actions',
					'<a href="{{{ URL::to(\'users/\' . $id . \'/show\' ) }}}" class="btn btn-xs btn-default">{{{ Lang::get(\'button.show\') }}}</a>	
					<a href="{{{ URL::to(\'users/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
          @if($username == \'admin\')
          @else
              <a href="{{{ URL::to(\'users/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
          @endif')

        ->remove_column('id','username')

        ->make();
    }
		
		/**
		* Method for print to PDF
		*/
		public function getPrint() {
			$employee_datas = $this->user->all();
			$datas = '';
			$style = '<style>
								.header-meta span {
										font-weight: bold;
										margin-right: 22px;
								}								
								.header-meta {
										color: #A1A1A1;
								}
								.header-meta p {
										margin: 0 0 5px;
								}
								h2.title {
										font-family: sans-serif;
										text-align: center;
										text-transform: uppercase;
								}
								#report-table {
										border-collapse: collapse;
										font-family: Sans-Serif;
										font-size: 12px;
										margin-bottom: 20px;
										text-align: left;
										width: 100%;
								}
								#report-table th {
										background: none repeat scroll 0 0 #B9C9FE;
										border: 2px solid #AABCFE;
										box-sizing: border-box;
										color: #003399;
										font-weight: bold;
										padding: 10px;
										text-align: center;
										text-transform: uppercase;
								}
								#report-table th:first-child {
										border-left: none;
								}
								#report-table th:last-child {
										border-right: none;
								}
								#report-table td {
										background: none repeat scroll 0 0 #E8EDFF;
										border-bottom: 1px solid #FFFFFF;
										border-top: 1px solid rgba(0, 0, 0, 0);
										color: #666699;
										padding: 8px;
								}
								#report-table tr:hover td {
										background: none repeat scroll 0 0 #D0DAFD;
										color: #333399;
								}
								</style>';
			$i = 1;					
			foreach ($employee_datas as $user):
				if($user->gender == 1) {
					$gender = 'Male';
				}else{ 
					$gender = 'Female';
				}
				
				$datas .= '<tr>';
				$datas .= '<td>'.$i.'</td>';
				$datas .= '<td>'.$user->firstname.' '.$user->lastname.'</td>';
				$datas .= '<td>'.$user->user_nik.'</td>';
				$datas .= '<td>'.$gender.'</td>';
				$datas .= '<td>'.$user->identity_no.'</td>';
				$datas .= '<td>'.$this->marital->find($user->marital_status)->marital_name.'</td>';
				$datas .= '<td>'.$user->tax_status.'</td>';
				$datas .= '<td>'.$user->npwp_no.'</td>';
				$datas .= '<td>'.date('F j, Y',strtotime($user->npwp_date)).'</td>';
				$datas .= '<td>'.$user->jamsostek_no.'</td>';
				$datas .= '<td>'.$this->department->find($user->department)->department_name.'</td>';
				$datas .= '<td>'.$this->position->find($user->position)->position_name.'</td>';
				$datas .= '<td>'.$user->job_status.'</td>';
				$datas .= '<td>'.date('F j, Y',strtotime($user->joined_date)).'</td>';
				$datas .= '<td>'.$user->birth_place.'</td>';
				$datas .= '<td>'.date('F j, Y',strtotime($user->birth_date)).'</td>';
				$datas .= '<td>'.$user->address.' '.$user->city.'</td>';
				$datas .= '<td>'.$user->home_phone.'</td>';
				$datas .= '<td>'.$user->mobile_phone.'</td>';
				$datas .= '</tr>';
				$i++;
			endforeach;
			
			$html = '<html>'.$style.'<body>'
							. '<h1 class="logo">'.get_option('site_title').'</h1>'
							. '<div class="header-meta">'
							. '<p><span>Address</span>Flamboyant Square</p>'
							. '<p><span>Number</span>+62 22 6160 6021</p>'
							. '<p><span>Email</span>hello@alphaomega.com</p>'
							. '</div>'
							. '<h2 class="title">Employee List</h2>'
							. '<table id="report-table">'
							. '<thead>'
							. '<tr>'
							. '<th rowspan="2">No</th>'
							. '<th rowspan="2">Name</th>'
							. '<th rowspan="2">NIK</th>'
							. '<th rowspan="2">M/F</th>'
							. '<th rowspan="2">Identity No</th>'
							. '<th colspan="2">Status</th>'
							. '<th colspan="2">NPWP</th>'
							. '<th rowspan="2">Jamsostek No</th>'
							. '<th rowspan="2">Department</th>'
							. '<th rowspan="2">Position</th>'
							. '<th rowspan="2">Job Status</th>'
							. '<th rowspan="2">Joined Date</th>'
							. '<th colspan="2">Birth Date</th>'
							. '<th rowspan="2">Address</th>'
							. '<th rowspan="2">Phone</th>'
							. '<th rowspan="2">Mobile Number</th>'
							. '</tr>'
							. '<tr>'
							. '<th>Maritals</th>'
							. '<th>Tax</th>'
							. '<th>NPWP No</th>'
							. '<th>Valid Date</th>'
							. '<th>Place</th>'
							. '<th>Date</th>'
							. '</tr>'
							. '</thead>'
							. '<tbody>'
							. $datas
							. '</tbody>'
							. '</table>'
							. '</body></html>';
			return PDF::load($html, 'A2', 'landscape')->download('employees-file');				
			//return PDF::load($html, 'A4', 'portrait')->show();
		}
}
