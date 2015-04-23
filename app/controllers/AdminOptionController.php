<?php

class AdminOptionController extends AdminController {


    /**
     * Option Model
     * @var Option
     */
    protected $option;

    /**
     * Inject the models.
     * @param Option $option
     */
    public function __construct(Option $option)
    {
        parent::__construct();
        $this->option = $option;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/options/title.page_title');

        // Grab all the options
        $options['site_title'] = $this->option->get_option('site_title');

        // Show the page
        return View::make('admin/setting', compact('options','title'));
    }
		
		/**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postSave()
    {
			$input = Input::get('site_title');
			$default = $this->option->get_option('site_title');
			
			if($input!=$default){
				$option = Option::find('site_title');
				if($option){
					$option->option_value = $input;
					$option->save();
					return Redirect::to('settings')->with('success', Lang::get('admin/settings/messages.save.success'));
				}else{
					return Redirect::to('settings')->with('error', Lang::get('admin/settings/messages.save.error'));
				}
			}
			
			return Redirect::to('settings');
		}
}
