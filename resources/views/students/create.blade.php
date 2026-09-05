<!DOCTYPE html>
<html>
<head>
    <title>Add Student - IT Free Elective</title>
</head>
<body>

    <h1>Add Student</h1>

    <form action="/students" method="POST">
        @csrf

        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>

        <br>

        <div>
            <label>ID Number:</label>
            <input type="text" name="id_number" required>
        </div>

        <br>

        <div>
            <label>Course:</label>
            <input type="text" name="course" required>
        </div>

        <br>

        <button type="submit">Save Student</button>
    </form>

    <br>

    <a href="/students">Back to Students</a>

</body>
</html>