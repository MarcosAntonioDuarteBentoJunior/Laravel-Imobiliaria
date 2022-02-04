<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Usage;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->cannot('viewAny', Category::class)){
            abort('403');
        }
        
        $categories = Category::paginate(5);
        $usages = Usage::paginate(5);

        return view('admin.dashboard', compact('categories', 'usages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if($user->cannot('create', Category::class)){
            abort('403');
        }

        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->only(['name']);

        $newCateogry = Category::create([
            'name' => $data['name']
        ]);

        if(!$newCateogry){
            abort('500');
        } else {
            return redirect()->route('category.dashboard')->with('success', 'Categoria Criada com Sucesso!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('category.dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        if($user->cannot('update', Category::class)){
            abort('403');
        }

        $category = Category::find($id);

        if(!$category){
            abort('404');
        }

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if(!$category){
            abort('404');
        }

        $data = $request->only(['name']);
        $category->update($data);

        return redirect()->route('category.dashboard')->with('success', 'Dados Atualizados com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if($user->cannot('delete', Category::class)){
            abort('403');
        }

        $category = Category::find($id);

        if(!$category){
            abort('404');
        }

        $realties = $category->realties->count();

        if($realties){
            return redirect()->back()->with('fail', 'A categoria ' . $category->name . ' não pode ser removida pois existe(m) ' . $realties . ' imóveis vinculado(s) a ela!');
        }

        $category->delete();
        return redirect()->route('category.dashboard')->with('success', 'Categoria Removida com Sucesso!');
    }
}
