<?php

class AdminDepartmentsController extends AdminController {


    /**
     * Department Model
     * @var Department
     */
    protected $department;

    /**
     * Inject the models.
     * @param Department $department
     */
    public function __construct(Department $department)
    {
        parent::__construct();
        $this->department = $department;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/departments/title.department_management');

        // Grab all the departments
        $departments = $this->department;

        // Show the page
        return View::make('admin/departments/index', compact('departments', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {

		// Title
		$title = Lang::get('admin/departments/title.create_a_new_department');

		// Mode
		$mode = 'create';

		// Show the page
		return View::make('admin/departments/create_edit', compact('title', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $this->department->department_name = Input::get( 'department_name' );
        $this->department->notes = Input::get( 'notes' );

        // Save if valid. Password field will be hashed before save
        $this->department->save();

        if ( $this->department->department_id )
        {

            // Redirect to the new department page
            return Redirect::to('departments/' . $this->department->department_id . '/edit')->with('success', Lang::get('admin/departments/messages.create.success'));
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->department->errors()->all();

            return Redirect::to('departments/create')
                ->with( 'error', $error );
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $department
     * @return Response
     */
    public function getEdit($department)
    {
        if ( $department->department_id )
        {

            // Title
        	$title = Lang::get('admin/departments/title.department_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/departments/create_edit', compact('department', 'title', 'mode'));
        }
        else
        {
            return Redirect::to('departments')->with('error', Lang::get('admin/departments/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $department
     * @return Response
     */
    public function postEdit($department)
    {
        $rules = array(
            'department_name' => 'required|min:3'
        );
				
        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->passes())
        {
            $department->department_name = Input::get( 'department_name' );
            $department->notes = Input::get( 'notes' );

            // Handles updating.
            if($department->save()){
						
							// Redirect to the new department page
							return Redirect::to('departments/' . $department->department_id . '/edit')->with('success', Lang::get('admin/departments/messages.edit.success'));
						
						}else {
							return Redirect::to('departments/' . $department->department_id . '/edit')->with('error', Lang::get('admin/departments/messages.edit.error'));
						}
        } 
				
				// Form validation failed
        return Redirect::to('departments/' . $department->department_id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove department page.
     *
     * @param $department
     * @return Response
     */
    public function getDelete($department)
    {
        // Title
        $title = Lang::get('admin/departments/title.department_delete');

        // Show the page
        return View::make('admin/departments/delete', compact('department', 'title'));
    }

    /**
     * Remove the specified department from storage.
     *
     * @param $department
     * @return Response
     */
    public function postDelete($department)
    {
        // Declare the rules for the form validation
        $rules = array(
            'department_id' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $department->department_id;
            $department->delete();

            // Was the department deleted?
            $department = Department::find($id);
            if(empty($department))
            {
                // Redirect to the department management page
                return Redirect::to('departments')->with('success', Lang::get('admin/departments/messages.delete.success'));
            }
        }
        // There was a problem deleting the department
        return Redirect::to('admin/departments')->with('error', Lang::get('admin/departments/messages.delete.error'));
				
    }

    /**
     * Show a list of all the departments formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $departments = Department::select(array('departments.department_id', 'departments.department_name', 'departments.notes'));
				

        return Datatables::of($departments)

        ->add_column('actions', 
					'<a href="{{{ URL::to(\'departments/\' . $department_id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
          <a href="{{{ URL::to(\'departments/\' . $department_id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>')

        ->make();
    }
		
}
