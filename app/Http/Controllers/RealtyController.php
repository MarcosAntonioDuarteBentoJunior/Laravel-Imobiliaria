<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Usage;
use Illuminate\Http\Request;
use App\Http\Requests\RealtyRequest;
use App\Mail\UserEmail;
use App\Models\Realty;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RealtyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $realties = Realty::all();

        return view('welcome', compact('realties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if($user->cannot('create', Realty::class)){
            abort('403');
        }

        $categories = Category::all();
        $usages = Usage::all();

        return view('realty.create', compact('categories', 'usages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RealtyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RealtyRequest $request)
    {
        $data = $request->only(['name', 'rooms', 'value', 'description', 'area', 'bedrooms', 'bathrooms', 'parking', 'usage_id', 'category_id']);
        $data['user_id'] = Auth::id();
        $data['value'] = str_replace(',', '.', $data['value']);
        $data['value'] = str_replace('-', '', $data['value']);
        $data['area'] = str_replace(',', '.', $data['area']);
        $data['area'] = str_replace('-', '', $data['area']);

        $slug = new Slugify();
        $data['slug'] = $slug->slugify($data['name']);

        $realty = Realty::create($data);

        if($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image_path');

            $realty->photos()->createMany($images);
        }

        $adress = $request->only(['street', 'number', 'district', 'city']);

        if(!is_null($adress['number']) && !is_numeric($adress['number'])){
            return redirect()->route('realty.create')->with('fail', 'Número do imóvel inválido!');
        }

        $realty->adress()->create($adress);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $realty = Realty::whereSlug($slug)->first();

        if(!$realty){
            abort('404');
        }

        return view('realty.show', compact('realty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = Auth::user();
        $realty = Realty::whereSlug($slug)->first();

        if(!$realty){
            abort('404');
        }

        if($user->cannot('update', $realty)){
            abort('403');
        }

        $categories = Category::all();
        $usages = Usage::all();

        return view('realty.edit', compact('realty', 'categories', 'usages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RealtyRequest  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(RealtyRequest $request, $slug)
    {
        $realty = Realty::whereSlug($slug)->first();

        if(!$realty){
            abort('404');
        }

        $data = $request->only(['name', 'rooms', 'value', 'description', 'area', 'bedrooms', 'bathrooms', 'parking', 'usage_id', 'category_id']);
        $data['user_id'] = Auth::id();
        $data['value'] = str_replace(',', '.', $data['value']);
        $data['value'] = str_replace('-', '', $data['value']);
        $data['area'] = str_replace(',', '.', $data['area']);
        $data['area'] = str_replace('-', '', $data['area']);

        if(!strcmp($data['name'], $realty->name)){
            $data['slug'] = $realty->slug;
        } else {
            $slug = new Slugify();
            $data['slug'] = $slug->slugify($data['name']);
        }

        $realty->update($data);

        if($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image_path');

            $realty->photos()->createMany($images);
        }

        $adress = $request->only(['street', 'number', 'district', 'city']);

        if(!is_null($adress['number']) && !is_numeric($adress['number'])){
            return redirect()->route('realty.edit', $realty->slug)->with('fail', 'Número do imóvel inválido!');
        }

        $realty->adress()->update($adress);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user = Auth::user();
        $realty = Realty::whereSlug($slug)->first();

        if($user->cannot('update', $realty)){
            abort('403');
        }

        if(!$realty){
            abort('404');
        }

        $realty->delete();
        return redirect('/');
    }

    private function imageUpload($images, $imageColumn = null)
	{
		$uploadedImages = [];

		if(is_array($images)) {

			foreach($images as $image) {
					$uploadedImages[] = [$imageColumn => $image->store('realties', 'public')];
			}

		} else {
			$uploadedImages = $images->store('realties', 'public');
		}

		return $uploadedImages;
	}

    public function category($id)
    {
        $category = Category::find($id);

        if(!$category){
            abort('404');
        }

        $realties = $category->realties;
        return view('welcome', compact('realties'));
    }

    public function usage($id)
    {
        $usage = Usage::find($id);

        if(!$usage){
            abort('404');
        }

        $realties = $usage->realties;
        return view('welcome', compact('realties'));
    }
    
    public function search(Request $request)
    {
        $data = $request->only(['rooms', 'bedrooms', 'bathrooms', 'parking', 'city']);

        $bedrooms = $data['rooms'] ? $data['rooms'] : 1;
        $bedrooms = $data['bedrooms'] ? $data['bedrooms'] : 1;
        $bathrooms = $data['bathrooms'] ? $data['bathrooms'] : 1;
        $parking = $data['parking'] ? $data['parking'] : 0;
        $city = $data['city'] ? $data['city'] : 'Serra Negra';

        $realties = Realty::join('adresses', 'realties.id', '=', 'adresses.realty_id')
                                        ->orWhere('bedrooms', '=', $bedrooms)
                                        ->orWhere('bathrooms', '=', $bathrooms)
                                        ->orWhere('parking', '=', $parking)
                                        ->orWhere('city', '=', $city)
                                        ->get();

        return view('welcome', compact('realties'));
    }

    public function appointment($slug)
    {
        $user = Auth::user();

        Mail::to($user->email)->send(new UserEmail($user));

        $realty = Realty::whereSlug($slug)->first();

        if(!$realty){
            abort('404');
        }

        return redirect()->route('realty.show', $realty->slug)->with('success', 'Um e-mail foi enviado para ' . $user->email. ' com os detalhes para agendar uma visita');
    }   
}
