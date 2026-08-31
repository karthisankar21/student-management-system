let API_URL = "";
let IS_LARAVEL = false;

async function detectBackend() {

    if (window.location.port === "8001") {

        API_URL = "http://localhost:8001/api";
        IS_LARAVEL = true;
        console.log("Using Laravel API");

    } else {

        API_URL = "http://localhost:8000/api";
        IS_LARAVEL = false;
        console.log("Using Core PHP API");

    }
}

// Load students and search students
async function loadStudents() {
    console.log("loadStudents called");
    console.log("API_URL:", API_URL);
    console.log("IS_LARAVEL:", IS_LARAVEL);

    let search = document.getElementById("search").value;

    let url = IS_LARAVEL
        ? `${API_URL}/students`
        : `${API_URL}/students.php`;

    fetch(url)
        .then(res => res.json())
        .then(response => {
            
            console.log("API response:", response);

            let data = IS_LARAVEL ? response.data || response : response;
            let table = "";

            if (search) {
                data = data.filter(student =>
                    student.name.toLowerCase().includes(search.toLowerCase()) ||
                    student.email.toLowerCase().includes(search.toLowerCase()) ||
                    student.course.toLowerCase().includes(search.toLowerCase())
                );
            }

            if (data.length === 0) {
                table = `<tr><td colspan="5">No students found</td></tr>`;
            }

            data.forEach(student => {
                table += `
                <tr>
                    <td>${student.id}</td>
                    <td>${student.name}</td>
                    <td>${student.email}</td>
                    <td>${student.course}</td>
                    <td>
                        <button onclick="editStudent(${student.id}, '${student.name}', '${student.email}', '${student.course}')" class="btn btn-warning btn-sm me-2">
                            Edit
                        </button>

                        <button onclick="deleteStudent(${student.id})" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </td>
                    <td>
                        <button onclick="payStudent(${student.id})" class="btn btn-secondary btn-sm">
                            Pay
                        </button>
                    </td>
                </tr>`;
            });

            document.getElementById("studentTable").innerHTML = table;
            document.getElementById("totalStudents").innerText = data.length;
        });
}

//search students
function searchStudents() {

    let search = document
        .getElementById("search")
        .value
        .toLowerCase();

    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {

        let text = row.innerText.toLowerCase();

        row.style.display =
            text.includes(search)
            ? ""
            : "none";

    });

}

// Add student
function addStudent() {
    let data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        course: document.getElementById("course").value
    };

    let url = IS_LARAVEL
        ? `${API_URL}/students`
        : `${API_URL}/students.php`;

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
        .then(() => {
            location.reload();
        });
}

// Delete student
function deleteStudent(id) {

    let url = IS_LARAVEL
        ? `${API_URL}/students/${id}`
        : `${API_URL}/students.php`;

    let options = {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json"
        }
    };

    if (!IS_LARAVEL) {
        options.body = JSON.stringify({ id: id });
    }

    fetch(url, options)
        .then(res => res.json())
        .then(() => {
            location.reload();
            
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
    let url;

    if (IS_LARAVEL) {
        url = `${API_URL}/students`;

        if (editId) {
            method = "PUT";
            url = `${API_URL}/students/${editId}`;
        }

    } else {
        url = `${API_URL}/students.php`;

        if (editId) {
            method = "PUT";
            data.id = editId;
        }
    }

    console.log("Saving student...");
    console.log("URL:", url);
    console.log("Method:", method);
    console.log("Data:", data);

    fetch(url, {
    method: method,
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
    })
        
    .then(res => {
        console.log("Save status:", res.status);
        return res.json();
    })
        
    .then(response => {
        console.log("Save response:", response);
        closeModal();
        // loadStudents();
        location.reload();
    });
}   

function logout() {
    
    let url = IS_LARAVEL
        ? `${API_URL}/logout`
        : `${API_URL}/logout.php`;

    console.log("API_URL:", url);
    
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        }
    })
        .then(res => {
            console.log("Status:", res.status);
            return res.text();
        })
        .then(text => {
            console.log("Response:", text);

            if (IS_LARAVEL) {
                window.location.href = "/login";
            } else {
                localStorage.removeItem("token");
                window.location.href = "/frontend/login.html";
            }
        })
        .catch(err => {
            console.error("Logout Error:", err);
        });
}

// initial load async function
async function init() {
    await detectBackend();
        
    if (!IS_LARAVEL) {
        loadStudents();
    }
    // Auto-refresh every 5 seconds
    // setInterval(loadStudents, 5000);

}   

// Initial load
    init();
    
