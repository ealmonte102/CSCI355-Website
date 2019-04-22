<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main_theme.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Teko" rel="stylesheet">
    <title> CSCI 323 Home Page - Evan Almonte</title>
</head>

<body id="csci323-hard-copy-creator">
    <header>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <a href="../"
                       class="brand-logo">
                        <img src=../images/logo-white.svg>
                             </a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="assignments.html">Assignments</a></li>
                        <li class="active"><a href="#`">Hard Copy Creator</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <h1 class="cover-header">Hard Copy Creator</h1>
    </header>
    <main class="container">
        <form method="post" enctype="multipart/form-data" action="download.php">
            <section class="row">
                <h3 class="center-align">Project Information</h3>
                <div class="col s12 l4">
                    <input placeholder="Name" id="student_name" type="text" class="validate" name="student_name" required>
                    <label for="student_name">Name</label>
                </div>
                <div class="col s6 l4">
                    <input placeholder="mm/dd/yyyy" id="soft-copy-due-date" type="text" class="validate datepicker" name="soft-copy-deadline" required>
                    <label for="soft-copy-due-date">Soft Copy Due Date</label>
                </div>
                <div class="col s6 l4">
                    <input placeholder="mm/dd/yyyy" id="hard-copy-due-date" type="text" class="validate datepicker" name="hard-copy-deadline" required>
                    <label for="hard-copy-due-date">Hard Copy Due Date</label>
                </div>
            </section>
            <section class="row">
                <div class="input-field col s8 l4">
                    <select requiredt>
                        <option value="1">Java</option>
                        <option selected value="2">C++</option>
                    </select>
                    <label>Language</label>
                </div>
                <div class="input-field col s4 l2">
                    <input class="validate" id="project_num" name="project_num" type="number" min=1 max=20 required />
                    <label for="project_num">Project #</label>
                    <span class="helper-text"
                          data-error="Invalid #"></span>
                </div>
                <div class="input-field col s12 l6">
                    <input class="validate" id="project_name" name="project_name" type="text" min=1 max=20 required />
                    <label for="project_name">Project Name</label>
                    <span class="helper-text"
                          data-error="Project name is required"></span>
                </div>
            </section>
            <div class="divider"></div>
            <div class="row">
                <h3 class="col s12 center-align">Algorithm Steps</h3>
                <div class="valign-wrapper col s12">
                    <label class="col l3">
                        <input type="radio" name="algorithm-step-choice">
                        <span>Use External File</span>
                    </label>
                    <div class="file-field input-field col l9">
                        <div class="btn">
                            <span>Open</span>
                            <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input id="algorithm-step-file" class="file-path validate" type="text" placeholder="Upload Algorithm Steps">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="valign-wrapper col s12">
                    <label class="col l3">
                        <input type="radio" name="algorithm-step-choice">
                        <span>Write Steps</span>
                    </label>
                    <div class="col l9">
                        <textarea id="algorithm-steps" class="materialize-textarea"></textarea>
                        <label for="algorithm-steps">Algorithm Steps</label>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <section class="row">
                <h3 class="col s12 center-align">Project Files</h3>
                <ul class="collapsible col s12">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">subject</i>Output</div>
                        <div class="collapsible-body">
                            <div class="xy-center-flex">
                                <input type="file" name="output_files[]" id="outputFiles" class="inputfile" multiple />
                                <label class="btn" for="outputFiles">Upload Output</label>
                            </div>
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                    </tr>
                                </thead>
                                <tbody id="outputFilesTableBody"></tbody>
                            </table>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">subject</i>Input</div>
                        <div class="collapsible-body">
                            <div class="xy-center-flex">
                                <input type="file" name="input_files[]" id="inputFiles" class="inputfile" multiple />
                                <label class="btn" for="inputFiles">Upload Input</label>
                            </div>
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                    </tr>
                                </thead>
                                <tbody id="inputFilesTableBody"></tbody>
                            </table>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">code</i>Source Code</div>
                        <div class="collapsible-body">
                            <div class="xy-center-flex">
                                <input type="file" name="source_code[]" id="sourceCodeFile" class="inputfile" />
                                <label class="btn" for="sourceCodeFile">Upload Source Code</label>
                            </div>
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                    </tr>
                                </thead>
                                <tbody id="sourceCodeFileTableBody"></tbody>
                            </table>
                        </div>
                    </li>
                </ul>
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
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script src="../js/hard-copy-creator.js"></script>
</body>

</html>
