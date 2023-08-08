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
                $this->dispatchBrowserEvent('added', ['message' => "Connexion bien établie !"]);
                return redirect()->route('main');
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
