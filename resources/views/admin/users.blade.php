@extends('layouts.library', ['title' => 'User Management'])

@section('content')

<section class="page-hero">
    <div>
        <p class="eyebrow">Admin Panel</p>
        <h1>User Management</h1>
    </div>
</section>

@if(session('success'))
    <div style="
        background:#dcfce7;
        color:#166534;
        padding:12px;
        border-radius:8px;
        margin-bottom:20px;
    ">
        {{ session('success') }}
    </div>
@endif

<div class="book-card">
    <div class="book-card__body">

        <table style="width:100%;border-collapse:collapse;">

            <thead>
                <tr>
                    <th align="left">Name</th>
                    <th align="left">Email</th>
                    <th align="left">Role</th>
                    <th align="left">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr style="border-top:1px solid #ddd;">

                        <td style="padding:15px 0;">
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ ucfirst($user->role) }}
                        </td>

                        <td>

                            @if($user->role === 'user')

                                <form
                                    method="POST"
                                    action="/admin/users/{{ $user->id }}/promote"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="button button--primary"
                                    >
                                        Make Moderator
                                    </button>
                                </form>

                            @elseif($user->role === 'moderator')

                                <form
                                    method="POST"
                                    action="/admin/users/{{ $user->id }}/demote"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="button button--danger"
                                    >
                                        Remove Moderator
                                    </button>
                                </form>

                            @else

                                <span class="pill">
                                    System Admin
                                </span>

                            @endif

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>
</div>

@endsection