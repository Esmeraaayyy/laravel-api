
<!DOCTYPE html>
<html>
<head>
    <title>IT Free Elective</title>
</head>
<body>

    <h1>IT Free Elective - Students</h1>

    @foreach ($students as $student)
        <p>
            {{ $student->name }}
            - {{ $student->id_number }}
            - {{ $student->course }}
        </p>
    @endforeach

</body>
</html>