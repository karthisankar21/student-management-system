const API_URL = "http://127.0.0.1:8000/api";
const token = localStorage.getItem("token");

if (!token) {
    window.location.href = "login.html";
}


// Load students and search students
function loadStudents() {
    let search = document.getElementById("search").value;

    fetch(`${API_URL}/students`, {
        headers: {
            "Authorization": "Bearer " + token
        }
    })
    .then(res => res.json())
    .then(response => {

        let data = response.data;   
        let table = "";

        if (search) {
            data = data.filter(student =>
                student.name.toLowerCase().includes(search.toLowerCase()) ||
                student.email.toLowerCase().includes(search.toLowerCase()) ||
                student.course.toLowerCase().includes(search.toLowerCase())
            );
        }

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
                        class="btn btn-warning btn-sm">Edit</button>

                    <button onclick="deleteStudent(${student.id})"
                        class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            `;
        });

        document.getElementById("studentTable").innerHTML = table;
        document.getElementById("totalStudents").innerText = response.total;
    });
}

// // Add student
// function addStudent() {

//     let data = {
//         name: document.getElementById("name").value,
//         email: document.getElementById("email").value,
//         course: document.getElementById("course").value
//     };

//     fetch("http://localhost/student-management-laravel/api/students", {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json"
//         },
//         body: JSON.stringify(data)
//     })
//     .then(res => res.json())
//     .then(() => {
//         loadStudents();
//     });
// }

// Delete student
function deleteStudent(id) {
    fetch(`${API_URL}/students/${id}`, {
        method: "DELETE",
        headers: {
            "Authorization": "Bearer " + token
        }
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

    // Chnage title to "Update Student"
    document.getElementById("modalTitle").innerText = "Update Student";

    document.getElementById("studentModal").style.display = "block";
}


// Modal handling
let editId = null;

function openModal() {
    
    editId = null;

    document.getElementById("name").value = "";
    document.getElementById("email").value = "";
    document.getElementById("course").value = "";

    // 🔥 reset title
    document.getElementById("modalTitle").innerText = "Add Student";

    document.getElementById("studentModal").style.display = "block";

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
    let url = `${API_URL}/students`;

    if (editId) {
        method = "PUT";
        url = `${API_URL}/students/${editId}`;
    }

    fetch(url, {
        method: method,
        headers: {
            "Authorization": "Bearer " + token,
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


function logout() {
    fetch(`${API_URL}/logout`, {
        method: "POST",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
    .then(res => {
        console.log(res.status);
        return res.json();
    })
    .then(data => console.log(data));
}

// initial load
loadStudents();