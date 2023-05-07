<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
use App\Models\Contact;

class InfoController extends Controller
{
  public function index()
  {
    $old = session('contact_form', []);
    if (isset($old['gender'])) {
      $old = array_merge($old, ['gender' => $old['gender'] === 1 ? 'male' : 'female']);
    }
    session()->flashInput($old);
    return view('info', compact('old'));
  }

  public function confirm(Request $request)
  {
    $validatedData = $request->validate([
      'last_name' => 'required',
      'first_name' => 'required',
      'gender' => 'required',
      'email' => 'required|email',
      'postcode' => 'required',
      'address' => 'required',
      'opinion' => 'required',
    ]);

    $gender = ($request->gender === 'male') ? 1 : 2;

    session()->put('contact_form', array_merge($validatedData, ['gender' => $gender]));

    // $request->input()が空でない場合にのみ、flashInput()を実行する
    if (!empty($request->input())) {
      session()->flashInput($request->input());
    }

    return view('confirm', compact('validatedData'));
  }

  public function complete(Request $request)
  {
    $contact_form = new ContactForm;
    $contact_form->fill(session()->get('contact_form'));

    $contact = new Contact;
    $contactData = $contact_form->toContact();

    $fullName = $contactData['last_name'] . ' ' . $contactData['first_name'];

    unset($contactData['last_name'], $contactData['first_name']);

    $contactData['fullname'] = $fullName ?? '';

    $contact->fill($contactData);
    $contact->save();

    session()->forget('contact_form');

    return view('thank');
  }

}