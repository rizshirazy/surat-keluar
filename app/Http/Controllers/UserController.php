<?php

namespace App\Http\Controllers;

use App\Disposition;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = User::query();

            return DataTables::of($query)
                ->editColumn('is_active', function ($item) {
                    return  $item->is_active == 'Y' ? 'Aktif' : 'Tidak Aktif';
                })
                ->addColumn('action', function ($item) {
                    $action = '';

                    if (role('SUPER ADMIN')) {
                        $action .=
                            '<a href="' . route('user.edit', $item->id) . '" class="btn btn-light" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    }

                    $action .= '<a href="' . route('user.show', $item->id) . '" class="btn btn-light" title="Detail"><i class="fas fa-chevron-right"></i></a>';

                    return '<div class="btn-group" role="group">' . $action . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->all();

        $data['password'] = Hash::make('password');
        $data['nip'] = str_replace(' ', '', $data['nip']);
        $data['role_id'] = 2;

        $user = User::create($data);

        return redirect()->route('user.index')
            ->with('success', 'Pengguna ' . $user->name . ' berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('pages.user.show', [
            'data' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (role('SUPER ADMIN')) {
            return view('pages.user.edit', [
                'data' => $user
            ]);
        }

        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        $data['nip'] = str_replace(' ', '', $data['nip']);
        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'Pengguna ' . $user->name . ' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $data = $request->validated();

        User::find(Auth::id())->update([
            'password' => Hash::make($data['new_password'])
        ]);

        return redirect()->route('password.change.view')
            ->with('success', 'Password anda berhasil diperbarui');
    }

    // API
    public function populateUserDisposition(Request $request)
    {

        $id = $request->input('id');
        $q = $request->input('q');
        $data = [];

        if ($id && $q) {
            $user = Disposition::where('id', $id)->firstOrFail()->user_id;

            $data = User::where('id', '!=', $user)
                ->whereRaw("UPPER(TRIM(name)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->orWhereRaw("UPPER(TRIM(position)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->where('role_id', 2)
                ->orderBy('name', 'asc')
                ->get();
        } else if ($id) {
            $user = Disposition::where('id', $id)->firstOrFail()->user_id;

            $data = User::where('role_id', 2)
                ->where('id', '!=', $user)
                ->orderBy('name', 'asc')
                ->get();
        } else if ($q) {
            $data = User::whereRaw("UPPER(TRIM(name)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->orWhereRaw("UPPER(TRIM(position)) LIKE UPPER(TRIM('%{$q}%'))", [$q])
                ->where('role_id', 2)
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $data = User::where('role_id', 2)
                ->orderBy('name', 'asc')
                ->get();
        }

        $i = 0;
        $rows = array();

        foreach ($data as $row) {
            $rows[$i]['id'] = $row->id;
            $rows[$i]['text'] = $row->name . " - " . $row->position;
            $i++;
        }

        return [
            'items' => $rows
        ];
    }
}
