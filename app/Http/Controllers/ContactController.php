<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
  public function index(Request $request)
  {
    $fullname = $request->input('fullname');
    $gender = $request->input('gender');
    $email = $request->input('email');
    $created_at_start = $request->input('created_at_start');
    $created_at_end = $request->input('created_at_end');

    $contacts = Contact::query();

    if ($fullname) {
      $contacts->where('fullname', 'like', '%' . $fullname . '%');
    }
    if ($gender) {
      $contacts->where('gender', $gender);
    }
    if ($email) {
      $contacts->where('email', 'like', '%' . $email . '%');
    }
    if ($created_at_start) {
      $contacts->whereDate('created_at', '>=', $created_at_start);
    }
    if ($created_at_end) {
      $contacts->whereDate('created_at', '<=', $created_at_end);
    }

    $contacts = $contacts->orderBy('id', 'desc')->paginate(10);

    return view('control', compact('contacts', 'fullname', 'gender', 'email', 'created_at_start', 'created_at_end'));
  }

  public function destroy($id)
  {
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->route('control');
  }
}
