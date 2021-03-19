<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelsTracksController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 * @param Label $label
	 * 
     * @return Illuminate\View\View 
	 */
	public function index(Request $request, Label $label)
	{
		$tracks = $label->tracks()->withRelationsAndSorted($request->input())
			->orderBy('purchase_date', 'DESC')
			->paginate(48);

 		return View('labels.tracks.index', array(
 			'label' => $label,
			'tracks' => $tracks
 		));
	}
}
