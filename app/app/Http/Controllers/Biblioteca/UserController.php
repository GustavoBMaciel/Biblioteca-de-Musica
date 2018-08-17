<?php

namespace App\Http\Controllers\Biblioteca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Albun;
use App\Models\User;
use App\Models\Banda;
use Auth;
use Image;

class UserController extends Controller
{
    private $users;
    private $totalPage = 5;

    public function __construct(User $user)
    {
      $this->middleware('admins');
      $this->user = $user;
    }

    public function index(){

        $users = $this->user->paginate($this->totalPage);
        
    	return view('profile', compact('users'));
    }

    public function edit($id){

        $usersEdit = $this->user->find($id);
        
    	return view('profileupdate', compact('usersEdit'));
    }


    public function update(Request $request, $id){
        // Handle the user upload of imagem

        $dataForm = $request->all();

        $usersEditado = $this->user->find($id);

            /*if ( !$dataForm['password'] == '') 
            {
                $updates->$usersEditado->update(['password' => bcrypt($dataForm['password'])]);
            }

            $update = $usersEditado->update(['name' => $dataForm['name'],
             'email' => $dataForm['email'],
             'permissao' => $dataForm['permissao'],
            ]);

            $imagem = $request->file('imagem');
    		$filename = time() . '.' . $imagem->getClientOriginalExtension();
    		Image::make($imagem)->resize(300, 300)->save( public_path('\imgUser/' . $filename ) );
            $user->imagem = $filename;
            $user->name = $dataForm['name'];
            $user->email = $dataForm['email'];
            $user->permissao = $dataForm['permissao'];
            $user->password = bcrypt($dataForm['password']);
            $user->update();*/

            $imageName = $request->id . '.' .
            $request->file('imagem')->getClientOriginalName();
        
            $image = $request->file('imagem')->move(base_path() . '\public\imgUser', $imageName);
    
              $update = $usersEditado->update([
                'name' => $dataForm['name'],
                'imagem' => $imageName,
                'email' => $dataForm['email'],
                'permissao' => $dataForm['permissao'],
                'password' => bcrypt($dataForm['password'])]);

            return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $userDestroy = $this->user->find($id);

        //*dd($userDestroy);

        if($userDestroy->id != 1)
        {
        $delete = $userDestroy->delete();
    
        return redirect()->route('users.index');
        }
        else
        return redirect()->route('users.index', $id)->with(['errors' => 'Voce não pode excluir o usuario padrao!']);
    }
}
