<?php

class ItemController extends BaseController {

	public function browse() {

		$items = Item::where('status', 'available')->orderBy('created_at', 'desc')->get();
		return View::make('browse', compact('items'));
	}

	/**
	 * Show all the details of the particular item
	 * @param  [string] $username [description]
	 * @param  [string] $itemname [description]
	 * @param  [integer] $itemid   [description]
	 * @return [type]           [description]
	 */
	public function showItem($username, $itemname, $itemid) {
		
		$swapItem     = Item::where('id', $itemid)->first();
		$items        = Item::where('user_id', Auth::user()->id)->lists('name', 'id');
		$user         = User::where('username', $username)->first();
		$comments     = Comment::where('item_id', $itemid)->orderBy('created_at', 'desc')->get();
		// $requestCount = DB::table('offers')->where('item_id', '=', $itemid)->count();
		$offers = Offer::where('item_id', $itemid)->where('status', 'pending')->get();
		// dd(Offer::find(3)->offerItems->first()->name);

		return View::make('items.show', compact('swapItem', 'items', 'user', 'comments', 'offers'));
	}


	public function showListing($username) {

		$items = Item::where('user_id', Auth::user()->id)->get();
		return View::make('users.listing', compact('items'));
	}

	public function showPostItem($username) {
		return View::make('users.post');
	}

	public function postItem() {
		
		$rules = [
		'name'        => 'required|max:60',
		'description' =>'required',
		'price'       => 'required|numeric',
		'photoURL'    => 'required|image|mimes:jpeg,jpg,bmp,gif,png'
		];

		$messages = array(
			'price.required'    => 'If you don\'t remember the price, enter the approximate value.' ,
			'photoURL.required' => 'Please upload an image of the item.',
			'photoURL.image'    => 'You need to upload an image of filetypes: jpeg, jpg, bmp, gif or png.'
		);

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$image    = Input::file('photoURL');
		$filename = date('Y-m-d-His').'-'.$image->getClientOriginalName();

		$path = public_path().'/images/items/';
		$image->move($path, $filename);

		$item              = new Item;
		$item->name        = Input::get('name');
		$item->description = Input::get('description');
		$item->price       = Input::get('price');
		$item->photoURL    = 'images/items/'.$filename;
		$item->date        = date('Y-m-d');
		$item->time        = date('H:i:s');
		$item->user_id     = Auth::user()->id;
		$item->save();
		return Redirect::back()->withMessage('Item posted successfully.');
	}
}