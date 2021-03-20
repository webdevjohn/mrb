<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelsTracksController extends Controller
{
	/**
	 * Display all tracks for a given label.
	 *
	 * @param Request $request
	 * @param Label $label
	 * 
     * @return Illuminate\View\View 
	 */
	public function index(Request $request, Label $label)
	{
		$tracks = $label->tracks()->withFilters($request->input())->paginate(48);

 		return View('labels.tracks.index', array(
 			'label' => $label,
			'tracks' => $tracks
 		));
	}
}
