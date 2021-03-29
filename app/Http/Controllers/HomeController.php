<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guest.home');
    }

    // Get Contatti
    public function contatti()
    {
        return view('guest.contatti');
    }

// Post Contatti
    public function contattiSent(Request $request)
    {
        $data = $request->all();

        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        return redirect()->route('guest.contatti')->with('status', 'Mail inviata correttamente');
    }
}
