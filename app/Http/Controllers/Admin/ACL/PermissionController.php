<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\Permission;


class PermissionController extends Controller
{
    protected $repository;

    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
        // $this->middleware(['can:permissions']);
    }
    //
    //   
    public function index()
    {
        
        $permissions = $this->repository->paginate();

        return view('admin.pages.permissions.index', compact('permissions'));
    }
    //
    //
    public function create()
    {
        return view('admin.pages.permissions.create');
    }
    //
    //
    public function store(StoreUpdatePermission $request)
    {
        $permission =  $this->repository->create($request->all());
        if(!$permission){
            return redirect()->back()->with('error','Operações Não Realizadas!'); 
        }
        return redirect()->route('permissions.index')->with('message','Operações Realizadas com Sucesso!');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back()->with('error','Operações Não Realizadas!');;
        }

        return view('admin.pages.permissions.show', compact('permission'));
    }
    //
    //
    public function edit($id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.permissions.edit', compact('permission')); 
    }
    //
    //
    public function update(StoreUpdatePermission $request, $id)
    {
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back()->with('error','Operações Não Realizadas!'); 
        }

        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('message','Operações Realizadas com Sucesso!');;
    }
    //
    //
    public function destroy($id)
    {       
        if (!$permission = $this->repository->find($id)) {
            return redirect()->back()->with('error','Operações Não Realizadas!'); 
        }        

        $permission->delete();
        
        return redirect()->route('permissions.index')->with('message','Registro deletado com Sucesso!');
    }
    //
    //
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $permissions = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->where('name', $request->filter)
                                          ->orWhere('description', 'LIKE', "%{$request->filter}%");
                                }
                            })
                            ->paginate();

        return view('admin.pages.permissions.index', compact('permissions', 'filters'));
    }
    //
    //
    
}
