<?php

class AdminMaritalsController extends AdminController {


    /**
     * Marital Model
     * @var Marital
     */
    protected $marital;

    /**
     * Inject the models.
     * @param Marital $marital
     */
    public function __construct(Marital $marital)
    {
        parent::__construct();
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
        $title = Lang::get('admin/maritals/title.marital_management');

        // Grab all the maritals
        $maritals = $this->marital;

        // Show the page
        return View::make('admin/maritals/index', compact('maritals', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {

		// Title
		$title = Lang::get('admin/maritals/title.create_a_new_marital');

		// Mode
		$mode = 'create';

		// Show the page
		return View::make('admin/maritals/create_edit', compact('title', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $this->marital->marital_name = Input::get( 'marital_name' );
        $this->marital->notes = Input::get( 'notes' );

        // Save if valid. Password field will be hashed before save
        $this->marital->save();

        if ( $this->marital->marital_id )
        {

            // Redirect to the new marital page
            return Redirect::to('maritals/' . $this->marital->marital_id . '/edit')->with('success', Lang::get('admin/maritals/messages.create.success'));
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->marital->errors()->all();

            return Redirect::to('maritals/create')
                ->with( 'error', $error );
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $marital
     * @return Response
     */
    public function getEdit($marital)
    {
        if ( $marital->marital_id )
        {

            // Title
        	$title = Lang::get('admin/maritals/title.marital_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/maritals/create_edit', compact('marital', 'title', 'mode'));
        }
        else
        {
            return Redirect::to('maritals')->with('error', Lang::get('admin/maritals/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $marital
     * @return Response
     */
    public function postEdit($marital)
    {
        $rules = array(
            'marital_name' => 'required|min:3'
        );
				
        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->passes())
        {
            $marital->marital_name = Input::get( 'marital_name' );
            $marital->notes = Input::get( 'notes' );

            // Handles updating.
            if($marital->save()){
						
							// Redirect to the new marital page
							return Redirect::to('maritals/' . $marital->marital_id . '/edit')->with('success', Lang::get('admin/maritals/messages.edit.success'));
						
						}else {
							return Redirect::to('maritals/' . $marital->marital_id . '/edit')->with('error', Lang::get('admin/maritals/messages.edit.error'));
						}
        } 
				
				// Form validation failed
        return Redirect::to('maritals/' . $marital->marital_id . '/edit')->withInput()->withErrors($validator);
    }

    /**
     * Remove marital page.
     *
     * @param $marital
     * @return Response
     */
    public function getDelete($marital)
    {
        // Title
        $title = Lang::get('admin/maritals/title.marital_delete');

        // Show the page
        return View::make('admin/maritals/delete', compact('marital', 'title'));
    }

    /**
     * Remove the specified marital from storage.
     *
     * @param $marital
     * @return Response
     */
    public function postDelete($marital)
    {
        // Declare the rules for the form validation
        $rules = array(
            'marital_id' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $marital->marital_id;
            $marital->delete();

            // Was the marital deleted?
            $marital = Marital::find($id);
            if(empty($marital))
            {
                // Redirect to the marital management page
                return Redirect::to('maritals')->with('success', Lang::get('admin/maritals/messages.delete.success'));
            }
        }
        // There was a problem deleting the marital
        return Redirect::to('admin/maritals')->with('error', Lang::get('admin/maritals/messages.delete.error'));
    }

    /**
     * Show a list of all the maritals formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $maritals = Marital::select(array('maritals.marital_id', 'maritals.marital_name', 'maritals.notes'));
				

        return Datatables::of($maritals)

        ->add_column('actions', 
					'<a href="{{{ URL::to(\'maritals/\' . $marital_id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
          <a href="{{{ URL::to(\'maritals/\' . $marital_id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>')

        ->make();
    }
		
}
