<!DOCTYPE html>
<html>
<head>
    <title>Students</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<a href="/students/create">
    <button>Add Student</button>
</a>


<h2>Student List</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody id="studentTable"></tbody>
</table>

<script>
fetch('/api/students')
.then(res => res.json())
.then(response => {

    let students = response.data || response;    

    let table = "";

    students.forEach(student => {
        table += `
        <tr>
            <td>${student.id}</td>
            <td>${student.name}</td>
            <td>${student.email}</td>
            <td>${student.course}</td>
            <td>
                <a href="/students/${student.id}/edit" class="btn btn-sm btn-primary">Edit</a>
            | 
            <form action="/students/${student.id}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </td>
        </tr>`;
    });

    document.getElementById("studentTable").innerHTML = table;
});

</script>

</body>
</html>