<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <div>
        <a href="{{ route('tasks.index') }}">Task</a>
        <a href="{{ route('tasks.create') }}">Create Task</a>
    </div>
    <!-- Display success message -->
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

</body>
</html>