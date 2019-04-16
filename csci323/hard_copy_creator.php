<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main_theme.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Teko" rel="stylesheet">
    <title> CSCI 323 Home Page - Evan Almonte</title>
</head>

<body>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="../" class="brand-logo">
                  <img src=../images/logo-white.svg style="height:64px">
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="assignments.html">Assignments</a></li>
                    <li><a href="#`">Hard Copy Creator</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="main-content" id="csci323-main-content">
        <header>
            <h1>Hard Copy Creator</h1>
        </header>
        <form>
            <div class="row">
                <div class="col s4">
                    <input placeholder="Name" id="student_name" type="text" class="validate">
                    <label for="student_name">Name</label>
                </div>
                <div class="col s4">
                    <input placeholder="mm/dd/yyyy" id="soft-copy-due-date" type="text" class="validate datepicker">
                    <label for="soft-copy-due-date">Soft Copy Due Date</label>
                </div>
                <div class="col s4">
                    <input placeholder="mm/dd/yyyy" id="hard-copy-due-date" type="text" class="validate datepicker">
                    <label for="hard-copy-due-date">Hard Copy Due Date</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <select>
                        <option value="" disabled selected>Select a Language</option>
                        <option value="1">Java</option>
                        <option value="2">C++</option>
                    </select>
                    <label>Language</label>
                </div>
                <div class="input-field col s1">
                    <input class="validate" id="project_num" name="project_num" type="number" min=1 max=20 required />
                    <label for="project_num">Project #</label>
                    <span class="helper-text" data-error="Invalid #"></span>
                </div>
                <div class="input-field col s7">
                    <input class="validate" id="project_name" name="project_name" type="text" min=1 max=20 required />
                    <label for="project_name">Project Name</label>
                    <span class="helper-text" data-error="Project name is required"></span>
                </div>
            </div>
            <div class="row">
                <div class="file-field input-field col s4">
                    <div class="btn">
                        <span>Output Files</span>
                        <input type="file" multiple required>
                    </div>
                    <div class="file-path-wrapper">
                        <input id="output" class="file-path validate" type="text"
                            placeholder="Upload one or more files">
                    </div>
                </div>
                <div class="file-field input-field col s4">
                    <div class="btn">
                        <span>Input Files</span>
                        <input id="out" type="file" multiple required>
                    </div>
                    <div class="file-path-wrapper">
                        <input id="input" class="file-path validate" type="text" placeholder="Upload one or more files">
                    </div>
                </div>
                <div class="file-field input-field col s4">
                    <div class="btn">
                        <span>Source Code File</span>
                        <input type="file" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input id="source_code" class="file-path validate" type="text"
                            placeholder="Upload one or more files">
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="collection col s4">
                    <li class="collection-header" id="output-list">
                        <h4>Output Files</h4>
                    </li>
                </ul>
                <ul class="collection col s4">
                    <li class="collection-header">
                        <h4>Input Files</h4>
                    </li>
                </ul>
                <ul class="collection col s4">
                    <li class="collection-header">
                        <h4>Source Code File</h4>
                    </li>
                </ul>
            </div>
        </form>
    </div>

    <!-- Javascript loading to optimize speed-->
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.datepicker').datepicker();
        $('.dropdown-trigger').dropdown();
        $('select').formSelect();
        $('#output').change(function() {
            $('#output-list').children().not(':first').each(function() {
                $(this).remove();
            });
            var files = $(this).val().split(',');
            for (i = 0; i < files.length; ++i) {
                $('#output-list').append("<li class=\"collection-item\">" + files[i] + "</li>");
            }
        });
    });
    </script>
</body>

</html>