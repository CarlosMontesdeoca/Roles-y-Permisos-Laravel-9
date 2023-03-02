<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\PermissionResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @index permitir obtener todos los usuarios Activos y creados(sin aceptar terminos y condiciones)".
     */
    public function permissions(){
        return response()->json(PermissionResource::collection(DB::select('select * from permissions')), 200);
    }

    public function change(User $user, Request $request){
        $user->syncPermissions($request->permissions);
        return response()->json('permissions changed success', 200);
    }
    
    /**
     * @index permitir obtener todos los usuarios Activos y creados(sin aceptar terminos y condiciones)".
     */
    public function index(){
        return response()->json(UserResource::collection(User::where('est', 'A')->orwhere('est', 'C')->get()), 200);
    }
    /**
     * @authenticate evalua las credenciales enviadas para crear un token de acceso
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('usr', 'password');
        if(User::firstWhere('usr', $request->usr)->est === 'I'){
            return response()->json('invalid_credentials',400);
        } else {
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json('invalid_credentials', 400);
                }
            } catch (JWTException $e) {
                return response()->json('could_not_create_token', 500);
            }
            $permissions = User::firstWhere('usr', $request->usr)->getPermissionNames();
            $id = User::firstWhere('usr', $request->usr)->id;
            $name = User::firstWhere('usr', $request->usr)->nom;
            return response()->json(compact('id', 'permissions', 'name', 'token'));
        }
    }

    /**
     * @register recive y valida toda la informacion para crear un nuevo usuario en el sitema
     * al recibir el password aplica la funcion Hash para encriptar la clave
     * 
     * JWTAuth recibe la instancia $user y en base a esa informacion crea un token unico como respuesta del servidor y lo almacena en su cache.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:50',
            'usr' => 'required|string|max:15',
            'email' => 'required|string|email|max:40|unique:users',
            'password' => 'required|string|min:6',
            'carg' => 'required|string|max:25',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'nom' => $request->get('nom'),
            'usr' => $request->get('usr'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'carg' => $request->get('carg'),
        ]);
        // $token = JWTAuth::fromUser($user);
        $user->givePermissionTo($request->permissions);
        return response()->json(compact('user'),201);
    }

    /**
     * @getAuthenticatedUser recibe solamente un token generado por el sistema, y busca en su cache el estado de ese token,
     * si encuentra un error con el token genera un error respectivo y si el token es totalmente valido devuelve la informacion
     * del usuario relacionado al token.
     */
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        $aux = array($user, $user->getRoleNames());
        return new UserResource($aux[0]);
    }

    /**
     * @update Edita la informacion registrada del usuario
     */
    public function update(Request $request, User $user) {
        $user->update($request->all());
        return response()->json($user, 200);
    }
}
