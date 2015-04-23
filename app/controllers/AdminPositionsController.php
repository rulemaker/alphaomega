<?php

class AdminPositionsController extends AdminController {


    /**
     * Position Model
     * @var Position
     */
    protected $position;

    /**
     * Inject the models.
     * @param Position $position
     */
    public function __construct(Position $position)
    {
        parent::__construct();
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
        $title = Lang::get('admin/positions/title.position_management');

        // Grab all the positions
        $positions = $this->position;

        // Show the page
        return View::make('admin/positions/index', compact('positions', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {

		// Title
		$title = Lang::get('admin/positions/title.create_a_new_position');

		// Mode
		$mode = 'create';

		// Show the page
		return View::make('admin/positions/create_edit', compact('title', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $this->position->position_name = Input::get( 'position_name' );
        $this->position->notes = Input::get( 'notes' );

        // Save if valid. Password field will be hashed before save
        $this->position->save();

        if ( $this->position->position_id )
        {

            // Redirect to the new position page
            return Redirect::to('positions/' . $this->position->position_id . '/edit')->with('success', Lang::get('admin/positions/messages.create.success'));
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->position->errors()->all();

            return Redirect::to('positions/create')
                ->with( 'error', $error );
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $position
     * @return Response
     */
    public function getEdit($position)
    {
        if ( $position->position_id )
        {

            // Title
        	$title = Lang::get('admin/positions/title.position_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/positions/create_edit', compact('position', 'title', 'mode'));
        }
        else
        {
            return Redirect::to('positions')->with('error', Lang::get('admin/positions/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $position
     * @return Response
     */
    public function postEdit($position)
    {		
				$rules = array(
            'position_name' => 'required|min:3'
        );
				
        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);


        if ($validator->passes())
        {
            $position->position_name = Input::get( 'position_name' );
            $position->notes = Input::get( 'notes' );

            // Handles updating.
            if($position->save()){
						
							// Redirect to the new position page
							return Redirect::to('positions/' . $position->position_id . '/edit')->with('success', Lang::get('admin/positions/messages.edit.success'));
						
						}else {
							return Redirect::to('positions/' . $position->position_id . '/edit')->with('error', Lang::get('admin/positions/messages.edit.error'));
						}
        } 
				
				// Form validation failed
        return Redirect::to('positions/' . $position->position_id . '/edit')->withInput()->withErrors($validator);
				
    }

    /**
     * Remove position page.
     *
     * @param $position
     * @return Response
     */
    public function getDelete($position)
    {
        // Title
        $title = Lang::get('admin/positions/title.position_delete');

        // Show the page
        return View::make('admin/positions/delete', compact('position', 'title'));
    }

    /**
     * Remove the specified position from storage.
     *
     * @param $position
     * @return Response
     */
    public function postDelete($position)
    {
				// Declare the rules for the form validation
        $rules = array(
            'position_id' => 'required'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $position->position_id;
            $position->delete();

            // Was the position deleted?
            $position = Position::find($id);
            if(empty($position))
            {
                // Redirect to the position management page
                return Redirect::to('positions')->with('success', Lang::get('admin/positions/messages.delete.success'));
            }
        }
        // There was a problem deleting the position
        return Redirect::to('admin/positions')->with('error', Lang::get('admin/positions/messages.delete.error'));
				
    }

    /**
     * Show a list of all the positions formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $positions = Position::select(array('positions.position_id', 'positions.position_name', 'positions.notes'));
				

        return Datatables::of($positions)

        ->add_column('actions', 
					'<a href="{{{ URL::to(\'positions/\' . $position_id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
          <a href="{{{ URL::to(\'positions/\' . $position_id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>')

        ->make();
    }
		
}
