<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form action="/students" method="POST">

    @csrf

    <label>Name</label><br>
    <input type="text" name="name"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Course</label><br>
    <input type="text" name="course"><br><br>

    <button type="submit">Save Student</button>

</form>

<br>

<a href="/students">Back</a>
    
</body>
</html>