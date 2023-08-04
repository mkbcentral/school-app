<?php

namespace App\Http\Livewire\Application\Auth;

use App\Http\Livewire\Helpers\AuthUserHleper;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class Login extends Component
{
    public ?string $email, $password;
    public function loginUser()
    {
        $data = $this->validate([
            'email' => ['string', 'required','email', 'min:6'],
            'password' => ['required', 'string', 'min:6']
        ]);
        try {
            if (AuthUserHleper::login($data)){
                if (Auth::user()->hasRole('App-Admin')){
                    return redirect()->route('main');
                }elseif(Auth::user()->hasRole('Super-Admin')){
                    if (auth()->user()->school == null){
                        return redirect()->route('school.create');
                    }else{
                        return redirect()->route('main');
                    }
                }
                $this->dispatchBrowserEvent('added', ['message' => "Connexion bien établie !"]);
            }else{
                $this->dispatchBrowserEvent('error', ['message' => "'Email ou mot de password incorrect.'"]);
            }

        } catch (\Exception $ex) {
            $this->dispatchBrowserEvent('error', ['message' => $ex->getMessage()]);
        }

    }
    public function render()
    {

        return view('livewire.application.auth.login');
    }
}
