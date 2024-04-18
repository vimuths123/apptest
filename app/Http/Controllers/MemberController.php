<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberStoreRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Member::with('user');

        if ($request->has('search')) {
            $query->where('last_name', 'like', '%' . $request->input('search') . '%');
        }

        return inertia('Member/Index', [
            'members' => MemberResource::collection($query->latest('id')->paginate(10)->appends($request->only('search'))),
            'initialSearch' => $request->input('search', '')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Member/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberStoreRequest $request)
    {
        $data = $request->validated();

        $post = Member::create([
            ...$data,
            'user_id' => $request->user()->id,
        ]);

        return to_route('members.index')->banner('A new member added');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return inertia('Member/Edit',[
            'member' => fn () => MemberResource::make($member),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberUpdateRequest $request, Member $member)
    {
        $data = $request->validated();
        $member->update($data);

        return to_route('members.index')->banner('Member details updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return to_route('members.index')->banner('Member deleted successfully');;
    }
}
