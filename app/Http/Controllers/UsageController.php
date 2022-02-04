<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsageRequest;
use App\Models\Usage;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->cannot('viewAny', Usage::class)){
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

        if($user->cannot('create', Usage::class)){
            abort('403');
        }

        return view('usage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UsageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsageRequest $request)
    {
        $data = $request->only(['name']);

        $newUsage = Usage::create([
            'name' => $data['name']
        ]);

        if(!$newUsage){
            abort('500');
        } else {
            return redirect()->route('usage.dashboard')->with('success', 'Nova Finalidade Criada com Sucesso!');
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
        return redirect()->route('usage.dashboard');
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

        if($user->cannot('update', Usage::class)){
            abort('403');
        }

        $usage = Usage::find($id);

        if(!$usage){
            abort('404');
        }

        return view('usage.edit', compact('usage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UsageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsageRequest $request, $id)
    {
        $usage = Usage::find($id);

        if(!$usage){
            abort('404');
        }

        $data = $request->only(['name']);
        $usage->update($data);

        return redirect()->route('usage.dashboard')->with('success', 'Dados Atualizados com Sucesso!');
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

        if($user->cannot('delete', Usage::class)){
            abort('403');
        }

        $usage = Usage::find($id);

        if(!$usage){
            abort('404');
        }

        $realties = $usage->realties->count();

        if($realties){
            return redirect()->back()->with('fail', 'A finalidade ' . $usage->name . ' não pode ser removida pois existe(m) ' . $realties . ' imóveis vinculado(s) a ela!');
        }

        $usage->delete();
        return redirect()->route('usage.dashboard')->with('success', 'Finalidade Removida com Sucesso!');
    }
}
