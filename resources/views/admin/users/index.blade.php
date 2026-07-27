@extends('layouts.app')

@section('content')

<div class="p-8">

    <div class="flex justify-between mb-6">

        <h1 class="text-3xl font-bold">

            Users

        </h1>

        <a href="{{ route('users.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">

            Add User

        </a>

    </div>

    <form>

        <input
            type="text"
            name="search"
            placeholder="Search..."
            class="border rounded px-3 py-2 w-80"
            value="{{ request('search') }}">

    </form>

    @if(session('success'))

    <div class="bg-green-100 border border-gree-500 text-green-700 p-4 rounded mb-5">
        {{session('success')}}
    </div>
    
    @endif

    <table class="w-full mt-5 border">

        <thead>

        <tr>

            <th>Name</th>

            <th>Email</th>

            <th>Role</th>

            <th>Status</th>

            <th width="220">

                Actions

            </th>

        </tr>

        </thead>

        <tbody>

        @foreach($users as $user)

        <tr>

            <td>{{ $user->name }}</td>

            <td>{{ $user->email }}</td>

            <td>{{ $user->role }}</td>

            <td>{{ $user->status }}</td>

            <td>

                <a href="{{ route('users.show',$user) }}">

                    View

                </a>

                |

                <a href="{{ route('users.edit',$user) }}">

                    Edit

                </a>

                |

                <form
                    action="{{ route('users.destroy',$user) }}"
                    method="POST"
                    style="display:inline;">

                    @csrf

                    @method('DELETE')

                    <button>

                        Delete

                    </button>

                </form>

            </td>

        </tr>

        @endforeach

        </tbody>

    </table>

    <div class="mt-5">

        {{ $users->links() }}

    </div>

</div>

@endsection