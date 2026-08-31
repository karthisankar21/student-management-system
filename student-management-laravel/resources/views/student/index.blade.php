<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laravel - Student App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    @if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Students Data -->
    <div class="d-flex">

        <!-- SIDEBAR -->
        <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">

            <h4>Student App</h4>
            <hr>

            <p>📊 Dashboard</p>
            <p>👨‍🎓 Students</p>
            <p>⚙️ Settings</p>

        </div>

        <!-- MAIN CONTENT -->
        <div class="container-fluid p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h2 class="mb-0" style="-webkit-text-stroke: 1px Red; -webkit-text-fill-color: transparent">
                    Student Management Laravel Dashboard
                </h2>

                <form method="POST" action="/logout">
                    @csrf

                    <button class="btn btn-danger" type="submit">
                        Logout
                    </button>
                </form>

            </div><br>

            <!-- Run on Core-PHP Backend -->
            <div>
                <h2>Click to Go Core-PHP</h2>
                <a href="http://localhost:8000/frontend/" target="_blank" rel="noopener noreferrer">
                    <button class="btn btn-success">Back to Core-PHP</button>
                </a>
            </div><br>

            <!-- STATS CARDS -->
            <div class="row mb-4">

                <div class="col-md-3">
                    <div class="card shadow-sm p-3">
                        <h5>Total Students</h5>
                        <h3 id="totalStudents">{{$students->count()}}</h3>
                    </div>
                </div>
            </div>


            <!-- SEARCH -->
            <div class="input-group mb-3 shadow-sm">
                <span class="input-group-text">🔍</span>
                <input type="text" id="search" class="form-control"
                    placeholder="Search students..."
                    onkeyup="searchStudents()">
            </div>

            <!-- ADD BUTTON -->
            <button class="btn btn-primary mb-3" onclick="openModal()">
                Add Student
            </button>

            <!-- TABLE -->
            <table class="table table-hover shadow-sm">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Actions</th>
                        <th>Pay</th>
                    </tr>
                </thead>

                <!-- <tbody id="studentTable"></tbody> -->
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->course }}</td>

                        <td>

                            <button
                                onclick="editStudent(
                                    '{{ $student->id }}',
                                    '{{ $student->name }}',
                                    '{{ $student->email }}',
                                    '{{ $student->course }}'
                                )"
                                class="btn btn-warning">
                                Edit
                            </button>

                            <button
                                onclick="deleteStudent('{{ $student->id }}')"
                                class="btn btn-danger">
                                Delete
                            </button>

                        </td>
                        <td>
                            <a href="/payment/{{ $student->id }}" class="btn btn-info" target="_blank">Pay</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

    <!-- MODAL -->
    <div id="studentModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5);">

        <div class="bg-white p-4"
            style="width:400px; margin:100px auto; border-radius:10px;">

            <h4 id="modalTitle">Add Student</h4>

            <input id="name" class="form-control mb-2" placeholder="Name" required>
            <input id="email" class="form-control mb-2" placeholder="Email" required>
            <!-- <input id="course" class="form-control mb-2" placeholder="Course"> -->

            <label for="course">Choose a course:</label>

            <select name="course" id="course">
                <option value="computer-science">Computer Science</option>
                <option value="chemistry">Chemistry</option>
                <option value="physics">Physics</option>
                <option value="commerce">Commerce</option>
            </select><br><br>

            <button class="btn btn-success" onclick="saveStudent()">
                Save
            </button>

            <button class="btn btn-secondary" onclick="closeModal()">
                Cancel
            </button>

        </div>

    </div>



</body>

<script src="/shared/js/laravel-app.js"></script>

</html>