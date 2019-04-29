<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.5/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.5/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../css/froala_text.css">
    <link rel="stylesheet" type="text/css" href="../css/main_theme.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Teko" rel="stylesheet">
    <title> CSCI 323 Home Page - Evan Almonte</title>
</head>

<body id="csci323-hard-copy-creator">
    <header>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="../" class="brand-logo">
                        <img src=../images/logo-white.svg> </a> <ul class="right hide-on-med-and-down">
                        <li><a href="assignments.html">Assignments</a></li>
                        <li class="active"><a href="#`">Hard Copy Creator</a></li>
                        </ul>
                </div>
            </nav>
        </div>
        <h1 class="cover-header">Hard Copy Creator</h1>
    </header>
    <main class="container">
        <form method="post" enctype="multipart/form-data" action="download.php" name="test">
            <section class="row">
                <h3 class="center-align">Project Information</h3>
                <div class="col s12 l4">
                    <input placeholder="Name" id="student_name" type="text" class="validate" name="student_name" required>
                    <label for="student_name">Name</label>
                </div>
                <div class="col s6 l4">
                    <input placeholder="mm/dd/yyyy" id="softCopyDeadline" type="text" class="validate datepicker" name="soft_copy_deadline" required>
                    <label for="softCopyDeadline">Soft Copy Due Date</label>
                </div>
                <div class="col s6 l4">
                    <input placeholder="mm/dd/yyyy" id="hardCopyDeadline" type="text" class="validate datepicker" name="hard_copy_deadline" required>
                    <label for="hardCopyDeadline">Hard Copy Due Date</label>
                </div>
            </section>
            <section class="row">
                <div class="input-field col s8 l4">
                    <select required name="project_language">
                        <option value="Java">Java</option>
                        <option selected value="C++">C++</option>
                    </select>
                    <label>Language</label>
                </div>
                <div class="input-field col s4 l2">
                    <input class="validate" id="project_num" name="project_num" type="number" min=1 max=20 required />
                    <label for="project_num">Project #</label>
                    <span class="helper-text" data-error="Invalid #"></span>
                </div>
                <div class="input-field col s12 l6">
                    <input class="validate" id="project_name" name="project_name" type="text" min=1 max=20 required />
                    <label for="project_name">Project Name</label>
                    <span class="helper-text" data-error="Project name is required"></span>
                </div>
            </section>
            <div class="divider"></div>
            <section class="row">
                <h3 class="col s12 center-align">Algorithm Steps</h3>
                <div class="col s12">
                    <div class="row">
                        <label class="col s12 m4 l2">
                            <input type="radio" value="external" name="algorithm_step_choice">
                            <span>Use External File</span>
                        </label>
                        <div class="file-field input-field col s12 m8 l10">
                            <div class="btn transparent">
                                <span>Open</span>
                                <input type="file" name="algorithm_steps_file">
                            </div>
                            <div class="file-path-wrapper">
                                <input id="algorithm_step_file" class="file-path validate" type="text" placeholder="Upload Algorithm Steps">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12">
                    <div class="row">
                        <label class="col s12 m3 l2">
                            <input type="radio" value="internal" name="algorithm_step_choice" checked>
                            <span>Write Steps</span>
                        </label>
                        <div class="col s12 m9 l10">
                            <textarea id="algorithm-steps" name="algorithm_steps_text"></textarea>
                        </div>
                    </div>
                </div>
            </section>
            <div class="divider"></div>
            <section class="row">
                <h3 class="col s12 center-align">Project Files</h3>
                <div class="col s12 l4">
                    <div class="card grey darken-3">
                        <div class="card-content accent-background">
                            <span class="card-title center-align">
                                <i class="material-icons">subject</i> Output
                            </span>
                        </div>
                        <div class="card-content">
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                    </tr>
                                </thead>
                                <tbody id="outputFilesTableBody"></tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="xy-center-flex">
                                <input type="file" name="output_files[]" id="outputFiles" class="inputfile" multiple required />
                                <label class="btn transparent" for="outputFiles">Upload Output</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 l4">
                    <div class="card grey darken-3">
                        <div class="card-content accent-background">
                            <span class="card-title center-align">
                                <i class="material-icons">subject</i> Input
                            </span>
                        </div>
                        <div class="card-content">
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                    </tr>
                                </thead>
                                <tbody id="inputFilesTableBody"></tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="xy-center-flex">
                                <input type="file" name="input_files[]" id="inputFiles" class="inputfile" multiple required />
                                <label class="btn transparent" for="inputFiles">Upload Input</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 l4">
                    <div class="card grey darken-3">
                        <div class="card-content accent-background">
                            <span class="card-title center-align">
                                <i class="material-icons">code</i> Source Code
                            </span>
                        </div>
                        <div class="card-content">
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                    </tr>
                                </thead>
                                <tbody id="sourceCodeFileTableBody"></tbody>
                            </table>
                        </div>
                        <div class="card-action">
                            <div class="xy-center-flex">
                                <input type="file" name="source_code_file" id="sourceCodeFile" class="inputfile" required />
                                <label class="btn transparent" for="sourceCodeFile">Upload Source Code</label>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <button id="button-generate-hard-copy" class="btn waves-effect waves-light col s12 m6 offset-m3" type="submit" name="action">Generate Hard Copy
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </main>
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                Created by Evan Almonte
            </div>
        </div>
    </footer>
    <!-- Javascript loading to optimize speed-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/hard-copy-creator.js"></script>
     <!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.5/js/froala_editor.pkgd.min.js"></script>

</body>
</html>