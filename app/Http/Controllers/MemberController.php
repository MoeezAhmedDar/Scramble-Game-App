<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditMemberRequest;
use App\Http\Requests\StoreMemberRequest;
use App\Interfaces\MemberRepositoryInterface;
use App\Models\Game;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    private MemberRepositoryInterface $memberRepository;

    public function __construct(MemberRepositoryInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function index()
    {
        $members = Member::paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        try {
            Member::create($request->only('name', 'email', 'contact_number', 'date_joined'));
            $messages['success'] = "Member Created Successfully";

            return redirect()
                ->route('members.index')
                ->with('messages', $messages);
        } catch (\Exception $e) {
            return $this->errorMessage($e->getMessage());
        }
    }

    public function show(Member $member)
    {
        $member_detail = $this->memberRepository->getMemberDetail($member);

        return view('members.show', [
            'member' => $member,
            'member_detail' => $member_detail
        ]);
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(EditMemberRequest $request, Member $member)
    {
        try {
            $member->update([
                'name' => $request->name,
                'email' => $request->email,
                'contact_number' => $request->contact_number
            ]);
            $messages['success'] = "Member Updated Successfully";
            return redirect()
                ->route('dashboard')
                ->with('messages', $messages);
        } catch (\Exception $e) {
            return $this->errorMessage($e->getMessage());
        }
    }
}
