<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Your Tasks</h1>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr id="task-{{ $task->id }}">
                    <td>{{ $task->nama }}</td>
                    <td>{{ $task->deskripsi }}</td>
                    <td>{{ $task->status }}</td>
                    <td>
                        @if($task->image)
                            <img src="{{ asset('storage/' . $task->image) }}" alt="Task Image" width="100">
                        @else
                            No Image
                        @endif
                     </td>
                    <td>
                        @if($task->status == 'pending')
                            <button onclick="completeTask({{ $task->id }})">Complete</button>
                        @endif
                        <button onclick="deleteTask({{ $task->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function completeTask(taskId) {
            $.ajax({
                url: '/tasks/' + taskId + '/complete',
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#task-' + taskId).find('td:eq(2)').text('completed');
                    $('#task-' + taskId).find('button:contains("Complete")').remove();
                },
                error: function(response) {
                    alert('Error: ' + response.responseJSON.error);
                }
            });
        }

        function deleteTask(taskId) {
            $.ajax({
                url: '/tasks/' + taskId,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#task-' + taskId).remove();
                },
                error: function(response) {
                    alert('Error: ' + response.responseJSON.error);
                }
            });
        }
    </script>
</body>
</html>