<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View PDF</title>
</head>
<body>

    <center>
        <a href="{{ route('preview', ['pdf' => 'your-pdf-file.pdf']) }}" class="btn btn-primary">View File PDF</a>
    </center>

</body>
</html>
