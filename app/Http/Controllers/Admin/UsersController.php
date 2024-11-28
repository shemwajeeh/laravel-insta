<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\Mime\DraftEmail;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function index()
    {
        // withTrashed() - include the soft deleted records in a qquery's result
        $all_users = $this->user->withTrashed()->latest()->paginate(10);
        return view('admin.users.index')->with('all_users', $all_users);
    }

    // This will soft delete the user since we declared/used SoftDeletes in User model.
    public function deactivate($id)
    {
        $this->user->destroy($id);
        return redirect()->back();
    }

    public function activate($id)
    {
        // onlyTrashed() - Select soft deleted records only.
        // restore() - "un-delete" a soft deleted record.
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
