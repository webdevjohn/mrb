<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Repositories\TrackRepository;

class LabelsTracksController extends Controller
{
	public function __construct(
		protected TrackRepository $tracks
	){}


	/**
	 * Display a listing of the resource.
	 * GET /labels/{$label}/tracks
	 *
	 * @param Request $request
	 * @param Label $label
	 * 
	 * @return Response
	 */
	public function index(Request $request, Label $label)
	{
 		return View('labels.tracks.index', array(
 			'label' => $label,
			'labelTracks' => $this->tracks->byLabel($label->id, $request->input()),
			'tracksYearCount' => $this->tracks->getTracksYearCountByLabel($label->id, $request->input()),
 		));
	}
}
