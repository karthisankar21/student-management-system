
// Load students and search students
function loadStudents() {

    let search = document.getElementById("search").value;

    fetch("../api/students.php?search=" + search)
    .then(res => res.json())
    .then(data => {

        let table = "";

        if (data.length === 0) {

            table = `
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No students found
                    </td>
                </tr>
            `;
        }

        data.forEach(student => {

            table += `
            <tr>
                <td>${student.id}</td>
                <td>${student.name}</td>
                <td>${student.email}</td>
                <td>${student.course}</td>
                <td>
                    <button onclick="editStudent(${student.id}, '${student.name}', '${student.email}', '${student.course}')"
                        class="btn btn-warning btn-sm">
                        Edit
                    </button>

                    <button onclick="deleteStudent(${student.id})"
                        class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </td>
            </tr>
            `;
        });
        
        document.getElementById("studentTable").innerHTML = table;
        
        document.getElementById("totalStudents").innerText = data.length;
    });
}

// Add student
function addStudent() {

    let data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        course: document.getElementById("course").value
    };

    fetch("../api/students.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(() => {
        loadStudents();
    });
}

// Delete student
function deleteStudent(id) {

    fetch("../api/students.php", {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.json())
    .then(() => {
        loadStudents();
    });
}


// Edit student
function editStudent(id, name, email, course) {

    editId = id;

    document.getElementById("name").value = name;
    document.getElementById("email").value = email;
    document.getElementById("course").value = course;

    document.getElementById("studentModal").style.display = "block";
}


// Clear search
function clearSearch() {

    document.getElementById("search").value = "";

    loadStudents();
}


// Modal handling
let editId = null;

function openModal() {
    document.getElementById("studentModal").style.display = "block";
    editId = null;
}

function closeModal() {
    document.getElementById("studentModal").style.display = "none";
}


// Save student (both add and edit)
function saveStudent() {

    let data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        course: document.getElementById("course").value
    };

    let method = "POST";
    let url = "../api/students.php";

    if (editId) {
        method = "PUT";
        data.id = editId;
    }

    fetch(url, {
        method: method,
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(() => {
        closeModal();
        loadStudents();
    });
}

// initial load
loadStudents();