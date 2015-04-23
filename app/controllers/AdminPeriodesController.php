<?php

class AdminPeriodesController extends AdminController {


    /**
     * Periode Model
     * @var Periode
     */
    protected $periode;
		
		/**
     * User Model
     * @var User
     */
    protected $user;
		
		/**
     * Position Model
     * @var Position
     */
    protected $position;
		
    /**
     * Inject the models.
     * @param Periode $periode
     */
    public function __construct(Periode $periode, User $user, Position $position)
    {
        parent::__construct();
        $this->periode = $periode;
				$this->user = $user;
				$this->position = $position;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/periodes/title.periode_management');

        // Grab all the periodes
        $periodes = $this->periode;

        // Show the page
        return View::make('admin/periodes/index', compact('periodes', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
			// Get all the available users
			$users = $this->user->all();
		
			// Get all the available positions
			$positions = $this->position->all();
					
			// Title
			$title = Lang::get('admin/periodes/title.create_a_new_periode');
	
			// Mode
			$mode = 'create';
	
			// Show the page
			return View::make('admin/periodes/create_edit', compact('title', 'users', 'positions', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $this->periode->user_id = Input::get( 'user_id' );
				$this->periode->position_id = Input::get( 'position_id' );
				$this->periode->start_date = Input::get( 'start_date' );
				$this->periode->end_date = Input::get( 'end_date' );
				$this->periode->request_pay_date = Input::get( 'request_pay_date' );
				$this->periode->accept_pay_date = Input::get( 'accept_pay_date' );
				$this->periode->salary = Input::get( 'salary' );
				$this->periode->status = Input::get( 'status' );
        $this->periode->notes = Input::get( 'notes' );

        // Save if valid. Password field will be hashed before save
        $this->periode->save();

        if ( $this->periode->periode_id )
        {

            // Redirect to the new periode page
            return Redirect::to('periodes/' . $this->periode->periode_id . '/edit')->with('success', Lang::get('admin/periodes/messages.create.success'));
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->periode->errors()->all();

            return Redirect::to('periodes/create')
                ->with( 'error', $error );
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $periode
     * @return Response
     */
    public function getEdit($periode)
    {
        if ( $periode->periode_id )
        {
					
					$users = $this->user->all();
					$positions = $this->position->all();
					
          // Title
        	$title = Lang::get('admin/periodes/title.periode_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/periodes/create_edit', compact('periode', 'users', 'positions', 'title', 'mode'));
        }
        else
        {
            return Redirect::to('periodes')->with('error', Lang::get('admin/periodes/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $periode
     * @return Response
     */
    public function postEdit($periode)
    {
        $rules = array(
            'user_id' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);
				
        if ($validator->passes())
        {
            $periode->user_id = Input::get( 'user_id' );
						$periode->position_id = Input::get( 'position_id' );
						$periode->start_date = Input::get( 'start_date' );
						$periode->end_date = Input::get( 'end_date' );
						$periode->request_pay_date = Input::get( 'request_pay_date' );
						$periode->accept_pay_date = Input::get( 'accept_pay_date' );
						$periode->salary = Input::get( 'salary' );
						$periode->status = Input::get( 'status' );
            $periode->notes = Input::get( 'notes' );

            // Handles updating.
            if($periode->save()){
						
							// Redirect to the new periode page
							return Redirect::to('periodes/' . $periode->periode_id . '/edit')->with('success', Lang::get('admin/periodes/messages.edit.success'));
						
						}else {
							return Redirect::to('periodes/' . $periode->periode_id . '/edit')->with('error', Lang::get('admin/periodes/messages.edit.error'));
						}
        } 
				
				// Form validation failed
        return Redirect::to('periodes/' . $periode->periode_id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove periode page.
     *
     * @param $periode
     * @return Response
     */
    public function getDelete($periode)
    {
        // Title
        $title = Lang::get('admin/periodes/title.periode_delete');

        // Show the page
        return View::make('admin/periodes/delete', compact('periode', 'title'));
    }

    /**
     * Remove the specified periode from storage.
     *
     * @param $periode
     * @return Response
     */
    public function postDelete($periode)
    {
        // Declare the rules for the form validation
        $rules = array(
            'periode_id' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $periode->periode_id;
            $periode->delete();

            // Was the periode deleted?
            $periode = Periode::find($id);
            if(empty($periode))
            {
                // Redirect to the periode management page
                return Redirect::to('periodes')->with('success', Lang::get('admin/periodes/messages.delete.success'));
            }
        }
        // There was a problem deleting the periode
        return Redirect::to('admin/periodes')->with('error', Lang::get('admin/periodes/messages.delete.error'));
				
    }

    /**
     * Show a list of all the periodes formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $periodes = Periode::leftjoin('users', 'users.id', '=', 'periodes.user_id')
														->leftjoin('departments', 'departments.department_id', '=', 'users.department')
														->leftjoin('positions', 'positions.position_id', '=', 'periodes.position_id')
														->select(array('periodes.periode_id', 'users.user_nik', 'users.firstname as firstname', 'departments.department_name as department_name', 'positions.position_name', 'periodes.start_date', 'periodes.end_date', 'periodes.salary', 'periodes.status'));
				

        return Datatables::of($periodes)
				
        ->add_column('actions', 
					'<a href="{{{ URL::to(\'periodes/\' . $periode_id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
          <a href="{{{ URL::to(\'periodes/\' . $periode_id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>')
				
				->remove_column('periode_id')
				
        ->make();
    }
		
		/**
		* Method for print to PDF
		*/
		public function getPrint() {
			$periode_datas = $this->periode->all();
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
			foreach ($periode_datas as $period):
				if($this->user->find($period->user_id)->gender == 1) {
					$gender = 'Male';
				}else{ 
					$gender = 'Female';
				}
				
				$datas .= '<tr>';
				$datas .= '<td>'.$i.'</td>';
				$datas .= '<td>'.$this->user->find($period->user_id)->user_nik.'</td>';
				$datas .= '<td>'.$this->user->find($period->user_id)->firstname.' '.$this->user->find($period->user_id)->lastname.'</td>';
				$datas .= '<td>'.$gender.'</td>';
				$datas .= '<td>'.Department::find($this->user->find($period->user_id)->department)->department_name.'</td>';
				$datas .= '<td>'.$this->position->find($period->position_id)->position_name.'</td>';
				$datas .= '<td>'.date('F j, Y', strtotime($period->start_date)).'</td>';
				$datas .= '<td>'.date('F j, Y', strtotime($period->end_date)).'</td>';
				$datas .= '<td>'.$period->salary.'</td>';
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
							. '<h2 class="title">Periode List of Employee</h2>'
							. '<table id="report-table">'
							. '<thead>'
							. '<tr>'
							. '<th>No</th>'
							. '<th>Employee NIK</th>'
							. '<th>Employee Name</th>'
							. '<th>Gender</th>'
							. '<th>Department</th>'
							. '<th>Position</th>'
							. '<th>Start Date</th>'
							. '<th>End Date</th>'
							. '<th>Salary</th>'
							. '</tr>'
							. '</thead>'
							. '<tbody>'
							. $datas
							. '</tbody>'
							. '</table>'
							. '</body></html>';
			return PDF::load($html, 'A2', 'landscape')->download('periodes-file');				
			//return PDF::load($html, 'A4', 'portrait')->show();
		}
}
