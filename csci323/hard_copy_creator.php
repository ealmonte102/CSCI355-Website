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
    <div class="container">
        <header>
            <h1 class="center-align white-text">Hard Copy Creator</h1>
        </header>
        <form method="post" enctype="multipart/form-data" action="download.php" onclick="submitForm">
            <div class="row">
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
            </div>
            <div class="row">
                <div class="input-field col s8 l4">
                    <select requiredt>
                        <option value="" disabled selected>Select a Language</option>
                        <option value="1">Java</option>
                        <option value="2">C++</option>
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
            </div>
            <div class="row" id="hard-copy-file-selection">
                <h3 class="center-align white-text">Project Files</h3>
                <div class="file-field input-field col s11ths s3">
                    <div class="btn">
                        <span>Output Files</span>
                        <input id="output-button" type="file" title="" name="output_files[]" multiple required accept=".txt,.jpg,.jpeg,.png">
                    </div>
                    <div class="file-path-wrapper">
                        <input id="output" class="file-path validate" title="" type="text" placeholder="Upload one or more files">
                    </div>
                </div>
                <div class="col s11ths s1"></div>
                <div class="file-field input-field col s11ths s3">
                    <div class="btn">
                        <span>Input Files</span>
                        <input id="out" type="file" title="" name="input_files[]" multiple required accept=".txt,.jpg,.jpeg,.png">
                    </div>
                    <div class="file-path-wrapper">
                        <input id="input" class="file-path validate" type="text" title="" placeholder="Upload one or more files">
                    </div>
                </div>
                <div class="col s11ths s1"></div>
                <div class="file-field input-field col s11ths s3">
                    <div class="btn">
                        <span>Source Code File</span>
                        <input type="file" title="" required name="source_code_file" ;>
                    </div>
                    <div class="file-path-wrapper">
                        <input id="source-code" class="file-path validate" title="" type="text" placeholder="Upload one or more files" accept=".cpp,.c,.java,.txt">
                    </div>
                </div>
            </div>
            <div class="row file-lists">
                <ul class="collection col s11ths s3" id="output-list">
                    <li class="collection-item">test</li>
                    <li class="collection-item">test</li>
                    <li class="collection-item">test</li>
                    <li class="collection-item">test</li>
                </ul>
                <div class="col s11ths s1"></div>
                <ul class="collection col s11ths s3" id="input-list">
                </ul>
                <div class="col s11ths s1"></div>
                <ul class="collection col s11ths s3" id="source-code-list">
                </ul>
            </div>
            <div class="row col s12">
                <h3 class="col s12 white-text center-align">Algorithm Steps</h3>
            </div>
            <div class="row valign-wrapper">
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
            <div class="row valign-wrapper">
                <label class="col l3">
                    <input type="radio" name="algorithm-step-choice">
                    <span>Write Steps</span>
                </label>
                <div class="col l9">
                    <textarea id="algorithm-steps" class="materialize-textarea"></textarea>
                    <label for="algorithm-steps">Algorithm Steps</label>
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect waves-light col s12 m6 offset-m3" type="submit" name="action">Generate Hard Copy
                    <i class="material-icons right">send</i>
                </button>
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
            $('.tabs').tabs();
            $('#output').change(function() {
                onFilesUpdated($(this));
            });
            $('#input').change(function() {
                onFilesUpdated($(this));
            });

            $('#source-code').change(function() {
                onFilesUpdated($(this));
            });
            $("textarea").keydown(function(e) {
                if (e.keyCode === 9) {
                    var start = this.selectionStart;
                    var end = this.selectionEnd;
                    var $this = $(this);
                    var value = $this.val();
                    $this.val(value.substring(0, start) +
                        "\t" +
                        value.substring(end));
                    this.selectionStart = this.selectionEnd = start + 1;
                    e.preventDefault();
                }
            });
            var instance = M.Tabs.getInstance($("#algorithm-steps-tabs"));
            instance.select('external-algorithm-steps')
            instance.updateTabIndicator();
        });

        function onFilesUpdated(list) {
            replaceFileList($("#" + list.attr('id') + "-list"), list.val().split(','));
        }

        function replaceFileList(list, files) {
            list.empty();
            for (i = 0; i < files.length; ++i) {
                list.append("<li class=\"collection-item\"><div>" + files[i] +
                    "<a href=#! onclick= removeFromList($(this)) id=" + $(list).attr('id') + "-item" + i + "</div></li>"
                );
            }
        }

        function submitForm() {
            M.Tabs
        }
    </script>
</body>

</html>